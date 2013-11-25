<?php
// se obtienen los datos del formulario
$issueId = $_POST['issueId'];
$name = $_FILES['fileAttached']['name'];
$fileType = $_FILES['fileAttached']['type'];
$content = $_FILES['fileAttached']['tmp_name'];
$content = file_get_contents($content);

// se eliminan los espacios del nombre
$name = str_replace(" ", "_", $name);

// se carga el fichero al sistema
$mantisCore->addAttachment($issueId, $name, $fileType, $content);
?>