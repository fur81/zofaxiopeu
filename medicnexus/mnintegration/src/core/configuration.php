<?php
// variables globales de los sistemas
define('MANTIS_DATABASE', 'mninside');
define('MANTIS_ROOT_USERNAME', 'root');
define('MANTIS_ROOT_PASSWORD', 'carabobo');
define('MANTIS_SERVER_IP', 'localhost');
define('MANTIS_INFORMER_ACCESS', 25);
define('MANTIS_DEVELOPER_ACCESS', 55);

// variables globales de los servicios web
define('MANTIS_WEBSERVICES_DIR', 'http://'.MANTIS_SERVER_IP.'/medicnexus/mninside/api/soap/mantisconnect.php?wsdl');

// variables globales del proyecto
define('PROJECT_RAPID_CONSULTATION', 1);
define('PROjECT_1', 1);
define('PROjECT_2', 2);
define('PROjECT_3', 3);
define('ELEMENTS_PER_PAGE', 30);
define('PAGE_NUMBER', 1);

// variables de joomla
$GLOBALS['lang'] = JRequest::getVar('language');
$GLOBALS['CURRENT_USERNAME'] = JFactory::getUser()->username;
$GLOBALS['CURRENT_USERFULLNAME'] = JFactory::getUser()->name;
$GLOBALS['CURRENT_USEREMAIL'] = JFactory::getUser()->email;

// - paginas del sitio
// -- src
$GLOBALS['MNI_CORE'] =          $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/core/mantis_core.php';
$GLOBALS['MNI_CONNECTION'] =    $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/core/connection.php';
// -- utils
$GLOBALS['MNI_UTILS'] =         $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/utils/utils.php';
$GLOBALS['MNI_ES'] =            $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/utils/es.php';
$GLOBALS['MNI_EN'] =            $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/utils/en.php';
$GLOBALS['MNI_CA'] =            $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/utils/ca.php';
$GLOBALS['MNI_QUERY'] =         $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/src/utils/query.php';
// -- view
// -- -- pages
$GLOBALS['MNI_TEST'] =          $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/test.php';
$GLOBALS['MNI_ISSUE_FLOW'] =    $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/issue_flow_page.php';
$GLOBALS['MNI_ISSUES_HEADER'] = $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/issues_header_page.php';
$GLOBALS['MNI_ISSUES_WELCOME'] = $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/issue_welcome_page.php';
$GLOBALS['MNI_ISSUE_DETAILS'] = $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/issue_details_page.php';
$GLOBALS['MNI_ISSUE_ADD'] =     $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/issue_add_page.php';
$GLOBALS['MNI_MANAGEMENT_FLOW'] =   $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/management_flow_page.php';
$GLOBALS['MNI_MANAGEMENT_WELCOME'] =   $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/management_welcome_page.php';
$GLOBALS['MNI_USER_CATEGORY_LIST'] =   $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/user_category_list_page.php';
$GLOBALS['MNI_USER_CATEGORY_ASSIGNMENT'] =   $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/pages/user_category_assignment_page.php';

// -- -- actions
$GLOBALS['MNI_ISSUE_CREATE_ACTION'] =     	$_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/issue_create_action.php';
$GLOBALS['MNI_ISSUE_ADD_NOTE_ACTION'] =   	$_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/issue_add_note_action.php';
$GLOBALS['MNI_ISSUE_DETAILS_ACTION'] =   	$_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/issue_details_action.php';
$GLOBALS['MNI_ATTACHED_DOWNLOAD_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/attached_download_action.php';
$GLOBALS['MNI_ATTACHED_UPLOAD_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/attached_upload_action.php';
$GLOBALS['MNI_PROJECT_SELECTION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/project_selection_action.php';
$GLOBALS['MNI_SUBPROJECT_SELECTION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/subproject_selection_action.php';
$GLOBALS['MNI_USER_CATEGORY_ADD_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/user_category_add_action.php';
$GLOBALS['MNI_USER_CATEGORY_REMOVE_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/user_category_remove_action.php';
$GLOBALS['MNI_USER_CATEGORY_SELECTION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/user_category_selection_action.php';
$GLOBALS['MNI_USER_CATEGORY_ADD_RELATION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/user_category_add_relation_action.php';
$GLOBALS['MNI_USER_CATEGORY_REMOVE_RELATION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/mnintegration/view/actions/user_category_remove_relation_action.php';
?>