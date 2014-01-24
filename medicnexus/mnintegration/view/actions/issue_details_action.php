<?php
// se almacena el identificador de la incidencia en la sessión
$_SESSION ['issueId'] = $_POST['issueId'];

// se coloca la etiqueta de visto en caso de que no la tenga
$isIssueRead = $mantisCore->isIssueRead($_POST['issueId']);
if (!$isIssueRead) {
	$mantisCore->createHistoryBug($_POST['issueId']);
}

?>