<?php
// se obtienen los datos del formulario
$summary = $_POST['summaryText'];
$description = $_POST['descriptionTextArea'];
$projectId = getProjectId();
if (isset($_SESSION['subProjectId'])) {
	$projectId = $_SESSION['subProjectId'];
}

// se adiciona la incidencia
$mantisCore->addIssue($summary, $description, $projectId);
?>