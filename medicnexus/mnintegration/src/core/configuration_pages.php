<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.


// - paginas del sitio
// -- src
$GLOBALS['MNI_CORE'] =          $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/core/mantis_core.php';
$GLOBALS['MNI_CONNECTION'] =    $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/core/connection.php';

// -- paypal
$GLOBALS['PAYPAL_REQUEST_CLIENT_ZONE'] = $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/paypal/payments/PayPalPaymentClientZone.php';

// -- tpv
$GLOBALS['TPV_REQUEST_CLIENT_ZONE'] = $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/tpv/TPVPaymentClientZone.php';
$GLOBALS['TPV_COMMON'] = $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/tpv/TPVCommon.php';

// -- utils
$GLOBALS['MNI_UTILS'] =         $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/utils/utils.php';
$GLOBALS['MNI_ES'] =            $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/utils/es.php';
$GLOBALS['MNI_EN'] =            $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/utils/en.php';
$GLOBALS['MNI_CA'] =            $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/utils/ca.php';
$GLOBALS['MNI_QUERY'] =         $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/src/utils/query.php';

// -- view
// -- -- pages
$GLOBALS['MNI_TEST'] =          $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/test.php';
$GLOBALS['MNI_ISSUE_FLOW'] =    $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/issue_flow_page.php';
$GLOBALS['MNI_ISSUES_HEADER'] = $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/issues_header_page.php';
$GLOBALS['MNI_ISSUES_WELCOME'] = $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/issue_welcome_page.php';
$GLOBALS['MNI_ISSUE_DETAILS'] = $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/issue_details_page.php';
$GLOBALS['MNI_ISSUE_ADD'] =     $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/issue_add_page.php';
$GLOBALS['MNI_MANAGEMENT_FLOW'] =   $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/management_flow_page.php';
$GLOBALS['MNI_MANAGEMENT_WELCOME'] =   $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/management_welcome_page.php';
$GLOBALS['MNI_USER_CATEGORY_LIST'] =   $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/user_category_list_page.php';
$GLOBALS['MNI_USER_CATEGORY_ASSIGNMENT'] =   $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/user_category_assignment_page.php';
$GLOBALS['MNI_MSG_FLOW'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/pages/msg_flow_page.php';

// -- -- actions
$GLOBALS['MNI_ISSUE_CREATE_ACTION'] =     	$_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/issue_create_action.php';
$GLOBALS['MNI_ISSUE_ADD_NOTE_ACTION'] =   	$_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/issue_add_note_action.php';
$GLOBALS['MNI_ISSUE_DETAILS_ACTION'] =   	$_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/issue_details_action.php';
$GLOBALS['MNI_ISSUE_WELCOME_ACTION'] =   	$_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/issue_welcome_action.php';
$GLOBALS['MNI_ATTACHED_DOWNLOAD_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/attached_download_action.php';
$GLOBALS['MNI_ATTACHED_UPLOAD_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/attached_upload_action.php';
$GLOBALS['MNI_PROJECT_SELECTION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/project_selection_action.php';
$GLOBALS['MNI_SUBPROJECT_SELECTION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/subproject_selection_action.php';
$GLOBALS['MNI_USER_CATEGORY_ADD_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/user_category_add_action.php';
$GLOBALS['MNI_USER_CATEGORY_REMOVE_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/user_category_remove_action.php';
$GLOBALS['MNI_USER_CATEGORY_SELECTION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/user_category_selection_action.php';
$GLOBALS['MNI_USER_CATEGORY_ADD_RELATION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/user_category_add_relation_action.php';
$GLOBALS['MNI_USER_CATEGORY_REMOVE_RELATION_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/actions/user_category_remove_relation_action.php';

// -- -- templates
$GLOBALS['MNI_PROJECTS_HEADER_ACTION'] =  $_SERVER['DOCUMENT_ROOT'].SUB_PROJECT_PATH.'/mnintegration/view/templates/projects_header_template.php';
?>