<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece la comunicación con la pasarela de pago Paypal.
 */

try{
	$payment = makePaymentUsingPayPal($idData, $GLOBALS ['CURRENT_PAGE'] . '?success=true&idData=' . $idData,
	$GLOBALS ['CURRENT_PAGE'] . '?success=false&idData=' . $idData);

	$_SESSION['paymentId'] = $payment->getId();

	foreach($payment->getLinks() as $link) {
		if($link->getRel() == 'approval_url') {
			$redirectUrl = $link->getHref();
			break;
		}
	}
	header("Location: " . $redirectUrl);
	exit;
} catch(PayPal\Exception\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}catch (Exception $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}

exit();
