<?php
// se obtiene el identificador de la incidencia
$issueId = $_POST['issueId'];
$issueNoteData = $_POST['noteTextArea'];
// se adiciona la nota a la incidencia
$mantisCore->addIssueNote($issueId, $issueNoteData);
$_SESSION ['issueId'] = $_POST['issueId'];
?>