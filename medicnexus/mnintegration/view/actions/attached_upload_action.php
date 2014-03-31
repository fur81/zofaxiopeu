<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece los pasos para adjuntar un documento a la consulta ya existente.
 */

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
		// la dirección tiene valor
		if ($size < MN_MANTIS_FILE_MAX_SIZE ) {
			// cumple con el tamanno requerido y se inserta el adjunto.
			$mantisCore->addAttachment($issueId, $name, $fileType, $content);
			$_SESSION ['msg'] = 'msg_info_upload_inserted';
		} else {
			$_SESSION ['msg'] = 'msg_error_upload_size';
		}
	}
}
?>