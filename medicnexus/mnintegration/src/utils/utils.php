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

function getProjectId() {
	return $_SESSION['projectId'];
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