<?php
// se obtienen los datos del formulario
$issueId = $_POST['issueId'];
$name = $_FILES['fileAttached']['name'];
$fileType = $_FILES['fileAttached']['type'];
$content = $_FILES['fileAttached']['tmp_name'];
$content = file_get_contents($content);

// se carga el fichero al sistema
$mantisCore->addAttachment($issueId, $name, $fileType, $content);
?>