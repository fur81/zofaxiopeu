<?php
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

function setProjectPaypalConfiguration() {
	
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
?>
