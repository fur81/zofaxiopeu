<?php
// se chequea si se realizó el pago o no
if ( isset($_GET['success'])) {
	if ($_GET['success'] == 'true') {
		// se carga la información temporal
		$issueData = $mantisCore->loadTempData($_GET['idData']);
		// se crean las variables existentes en la información temporal
		$summary = $issueData['summary'];
		$description = $issueData['description'];
		$specialistId = $issueData['specialist'];
		$projectId = $issueData['projectId'];
		// se crea la incidencia con la información almacenada
		$mantisCore->addIssue($summary, $description, $projectId, $specialistId);
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
	$specialistId = $_POST['specialist'];
	$projectId = $_POST['subProjectId'];
	$_SESSION['subProjectId'] = $projectId;
	// se salva la información el la base de datos
	$idData = $mantisCore->saveIssueCreateData($summary, $description, $projectId, $specialistId);
	// se carga el servicio de paypal
	//setProjectPaypalConfiguration();
	//include_once $GLOBALS['PAYPAL_REQUEST_CLIENT_ZONE'];
	//exit();
	// solo para cuando paypal no está funcionando
	$mantisCore->addIssue($summary, $description, $projectId, $specialistId);
}
?>