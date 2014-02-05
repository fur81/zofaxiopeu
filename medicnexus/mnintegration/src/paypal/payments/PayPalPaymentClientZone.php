<?php

require __DIR__ . '/../bootstrap.php';
//include_once './../../core/configuration_paypal.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
//session_start();

// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName($GLOBALS['PAYPAL_NAME'])
	->setCurrency(PAYPAL_CURRENCY_EUR)
	->setQuantity(1)
	->setPrice($GLOBALS['PAYPAL_PRICE']);

$itemList = new ItemList();
$itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setTax($GLOBALS['PAYPAL_TAX'])
	->setSubtotal(PAYPAL_PRICE_SECOND_OPINION);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency(PAYPAL_CURRENCY_EUR)
	->setTotal($GLOBALS['PAYPAL_PRICE'])
	->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription(PAYPAL_DESCRIPTION_SECOND_OPINION);

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($GLOBALS ['CURRENT_PAGE'] . '?success=true&idData=' . $idData)
	->setCancelUrl($GLOBALS ['CURRENT_PAGE'] . '?success=false&idData=' . $idData);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("sale")
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions(array($transaction));

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
try {
	$payment->create($apiContext);
} catch (PayPal\Exception\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());	
	exit(1);
}

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getLinks()
// method
foreach($payment->getLinks() as $link) {
	if($link->getRel() == 'approval_url') {
		$redirectUrl = $link->getHref();
		break;
	}
}

// ### Redirect buyer to PayPal website
// Save the payment id so that you can 'complete' the payment
// once the buyer approves the payment and is redirected
// back to your website.
//
// It is not a great idea to store the payment id
// in the session. In a real world app, you may want to 
// store the payment id in a database.
$_SESSION['paymentId'] = $payment->getId();
if(isset($redirectUrl)) {
	header("Location: $redirectUrl");
	exit;
}
