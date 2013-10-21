<?php
// se chequea si se realizó el pago o no
if ( isset($_GET['success'])) {
	if ($_GET['success'] == 'true') {
		// se carga la información temporal
		$issueData = $mantisCore->loadTempData($_GET['idData']);
		// se crean las variables existentes en la información temporal
		$summary = $issueData['summary'];
		$description = $issueData['description'];
		$projectId = $issueData['projectId'];
		// se crea la incidencia con la información almacenada
		$mantisCore->addIssue($summary, $description, $projectId);
	}
	// se eliminan los valores del temporal
	$mantisCore->removeTempData($_GET['idData']);
	$url = strtok(JFactory::getURI(), '?');
	header ( 'Location: ' . $url);
	exit();
} else {
	// se obtienen los datos del formulario
	$summary = $_POST['summaryText'];
	$description = $_POST['descriptionTextArea'];
	$projectId = getProjectId();
	if (isset($_SESSION['subProjectId'])) {
		$projectId = $_SESSION['subProjectId'];
	}
	// se salva la información el la base de datos
	$idData = $mantisCore->saveIssueCreateData($summary, $description, $projectId);
	// se carga el servicio de paypal
	include_once $GLOBALS['PAYPAL_REQUEST_SECOND_OPINION'];
	exit();
}
?>