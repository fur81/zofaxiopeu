<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Acción para para agregar una nota a la consulta ya existente.
 * Con las notas el usuario puede establecer la comunicación
 * con el doctor que lo esté atendiendo.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */

// se obtiene el identificador de la incidencia
$issueId = $_POST['issueId'];
$issueNoteData = $_POST['noteTextArea'];
// se adiciona la nota a la incidencia
$mantisCore->addIssueNote($issueId, $issueNoteData);
$_SESSION ['issueId'] = $_POST['issueId'];
?>