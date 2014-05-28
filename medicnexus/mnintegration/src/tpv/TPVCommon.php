<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece la configuración adecuada para utilizar el servicio
 * de pago TPV.
 * 
 * Los posibles valores son sandbox y live
 * 
 * @param string $enviroment
 */
function setTPVEnviromentConfiguration( $enviroment, $idData ){
	$tpv = new stdClass();
	$tpv->producDescription = $GLOBALS['PAY_NAME']; // descripción del producto
	$tpv->order = $idData; // contador del número del producto
	$tpv->currency = TPV_CURRENCY_EUR; // moneda que se utiliza
	$tpv->import = $GLOBALS['PAY_PRICE']; // precio del producto
	$tpv->email = JFactory::getUser()->email; // correo de la persona que solicita el producto
	$tpv->name = JFactory::getUser()->name; // nombre de la persona que solicita el producto
	$tpv->code = '327367199'; // código obtenido del banco para realizar el servicio
	$tpv->terminal = '001'; // número del terminal utilizado
	$tpv->urlReturn = $GLOBALS ['CURRENT_PAGE']; // dirección de regreso
	$tpv->urlSuccess = $GLOBALS ['CURRENT_PAGE'] . '?success=true&idData=' . $idData; // dirección cuando la operación es exitosa
	$tpv->urlUnsuccess = $GLOBALS ['CURRENT_PAGE'] . '?success=false&idData=' . $idData; // dirección cuando la operación no es exitosa
	$tpv->type = '0';
	$tpv->nameSistem = 'Medicnexus';
	global $lang;
	$tpv->language = $lang; // idioma a mostrar en el sistema
	
	if ( $enviroment == 'sandbox' ){
		$tpv->urlTPV = 'https://sis-t.redsys.es:25443/sis/realizarPago'; // dirección de prueba
		$tpv->clau = 'qwertyasdf0123456789'; // código para hacer pruebas
	}else if ( $enviroment == 'live' ) {
		$tpv->urlTPV = 'https://sis.redsys.es/sis/realizarPago'; // dirección de prueba
		$tpv->clau = 'wefh34523vg534nb4b35'; // código para hacer pruebas
	}
	$tpv->hash = sha1($tpv->import.$tpv->order.$tpv->code.$tpv->currency.$tpv->type.$tpv->urlReturn.$tpv->clau); // código de seguridad
	
	return $tpv;
}
