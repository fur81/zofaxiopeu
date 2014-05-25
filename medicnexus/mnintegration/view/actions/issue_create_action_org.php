<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Acción  para registrar una consulta. En el registro se salva la información
 * correspondiente al tipo de pago seleccionado. Existen dos tipos de pagos
 * uno por PayPal y otro por TPV.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */

// se chequea si se realizó el pago o no
if ( isset($_GET['success'])) {
	if ($_GET['success'] == 'true') {
		// se carga la información temporal
		$issueData = $mantisCore->loadTempData($_GET['idData']);
		// se crean las variables existentes en la información temporal
		$summary = $issueData['summary'];
		$description = $issueData['description'];
		$specialistId = $issueData['specialistId'];
		$paymentType = $issueData['paymentType'];
		$projectId = $issueData['projectId'];
		// se establecen los valores de pago
		setProjectPaypalConfiguration( $paymentType );
		// se crea la incidencia con la información almacenada
		$mantisCore->addIssue($summary, $description, $projectId, $specialistId);
		// se envia un mensaje al usuario del registro realizado
		$mantisCore->sendEmail($summary, $description, $projectId, $specialistId, $GLOBALS['PAY_NAME'],
							$GLOBALS['PAY_PRICE'], $GLOBALS['PAY_TAX'], $GLOBALS['PAY_TOTAL_AMOUNT']);
		// se envia un mensaje de terminacion correcta
		$_SESSION ['msg'] = 'msg_info_consult_inserted';
	}else{
		$_SESSION ['msg'] = 'msg_error_consult_inserted';
	}
	// se eliminan los valores del temporal
	$mantisCore->removeTempData($_GET['idData']);
	$url = strtok(JFactory::getURI(), '?');
	header ( 'Location: ' . $url);
	exit();
} else {
	// se obtienen los datos del formulario
	$summary = $_POST['summaryText'];
	$description = $_POST['descriptionTextArea'];
	$specialistId = $_POST['specialist'];
	$projectId = $_POST['subproject'];
	$paymentType = $_POST['paymentType'];
	$_SESSION['subProjectId'] = $projectId;
	// se establecen los valores de pago
	setProjectPaypalConfiguration( $paymentType );
	// se salva la información el la base de datos
	$idData = $mantisCore->saveIssueCreateData($summary, $description, $projectId, $specialistId, $paymentType);
	if ( $paymentType == MN_PAY_TPV ) {
		include_once ( $GLOBALS['TPV_REQUEST_CLIENT_ZONE'] ); // se carga el servicio tpv
	}else if( $paymentType == MN_PAY_PAYPAL ) {
		include_once $GLOBALS['PAYPAL_REQUEST_CLIENT_ZONE']; // se carga el servicio paypal
	}
	exit();
}
?>
