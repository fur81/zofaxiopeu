<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Acción para establecer el proyecto seleccionado.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 */

// se establece el proyecto seleccionado
$_SESSION['projectId'] = $_POST['projectId'];
?>