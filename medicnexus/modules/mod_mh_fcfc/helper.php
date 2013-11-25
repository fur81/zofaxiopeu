<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2013 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

abstract class mod_mh_fcfc
{

    public static function firstLoad(stdClass $module, JRegistry &$params)
    {
        static $onload;

        if ($onload) {
            return;
        }

        $onload = true;

        JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

        JFactory::getDocument()->addScript(JUri::base(true) . '/modules/' . $module->module . '/js/fcfc.js');

        $css[] = 'div.fcfc_wrapper{position:relative;}';
        $css[] = 'div.fcfc_inner{';
        $css[] = 'position:absolute;';
        $css[] = 'overflow:hidden;';
        $css[] = 'z-index:2;';
        $css[] = 'display:none;';
        $css[] = '}';

        JFactory::getDocument()->addStyleDeclaration(implode($css));
    }

    public static function getContentFromCategory(JRegistry &$params)
    {
        $db = JFactory::getDbo();
        $nullDate = $db->quote($db->getNullDate());
        $nowDate = $db->quote(JFactory::getDate('now', 'UTC')->toSql());

        $query = $db->getQuery(true)
            ->select(array('c.id', 'c.catid', 'c.title', 'c.introtext', 'c.fulltext'))
            ->from('#__content AS c')
            ->where('c.state = ' . $db->quote(1))
            ->where('c.catid IN(' . implode(',', $params->get('catid')) . ')')
            ->where('(c.publish_up = ' . $nullDate . ' OR c.publish_up <= ' . $nowDate . ')')
            ->where('(c.publish_down = ' . $nullDate . ' OR c.publish_down >= ' . $nowDate . ')')
            ->where('c.access IN(' . implode(',', JFactory::getUser()->getAuthorisedViewLevels()) . ')')
            ->order('c.catid');

        if ($params->get('order') == 'random') {
            $params->set('order', 'RAND()');
            $params->set('sort', '');
        }

        if ($params->get('language')) {
            $query->where('c.language IN(' . $params->get('language') . ', ' . $db->quote('*') . ')');
        }

        $query->order($params->get('order') . ' ' . $params->get('sort'));

        $db->setQuery($query, 0, $params->get('limit', 0));

        return $db->loadObjectList();
    }
}