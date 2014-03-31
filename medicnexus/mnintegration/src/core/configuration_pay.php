<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

/**
 * En este fichero se establecen las variables utilizadas para las pasarelas
 * de pago. Se encuentran definidos los valores para PayPal y para TPV. Cada
 * variable se encuentra correctamente identificada con un comentario al tipo
 * de pago que pertenece.
 */

// variables de monedas
// -- paypal
define('PAYPAL_CURRENCY_USD', 'USD');
define('PAYPAL_CURRENCY_EUR', 'EUR');
// -- tpv
define('TPV_CURRENCY_EUR', '978');

// second opinion
// -- paypal
define('PAYPAL_PRICE_SECOND_OPINION',       '12.00');
define('PAYPAL_SHIPPING_SECOND_OPINION',     '0.00');
define('PAYPAL_TAX_SECOND_OPINION',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_SECOND_OPINION','12.00');
// -- tpv
define('TPV_PRICE_SECOND_OPINION',       '1200');

// rapid consultation
// -- paypal
define('PAYPAL_PRICE_RAPID_CONSULTATION',       '10.00');
define('PAYPAL_SHIPPING_RAPID_CONSULTATION',     '0.00');
define('PAYPAL_TAX_RAPID_CONSULTATION',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_RAPID_CONSULTATION','10.00');
// -- tpv
define('TPV_PRICE_RAPID_CONSULTATION',       '1000');

// virtual consultation
// -- paypal
define('PAYPAL_PRICE_VIRTUAL_CONSULTATION',       '23.00');
define('PAYPAL_SHIPPING_VIRTUAL_CONSULTATION',     '0.00');
define('PAYPAL_TAX_VIRTUAL_CONSULTATION',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_VIRTUAL_CONSULTATION','23.00');
// -- tpv
define('TPV_PRICE_VIRTUAL_CONSULTATION',       '2300');

// health program
// -- paypal
define('PAYPAL_PRICE_HEALTH_PROGRAM',        '6.00');
define('PAYPAL_SHIPPING_HEALTH_PROGRAM',     '0.00');
define('PAYPAL_TAX_HEALTH_PROGRAM',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_HEALTH_PROGRAM', '6.00');
// -- tpv
define('TPV_PRICE_HEALTH_PROGRAM',        '600');