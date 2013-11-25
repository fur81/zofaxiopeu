<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2013 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$rows = mod_mh_fcfc::getContentFromCategory($params);

if (empty($rows)) {
    return;
}

mod_mh_fcfc::firstLoad($module, $params);

foreach ($rows as &$row) {
    if ($params->get('content') == 'bothtext') {
        $row->text = $row->introtext . $row->fulltext;
    } else {
        $row->text = $row->{$params->get('content')};
    }
    unset($row->introtext);
    unset($row->fulltext);

    $row->text = JHtml::_('content.prepare', $row->text);
    $row->link = ContentHelperRoute::getArticleRoute($row->id, $row->catid);
}

$rows = array_reverse($rows);

require JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));