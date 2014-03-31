<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece la configuración para que los mensajes puedan ser mostrados
 * en la interfaz principal.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 */

if (isset($_SESSION ['msg'])) {
	switch ($_SESSION ['msg']) {
		case 'msg_info_consult_inserted' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_info_consult_inserted'), getValueIn('msg_info'));
			break;

		case 'msg_error_consult_inserted' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_error_consult_inserted'), getValueIn('msg_error'));
			break;

		case 'msg_info_upload_inserted' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_info_upload_inserted'), getValueIn('msg_info'));
			break;
			
		case 'msg_error_upload_size' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_error_upload_size'), getValueIn('msg_error'));
			break;
	}
	unset($_SESSION ['msg']);
}
?>