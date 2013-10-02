<?php
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