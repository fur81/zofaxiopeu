<?php 
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Esta página muestra la pantalla de bienvenida a los usuarios registrados.
 * En ella aparecen los servicios disponibles para realizar las consultas.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */

?>
<div id="client_zone">
	<?php $mantisCore->addAccountToProject(); // se le adicionan todos los proyectos pendientes al cliente. ?>   
	<!-- se agrega el encabezado con los proyectos -->
	<?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION'];?>
    
    <h1><?php getValue('label_client_zone_title');?></h1>
    <p><?php getValue(label_client_zone_description);?></p>
    
</div>