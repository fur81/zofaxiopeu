<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece valores generales para ser utilizados dentro del módulo integración.
 * Cada uno de los valores se encuentran identificado al servicio que pertenecen.
 */

// variables globales de los sistemas
//define('MN_HOST', 'localhost');
//define('MN_MANTIS_ROOT_USERNAME', 'mninside');
//define('MN_MANTIS_ROOT_PASSWORD', 'm4nt1s#2013');
//define('MN_MANTIS_DATABASE', 'mninside');
include_once 'general_config.php';
define('MANTIS_INFORMER_ACCESS', 25);
define('MANTIS_DEVELOPER_ACCESS', 55);
define('MANTIS_READ_LABEL_HISTORY', 'Leída');
define('MANTIS_ADD_TYPE_HISTORY', 25);
define('MANTIS_REMOVE_TYPE_HISTORY', 26);

require_once 'configuration_pages.php';

// variables globales de los servicios web
define('MANTIS_WEBSERVICES_DIR', 'http://'.MN_HOST.SUB_PROJECT_PATH.'/mninside/api/soap/mantisconnect.php?wsdl');

// -- paypal
$GLOBALS['PAYPAL_EXECUTE_SECOND_OPINION'] = 'http://'.MN_HOST.SUB_PROJECT_PATH.'/mnintegration/src/paypal/payments/ExecutePayment.php'; 

// variables globales del proyecto
define('PROJECT_SECOND_OPINION', 1);
define('PROJECT_VIRTUAL_CONSULTATION', 2);
define('PROJECT_HEALTH_PROGRAM', 3);
define('PROJECT_RAPID_CONSULTATION', 8);
define('ELEMENTS_PER_PAGE', 30);
define('PAGE_NUMBER', 1);

// lenguajes
define('L_SPANISH', 'es-ES');
define('L_CATALAN', 'ca-ES');
define('L_ENGLISH', 'en-GB');

// variables de pagos
define('MN_PAY_PAYPAL', 'paypal');
define('MN_PAY_TPV', 'tpv');
include_once 'configuration_pay.php';

// variables de joomla
$GLOBALS['lang'] = JRequest::getVar('language');
$GLOBALS['CURRENT_USERNAME'] = JFactory::getUser()->username;
$GLOBALS['CURRENT_USERFULLNAME'] = JFactory::getUser()->name;
$GLOBALS['CURRENT_USEREMAIL'] = JFactory::getUser()->email;

?>
