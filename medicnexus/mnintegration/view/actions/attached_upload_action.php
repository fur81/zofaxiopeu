<?php
// se obtienen los datos del formulario
$issueId = $_POST['issueId'];
if ( isset($_FILES['fileAttached']) ) {

	$name = trim($_FILES['fileAttached']['name']);
	$size = $_FILES['fileAttached']['size'];
	$fileType = $_FILES['fileAttached']['type'];
	$content = $_FILES['fileAttached']['tmp_name'];
	$content = file_get_contents($content);

	// se eliminan los espacios del nombre
	$name = str_replace(" ", "_", $name);

	// se carga el fichero al sistema si no está vacía la dirección
	if ( strlen($name) > 0 ) {
		// como la dirección tiene valor se inserta el adjunto
		$mantisCore->addAttachment($issueId, $name, $fileType, $content);
	}
}
?>