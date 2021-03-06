<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Se establecen los valores en idioma español utilizados en el módulo de integración.
 */

global $values;
$values[L_SPANISH] = array(

		/**  projects */
		'label_project_second_opinion_title' => 'Segunda Opinión',
		'label_project_second_opinion_description' => 'Los médicos dan una segunda opinión del servicio.',
		'label_project_virtual_consultation_title' => 'Consulta Virtual',
		'label_project_virtual_consultation_description' => 'Los médicos brindan una consulta virtual para los clientes.',
		'label_project_rapid_consultation_title' => 'Consulta Rápida',
		'label_project_rapid_consultation_description' => 'Los médicos brindan una consulta rápida para necesidades inmediatas.',
		'label_project_health_program_title' => 'Programa de Salud',
		'label_project_health_program_description' => 'Se brinda un programa de salud para los consultantes.',

		/**  sub projects */
		'label_subproject_rapid_consult_general' => 'Consulta Rápida General',
		'label_subproject_virtual_consult_general' => 'Consulta Virtual General',
		'label_subproject_health_program_general' => 'Programa de Salud General',
		'label_subproject_second_opinion_general' => 'Segunda Opinión General',
		'label_subproject_cardiology' => 'Cardiología',
		'label_subproject_gynecology' => 'Ginecología',
		'label_subproject_pediatrics' => 'Pediatría',
		'label_subproject_urology' => 'Urología',
		'label_subproject_neurology' => 'Neurología',


		/** etiquetas generales */
		'label_beginning_client_zone' => 'Zona Clientes',
		'label_report_consultation' => 'Reportar consulta',
		'label_report_consultation_info' => 'Reporte de consulta',
		'label_payment' => 'Pago',
		'label_price' => 'Precio',
		'label_shipping' => 'Envío',
		'label_tax' => 'Impuesto',
		'label_total_amount' => 'Total a Pagar',
		'label_payment_type' => 'Tipo de pago',
		'label_paypal' => 'PayPal',
		'label_tpv' => 'TPV',
		'label_transaction' => 'Transacción',
		
		/** formularios */
		'label_empty_list' => '-- No existen datos para mostrar --',
		'label_consultation_details' => 'Detalles de la consulta',
		'label_attached_documents' => 'Documentos adjuntos',
		'label_assigned_to' => 'Asignada a',
		'label_lastUpdate' => 'Última actualización',
		'label_summary' => 'Resumen',
		'label_speciality' => 'Especialidad',
		'label_specialities' => 'Especialidades',
		'label_specialists' => 'Especialistas',
		'label_specialist' => 'Especialista',
		'label_select_specialist' => 'Seleccionar Especialista',
		'label_general_specialist' => 'Especialista General',
		'label_attached' => 'Adjuntos',
		'label_notes' => 'Notas',
		'label_description' => 'Descripción',
		'label_name' => 'Nombre',
		'label_upload_date' => 'Fecha de Subida',
		'label_size' => 'Tamaño',
		'label_upload_by' => 'Subido por',
		'label_notes_history' => 'Historial de Notas',
		'label_back' => 'Regresar',
		'label_new_note' => 'Nueva nota',
		'label_download' => 'Descargar',
		'label_reports' => 'Reportes',
		'label_service' => 'Servicio',
		'label_documents' => 'Documentos',
		'label_consultList' => 'Listado de Consultas',
		'label_user' => 'Usuario',
		'label_select' => '-- Seleccione --',
		'label_uploadSize' => 'El fichero que se desee adjuntar no puede ser mayor a ',
		'label_documentsInfo' => 'Usted podrá adjuntar todos los ficheros que desee a la consulta una vez que esta ha 
							sido creada. Para acceder a esta opción dirígase a la vista detallada de la consulta creada.',
		'label_client_zone_title' => 'LOREM IPSUM DOLOR',
		'label_client_zone_description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque 
										laudantium, totam erictus mepli rem aperiam, eaque ipsa quae ab illo inventore veritatis et 
										quasi architecto beatae vitae dicta sunt explicitus nillus ectol bo. Nemo enim ipsam voluptatem 
										quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur maraellos malic gni 
										dolores eos qui ratione	voluptatem sequi nesciunt.
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
										Aenean maite ellectus illio ect lassa. Cum sociis natoque penatibus et magnis dis parturient 
										montes, nascetur ridiculus mus. Aenean maesus cisei commodo ligula eget dolor. Aenean massa. 
										Cum sociis natoque penatibus et magnis dis parturient montello brenuli usu is, nascetur 
										ridiculus mus.',

		/** botones */
		'button_send' => 'Enviar',
		'button_upload_file' => 'Subir Fichero',
		'button_browse' => 'Examinar ...',

		/** correo */
		'email_titleCreateConsult' => '[Medicnexus] Consulta creada',
		'email_bodyCreateConsult' => 'Estimado usuario(a), usted ha creado una consulta con los siguiente datos:',
		'email_bodyFooter' => 'Gracias por utilizar nuestros servicios, Medicnexus.',

		/** campos necesarios */
		'msg_required_summary' => 'Por favor, denos el resumen.',
		'msg_required_descrition' => 'Por favor, denos la descripción.',
		'msg_required_speciality' => 'Por favor, seleccione una especialidad.',
		
		/** mensajes */
		'msg_info' => 'message',
		'msg_info_consult_inserted' => 'La consulta ha sido creada correctamente.',
		'msg_info_upload_inserted' => 'El fichero ha sido adjuntado correctamente.',
		'msg_error' => 'error',
		'msg_error_consult_inserted' => 'La consulta no se ha podido crear. Consulte a los teléfonos del sitio para mayor información.',
		'msg_error_empty_data' => 'Existen todavía datos en el formulario que deben ser llenados.',
		'msg_error_upload_size' => 'El fichero a adjuntar excede el tamaño máximo posible.',
		'msg_advice' => 'notice',
		'msg_resolved_consult' => 'La consulta se encuentra en estado "Resuelta" por lo que sus datos no podrán ser modificados. 
								En caso que necesite agregar información sobre la misma deberá ponerse en contacto a través de 
								los teléfonos brindados en el área Contactos.'
);
?>
