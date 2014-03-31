<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece los pasos a realizar para la acción de descargar un adjunto un fichero
 * perteneciente a una consulta.
 */

// se obtiene el identificador del adjunto
$attachedId = $_POST['attachedId'];
$attachedFileName = $_POST['attachedFileName'];
// se obtiene el adjunto
$data = $mantisCore->getAttachmentById($attachedId);
// se configura la página para que descargue el adjunto
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=" . $attachedFileName);
// estas dos línas garantizas que se muestre el cuadro de descarga de ficheros
print $data;
exit();
?>