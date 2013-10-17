<?php

/*
 * Sample bootstrap file.
 */

// Include the composer autoloader
if(!file_exists(__DIR__ .'/vendor/autoload.php')) {
	echo "The 'vendor' folder is missing. You must run 'composer update --no-dev' to resolve application dependencies.\nPlease see the README for more information.\n";
	exit(1);
}


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/common.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$apiContext = getApiContext();


/**
 * Helper method for getting an APIContext for all calls
 *
 * @return PayPal\Rest\ApiContext
 */
function getApiContext() {
	
	// ### Api context
	// Use an ApiContext object to authenticate 
	// API calls. The clientId and clientSecret for the 
	// OAuthTokenCredential class can be retrieved from 
	// developer.paypal.com

	// sandbox
	$apiContext = new ApiContext(
		new OAuthTokenCredential(
			'AafDsxDBf3aFlXShFlPBWjIYLWlpffOjQ_YVySCcGBrAWsgfJaJ_TJiszPi7',
			'EE2lCxCSyGfI8TPKHRPALfhxcBfqWk6UBeyLSGtLLJWEYSo0xJOsxtApcFd_'
		)
	);

	// live 
	/*
	$apiContext = new ApiContext(
		new OAuthTokenCredential(
			'AfIe-BBKg9DPeRfhQ_E3H5J_ikdgTp5fCt90kgt8yDRUJ-n6QaQmifnSe9EE',
			'EI8n4hBAo_nKcQ3TFOHSMlFMqItsm5PDtRZsH_8y6RPy6noGbBvfTA9Kf-Pc'
		)
	);*/


	// #### SDK configuration
	
	// Comment this line out and uncomment the PP_CONFIG_PATH
	// 'define' block if you want to use static file 
	// based configuration

	$apiContext->setConfig(
		array(
			'mode' => 'sandbox', 
			'http.ConnectionTimeOut' => 30,
			'log.LogEnabled' => true,
			'log.FileName' => '../PayPal.log',
			'log.LogLevel' => 'FINE'
		)
	);
	
	/*
	// Register the sdk_config.ini file in current directory
	// as the configuration source.
	if(!defined("PP_CONFIG_PATH")) {
		define("PP_CONFIG_PATH", __DIR__);
	}
	*/

	return $apiContext;
}
