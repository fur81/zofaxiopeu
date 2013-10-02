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
	$projectName = '';
	switch ($_SESSION['projectId']){
		case PROjECT_1:
			$projectName = 'Segunda Opinión';
			break;
		case PROjECT_2:
			$projectName = 'Consulta Virtual';
			break;
		case PROjECT_3:
			$projectName = 'Programa de Salud';
			break;
	}
	return $projectName;
}

function getProjectId() {
	return $_SESSION['projectId'];
}

?>