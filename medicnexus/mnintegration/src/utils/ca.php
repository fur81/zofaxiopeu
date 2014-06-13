<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Se establecen los valores utilizados en el lenguaje catalán.
 */

global $values;
$values[L_CATALAN] = array(

		/**  projects */
		'label_project_second_opinion_title' => 'Segona Opinió',
		'label_project_second_opinion_description' => 'Els metges donen una segona opinió del servei.',
		'label_project_virtual_consultation_title' => 'Consulta Virtual',
		'label_project_virtual_consultation_description' => 'Els metges brinden una consulta virtual per als clients.',
		'label_project_rapid_consultation_title' => 'Consulta Ràpida',
		'label_project_rapid_consultation_description' => 'Els metges brinden una consulta ràpida per necessitats immediates.',
		'label_project_health_program_title' => 'Programa de Salut',
		'label_project_health_program_description' => 'Es brinda un programa de salut per als consultants.',

		/**  sub projects */
		'label_subproject_rapid_consult_general' => 'Consulta Ràpida General',
		'label_subproject_virtual_consult_general' => 'Consulta Virtual General',
		'label_subproject_health_program_general' => 'Programa de Salut General',
		'label_subproject_second_opinion_general' => 'Segona Opinió General',
		'label_subproject_cardiology' => 'Cardiologia',
		'label_subproject_gynecology' => 'Ginecologia',
		'label_subproject_pediatrics' => 'Pediatria',
		'label_subproject_urology' => 'Urologia',
		'label_subproject_neurology' => 'Neurologia',

		/** etiquetas generales*/
		'label_beginning_client_zone' => 'Zona Clients',
		'label_report_consultation' => 'Informar Consulta',
		'label_report_consultation_info' => 'Informe de Consulta',
		'label_payment' => 'Pagament',
		'label_price' => 'Preu',
		'label_shipping' => 'Enviament',
		'label_tax' => 'Impost',
		'label_total_amount' => 'Total a Pagar',
		'label_payment_type' => 'Tipus de Pagament',
		'label_paypal' => 'PayPal',
		'label_tpv' => 'TPV',
		'label_transaction' => 'Transacción',
		
		/** formularios */
		'label_empty_list' => '-- No hi ha dades per mostrar --',
		'label_consultation_details' => 'Detalls de la consulta',
		'label_attached_documents' => 'Documentos adjuntos',
		'label_assigned_to' => 'Assignat a',
		'label_lastUpdate' => 'Darrera actualització',
		'label_summary' => 'Resum',
		'label_speciality' => 'Especialitat',
		'label_specialities' => 'Especialitats',
		'label_specialists' => 'Especialistes',
		'label_specialist' => 'Especialiste',
		'label_select_specialist' => 'Selecciona Especialista',
		'label_general_specialist' => 'Especialista General',
		'label_attached' => 'Adjunts',
		'label_notes' => 'Notes',
		'label_description' => 'Descripció',
		'label_upload_file' => 'Pujar Fitxer',
		'label_name' => 'Nom',
		'label_upload_date' => 'Data de Pujada',
		'label_size' => 'Mida',
		'label_upload_by' => 'Carregat per',
		'label_notes_history' => 'Historial de Notes',
		'label_back' => 'Tornar',
		'label_new_note' => 'Nova Nota',
		'label_download' => 'Descarregar',
		'label_reports' => 'Informes',
		'label_service' => 'Servicio',
		'label_documents' => 'Documents',
		'label_consultList' => 'Listado de Consultas',
		'label_user' => 'Usuario',
		'label_select' => '-- Seleccioneu --',
		'label_uploadSize' => 'El fitxer que es vulgui adjuntar no pot ser major a ',
		'label_documentsInfo' => 'Vostè podrà adjuntar tots els fitxers que vulgueu a la 
								consulta una vegada que aquesta ha estat creada. Per accedir a 
								aquesta opció dirígase a la vista detallada de la consulta creada.',
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
		'button_upload_file' => 'Pujar Fitxer',
		'button_browse' => 'Examinar ...',

		/** correo */
		'email_titleCreateConsult' => '[Medicnexus] Consulta creada',
		'email_bodyCreateConsult' => 'Benvolgut usuari (a), vostè ha creat una consulta amb les següents dades:',
		'email_bodyFooter' => 'Gràcies per utilitzar els nostres serveis, Medicnexus.',

		/** campos necesarios */
		'msg_required_summary' => 'Si us plau, Doneu-nos el resum.',
		'msg_required_descrition' => 'Si us plau, Doneu-nos la descripció.',
		'msg_required_speciality' => 'Si us plau seleccioneu una especialitat.',

		/** mensajes */
		'msg_info' => 'message',
		'msg_info_consult_inserted' => 'La consulta ha estat creada correctament.',
		'msg_info_upload_inserted' => 'El fitxer ha estat adjuntat correctament.',
		'msg_error' => 'error',
		'msg_error_consult_inserted' => 'La consulta no s\'ha pogut crear. Consulti els telèfons del lloc per a més informació.',
		'msg_error_empty_data' => 'Hi ha encara dades en el formulari que han de ser omplerts.',
		'msg_error_upload_size' => 'El fitxer a adjuntar sobrepassa la mida màxima possible.',
		'msg_advice' => 'notice',
		'msg_resolved_consult' => 'La consulta es troba en estat "Resolta" pel que les seves dades no podran ser modificats.
									En cas que necessiti afegir informació sobre la mateixa s\'haurà de posar en contacte a través d\'
									els telèfons brindats en l\'àrea Contactes.'
);
?>
