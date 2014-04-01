<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Acciones para mostar los detalles de una consulta. En la vista de detalles de la
 * consulta se habilitan funcionalidades para adjuntar ficheros que puedan dar
 * claridad de la consulta realizada y se pueden agregar notas como vía de comunicación
 * con los doctores.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */

// se almacena el identificador de la incidencia en la sessión
$_SESSION ['issueId'] = $_POST['issueId'];

// se coloca la etiqueta de visto en caso de que no la tenga
$isIssueRead = $mantisCore->isIssueRead($_POST['issueId']);
if (!$isIssueRead) {
	$mantisCore->createHistoryBug($_POST['issueId']);
}

?>