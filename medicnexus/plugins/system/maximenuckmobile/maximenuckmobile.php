<?php

/**
 * @copyright	Copyright (C) 2012 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.event.plugin');

class plgSystemMaximenuckmobile extends JPlugin {

	function plgSystemMaximenuckmobile(&$subject, $params) {
		parent::__construct($subject, $params);
	}

	/**
	 * @param       JForm   The form to be altered.
	 * @param       array   The associated data for the form.
	 * @return      boolean
	 * @since       1.6
	 */
	function onContentPrepareForm($form, $data) {
		if ($form->getName() != 'com_modules.module' && $form->getName() != 'com_advancedmodules.module' || ($form->getName() == 'com_modules.module' && $data && $data->module != 'mod_maximenuck') || ($form->getName() == 'com_advancedmodules.module' && $data && $data->module != 'mod_maximenuck'))
			return;

		JForm::addFormPath(JPATH_SITE . '/plugins/system/maximenuckmobile/params');

		// get the language
		// $lang = JFactory::getLanguage();
		// $langtag = $lang->getTag(); // returns fr-FR or en-GB
		$this->loadLanguage();

		// module options
		// $app = JFactory::getApplication();
		// $plugin = JPluginHelper::getPlugin('system', 'maximenuckmobile');
		// $pluginParams = new JRegistry($plugin->params);

		// load the additional options in the module
		$form->loadFile('mobile_menuparams_maximenuck', false);
	}

	function onAfterDispatch() {

		$app = JFactory::getApplication();
		$document = JFactory::getDocument();
		$doctype = $document->getType();


		// si pas en frontend, on sort
		if ($app->isAdmin()) {
			return false;
		}

		// si pas HTML, on sort
		if ($doctype !== 'html') {
			return;
		}

		// si Internet Explorer on sort
		jimport('joomla.environment.browser');
		$browser = JBrowser::getInstance();
		$browserType = $browser->getBrowser(); // info : il existe aussi un browser version
		if ($browserType == 'msie' and $browser->getVersion() < 9) {
			return false;
		}

		// get the language
		// $lang = JFactory::getLanguage();
		$this->loadLanguage();

		JHTML::_("jquery.framework", true);
		if (!class_exists('Mobile_Detect')) {
			require_once dirname(__FILE__) . '/Mobile_Detect.php';
		}
		$document->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
		$document->addScript(JUri::base(true) . '/plugins/system/maximenuckmobile/assets/maximenuckmobile.js');
		$document->addScriptDeclaration("var CKTEXT_PLG_MAXIMENUCK_MENU = '" . JText::_('PLG_MAXIMENUCK_MENU') . "';");
		$menuIDs = Array();
		
		foreach ($this->getMaximenuModules() as $module) {
			if (!$module->params) 
				continue;
				
			$moduleParams = new JRegistry($module->params);
			if (!$moduleParams->get('maximenumobile_enable', '0'))
				continue;
				
			$menuID = $moduleParams->get('menuid', 'maximenuck');
			$resolution = $this->params->get('maximenumobile_resolution', '640');
			$container = $moduleParams->get('maximenumobile_container', 'body');
			$useimages = $moduleParams->get('maximenumobile_useimage', '0');
			$usemodules = $moduleParams->get('maximenumobile_usemodule', '0');
			$theme = $this->params->get('maximenumobile_theme', 'default');
			$document->addStyleSheet(JUri::base(true) . '/plugins/system/maximenuckmobile/themes/' . $theme . '/maximenuckmobile.css');
			$showdesc = $moduleParams->get('maximenumobile_showdesc', '0');
			$showlogo = $moduleParams->get('maximenumobile_showlogo', '1');

			array_push($menuIDs, $menuID);

			$js = "jQuery(document).ready(function($){
                    $('#" . $menuID . "').MobileMaxiMenu({"
					. "usemodules : " . $usemodules . ","
					. "container : '" . $container . "',"
					. "showdesc : " . $showdesc . ","
					. "showlogo : " . $showlogo . ","
					. "useimages : " . $useimages . ","
					. "menuid : '" . $menuID . "',"
					. "displaytype : '" . $moduleParams->get('maximenumobile_display', 'flat') . "',"
					. "displayeffect : '" . $moduleParams->get('maximenumobile_displayeffect', 'normal') . "'"
					. "});
                });";
			$document->addScriptDeclaration($js);
			
			$css = $this->getMediaQueries($resolution, $menuID, $moduleParams);
			$document->addStyleDeclaration($css);
		}
	}

	private function getMaximenuModules() {
		$db = JFactory::getDBO();
		$query = "
            SELECT id, params
            FROM #__modules
            WHERE published=1
            AND module='mod_maximenuck'
            ;";
		$db->setQuery($query);
		$modules = $db->loadObjectList('id');
		return $modules;
	}

	private function getMediaQueries($resolution, $menuID, $moduleParams) {
		$detect_type = $this->params->get('maximenumobile_detectiontype', 'resolution');
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		$bodypadding = ($moduleParams->get('maximenumobile_container', 'body') == 'body') ? 'body { padding-top: 40px !important; }' : '';
		if ($detect_type == 'resolution') {
			$css = "@media only screen and (max-width:" . str_replace('px', '', $resolution) . "px){
    #" . $menuID . " { display: none !important; }
    .mobilebarmenuck { display: block; }
	.hidemenumobileck {display: none !important;}
    " . $bodypadding . " }";
		} elseif (($detect_type == 'tablet' && $detect->isMobile()) || ($detect_type == 'phone' && $detect->isMobile() && !$detect->isTablet())) {
			$css = "#" . $menuID . " { display: none !important; }
    .mobilebarmenuck { display: block; }
	.hidemenumobileck {display: none !important;}
    " . $bodypadding;
		} else {
			$css = '';
		}

		return $css;
	}
}