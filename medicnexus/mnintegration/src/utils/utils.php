<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Este fichero contiene las funcionalidades de uso común dentro del sistema. Garantiza
 * el empleo de funcionalidades básicas y simples, pero que se repiten en más de una
 * ocasión.
 *
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 *
 */

require_once $GLOBALS['MNI_ES'];
require_once $GLOBALS['MNI_EN'];
require_once $GLOBALS['MNI_CA'];
require_once $GLOBALS['MNI_QUERY'];

function getValue($key) {
	global $values, $lang;
	echo $values[$lang][$key];
}

function getValueIn($key) {
	global $values, $lang;
	return $values[$lang][$key];
}

function getPagePath($key) {
	global $values;
	return $values['pages'][$key];
}

function getQuery($key) {
	global $values;
	return $values['query'][$key];
}

/**
 * Se obtiene el nombre el proyecto activo
 * @return string projectName
 */
function getProjectName() {
	$projectName = $_SESSION['projectId'];
	switch ($_SESSION['projectId']){
		case PROJECT_SECOND_OPINION:
			$projectName = getValue('label_project_second_opinion_title');
			break;
		case PROJECT_VIRTUAL_CONSULTATION:
			$projectName = getValue('label_project_virtual_consultation_title');
			break;
		case PROJECT_RAPID_CONSULTATION:
			$projectName = getValue('label_project_rapid_consultation_title');
			break;
		case PROJECT_HEALTH_PROGRAM:
			$projectName = getValue('label_project_health_program_title');
			break;
	}
	return $projectName;
}

/**
 * Establece la configuración de las variables de pago en dependencia
 * del proyecto seleccionado. Los dos tipos de pagos configurados son
 * Paypal y TPV.
 * @param String $paymentType
 */
function setProjectPaypalConfiguration( $paymentType = MN_PAY_PAYPAL) {

	if ( $paymentType == MN_PAY_PAYPAL) {

		switch ($_SESSION['projectId']){
			case PROJECT_SECOND_OPINION:
				$GLOBALS['PAY_PRICE'] = PAYPAL_PRICE_SECOND_OPINION;
				$GLOBALS['PAY_SHIPPING'] = PAYPAL_SHIPPING_SECOND_OPINION;
				$GLOBALS['PAY_TAX'] = PAYPAL_TAX_SECOND_OPINION;
				$GLOBALS['PAY_TOTAL_AMOUNT'] = PAYPAL_TOTAL_AMOUNT_SECOND_OPINION;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_second_opinion_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_second_opinion_description');
				break;
			case PROJECT_VIRTUAL_CONSULTATION:
				$GLOBALS['PAY_PRICE'] = PAYPAL_PRICE_VIRTUAL_CONSULTATION;
				$GLOBALS['PAY_SHIPPING'] = PAYPAL_SHIPPING_VIRTUAL_CONSULTATION;
				$GLOBALS['PAY_TAX'] = PAYPAL_TAX_VIRTUAL_CONSULTATION;
				$GLOBALS['PAY_TOTAL_AMOUNT'] = PAYPAL_TOTAL_AMOUNT_VIRTUAL_CONSULTATION;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_virtual_consultation_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_virtual_consultation_description');
				break;
			case PROJECT_RAPID_CONSULTATION:
				$GLOBALS['PAY_PRICE'] = PAYPAL_PRICE_RAPID_CONSULTATION;
				$GLOBALS['PAY_SHIPPING'] = PAYPAL_SHIPPING_RAPID_CONSULTATION;
				$GLOBALS['PAY_TAX'] = PAYPAL_TAX_RAPID_CONSULTATION;
				$GLOBALS['PAY_TOTAL_AMOUNT'] = PAYPAL_TOTAL_AMOUNT_RAPID_CONSULTATION;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_rapid_consultation_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_rapid_consultation_description');
				break;
			case PROJECT_HEALTH_PROGRAM:
				$GLOBALS['PAY_PRICE'] = PAYPAL_PRICE_HEALTH_PROGRAM;
				$GLOBALS['PAY_SHIPPING'] = PAYPAL_SHIPPING_HEALTH_PROGRAM;
				$GLOBALS['PAY_TAX'] = PAYPAL_TAX_HEALTH_PROGRAM;
				$GLOBALS['PAY_TOTAL_AMOUNT'] = PAYPAL_TOTAL_AMOUNT_HEALTH_PROGRAM;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_health_program_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_health_program_description');
				break;
		}
	}else if ( $paymentType == MN_PAY_TPV) {

		switch ($_SESSION['projectId']){
			case PROJECT_SECOND_OPINION:
				$GLOBALS['PAY_PRICE'] = TPV_PRICE_SECOND_OPINION;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_second_opinion_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_second_opinion_description');
				break;
			case PROJECT_VIRTUAL_CONSULTATION:
				$GLOBALS['PAY_PRICE'] = TPV_PRICE_VIRTUAL_CONSULTATION;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_virtual_consultation_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_virtual_consultation_description');
				break;
			case PROJECT_RAPID_CONSULTATION:
				$GLOBALS['PAY_PRICE'] = TPV_PRICE_RAPID_CONSULTATION;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_rapid_consultation_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_rapid_consultation_description');
				break;
			case PROJECT_HEALTH_PROGRAM:
				$GLOBALS['PAY_PRICE'] = TPV_PRICE_HEALTH_PROGRAM;
				$GLOBALS['PAY_NAME'] = getValueIn('label_project_health_program_title');
				$GLOBALS['PAY_DESCRIPTION'] = getValueIn('label_project_health_program_description');
				break;
		}
	}
	
}

function getProjectId() {
	$result = '';
	if (isset($_SESSION['projectId'])) {
		$result = $_SESSION['projectId'];
	}
	return $result;
}

function getValueByString($text) {
	global $values;
	// se busca en el paquete de idioma español
	$value = array_search($text, $values[L_SPANISH]);
	echo getValue($value);
}

function getDateFormat($date) {
	// format d/m/Y H:i
	// dia
	$dateFormat = substr ( $date, 8, 2 ) . '/';
	// mes
	$dateFormat .= substr ( $date, 5, 2 ) . '/';
	// año
	$dateFormat .= substr ( $date, 0, 4 ) . ' ';
	// hora
	$dateFormat .= substr ( $date, 11, 5 );
	return $dateFormat;
}

function replaceRToBr($string) {
	return str_replace("\r", "<br>", $string);
}

/**
 * Llena con ceros el valor del pasado por parámetros según la cantidad.
 * 
 * @param int $valor
 * @param int $num
 * @param char $char
 * @return string
 */
function llenaEspacios($valor,$num,$char){
    $len_valor = strlen($valor);
    for($i=$len_valor; $i<$num; $i++){
        $valor = $char.''.$valor;
    }
    $valor = '0'.$valor;
    return $valor;
}
?>
