<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Se establecen los valores en inglés utilizados en el módulo de integración.
 */

global $values;
$values[L_ENGLISH] = array(
		
		/**  projects */
		'label_project_second_opinion_title' => 'Second Opinion',
		'label_project_second_opinion_description' => 'Los médicos dan una segunda opinión del servicio.',
		'label_project_virtual_consultation_title' => 'Virtual Consultation',
		'label_project_virtual_consultation_description' => 'Los médicos brindan una consulta virtual para los clientes.',
		'label_project_rapid_consultation_title' => 'Rapid Consultation',
		'label_project_rapid_consultation_description' => 'Los médicos brindan una consulta rápida para necesidades inmediatas.',
		'label_project_health_program_title' => 'Health Program',
		'label_project_health_program_description' => 'Se brinda un programa de salud para los consultantes.',

		/**  sub projects */
		'label_subproject_rapid_consult_general' => 'General Rapid Consult',
		'label_subproject_virtual_consult_general' => 'General Virtual Consutl',
		'label_subproject_health_program_general' => 'General Health Program',
		'label_subproject_second_opinion_general' => 'General Second Opinion',
		'label_subproject_cardiology' => 'Cardiology',
		'label_subproject_gynecology' => 'Gynecology',
		'label_subproject_pediatrics' => 'Pediatrics',
		'label_subproject_urology' => 'Urology',
		'label_subproject_neurology' => 'Neurology',

		/** etiquetas generales*/
		'label_beginning_client_zone' => 'Client Zone',
		'label_report_consultation' => 'Report consultation',
		'label_report_consultation_info' => 'Report consultation',
		'label_payment' => 'Payment',
		'label_price' => 'Price',
		'label_shipping' => 'Shipping',
		'label_tax' => 'Tax',
		'label_total_amount' => 'Total Amount',
		'label_payment_type' => 'Payment Type',
		'label_paypal' => 'PayPal',
		'label_tpv' => 'TPV',
		
		/** formularios */
		'label_empty_list' => '-- There\'s no items to list --',
		'label_consultation_details' => 'Consultation details',
		'label_attached_documents' => 'Attached documents',
		'label_assigned_to' => 'Assigned to',
		'label_lastUpdate' => 'Last Update',
		'label_summary' => 'Summary',
		'label_speciality' => 'Speciality',
		'label_specialities' => 'Specialities',
		'label_specialists' => 'Specialists',
		'label_specialist' => 'Specialist',
		'label_select_specialist' => 'Select Specialist',
		'label_general_specialist' => 'General Specialist',
		'label_attached' => 'Attached',
		'label_notes' => 'Notes',
		'label_description' => 'Description',
		'label_name' => 'Name',
		'label_upload_date' => 'Upload date',
		'label_size' => 'Size',
		'label_upload_by' => 'Upload by',
		'label_notes_history' => 'Notes history',
		'label_back' => 'Back',
		'label_new_note' => 'New note',
		'label_download' => 'Download',
		'label_reports' => 'Reports',
		'label_service' => 'Service',
		'label_documents' => 'Documents',
		'label_consultList' => 'Consult List',
		'label_user' => 'User',
		'label_select' => '-- Select --',
		'label_uploadSize' => 'The file\'s size you want to attach needs to be less than ',
		'label_documentsInfo' => 'You can attach any files you want to the query once it has been 
									created. To access this option simply stroll to the detail view of the created query.',
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

		/** campos necesarios */
		'msg_required_summary' => 'Please, give us your summary.',
		'msg_required_descrition' => 'Please, give us your description.',
		'msg_required_speciality' => 'Please, select one speciality.',

		/** correo */
		'email_titleCreateConsult' => '[Medicnexus] Consult created',
		'email_bodyCreateConsult' => 'Hello, (a), you have created a query with the following data:',
		'email_bodyFooter' => 'Thank you for using our services, Medicnexus.',

		/** botones */
		'button_send' => 'Send',
		'button_upload_file' => 'Upload File',
		'button_browse' => 'Browse ...',

		/** mensajes */
		'msg_info' => 'message',
		'msg_info_consult_inserted' => 'The query has been successfully created.',
		'msg_info_upload_inserted' => 'The file has been successfully attached.',
		'msg_error' => 'error',
		'msg_error_consult_inserted' => 'The query could not be created. Consult phones site for more information.',
		'msg_error_empty_data' => 'The form steel have data that needs be writer.',
		'msg_error_upload_size' => 'The file to attach surpasses the maximum possible size.',
		'msg_advice' => 'notice',
		'msg_resolved_consult' => 'The query is in "Resolved" status so your data can not be modified.
									If you need to add information about it should contact through
									telephones provided in the Contacts area.'
);
?>
