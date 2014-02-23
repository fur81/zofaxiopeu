<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

// variables de paypal
// -- monedas
define('PAYPAL_CURRENCY_USD', 'USD');
define('PAYPAL_CURRENCY_EUR', 'EUR');

// second opinion
define('PAYPAL_PRICE_SECOND_OPINION',       '12.00');
define('PAYPAL_SHIPPING_SECOND_OPINION',     '0.00');
define('PAYPAL_TAX_SECOND_OPINION',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_SECOND_OPINION','12.00');
define('PAYPAL_NAME_SECOND_OPINION', 'Segunda Opinión');
define('PAYPAL_DESCRIPTION_SECOND_OPINION', 'Los médicos dan una segunda opinión del servicio.');

// rapid consultation
define('PAYPAL_PRICE_RAPID_CONSULTATION',       '10.00');
define('PAYPAL_SHIPPING_RAPID_CONSULTATION',     '0.00');
define('PAYPAL_TAX_RAPID_CONSULTATION',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_RAPID_CONSULTATION','10.00');
define('PAYPAL_NAME_RAPID_CONSULTATION', 'Consulta Rápida');
define('PAYPAL_DESCRIPTION_RAPID_CONSULTATION', 'Los médicos brindan una consulta rápida para necesidades inmediatas.');

// virtual consultation
define('PAYPAL_PRICE_VIRTUAL_CONSULTATION',       '23.00');
define('PAYPAL_SHIPPING_VIRTUAL_CONSULTATION',     '0.00');
define('PAYPAL_TAX_VIRTUAL_CONSULTATION',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_VIRTUAL_CONSULTATION','23.00');
define('PAYPAL_NAME_VIRTUAL_CONSULTATION', 'Consulta Virtual');
define('PAYPAL_DESCRIPTION_VIRTUAL_CONSULTATION', 'Los médicos brindan una consulta virtual para los clientes.');

// health program
define('PAYPAL_PRICE_HEALTH_PROGRAM',        '6.00');
define('PAYPAL_SHIPPING_HEALTH_PROGRAM',     '0.00');
define('PAYPAL_TAX_HEALTH_PROGRAM',          '0.00');
define('PAYPAL_TOTAL_AMOUNT_HEALTH_PROGRAM', '6.00');
define('PAYPAL_NAME_HEALTH_PROGRAM', 'Programa de Salud');
define('PAYPAL_DESCRIPTION_HEALTH_PROGRAM', 'Se brinda un programa de salud para los consultantes.');
