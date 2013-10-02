<?php
/**
 * MantisBT Core API's
 */
require_once ('core.php');

require_once ('bug_api.php');

$f_bug_id = gpc_get_int ( 'bug_id' );
$realname = $_POST ['realname'];

// se establece la conexión.
$proxyMySql = new mysqli ( 'localhost', 'root', 'carabobo', 'mninside' );
if (mysqli_connect_errno ()) {
	echo ("Failed to connect, the error message is : " . mysqli_connect_error ());
	exit ();
}

$getReporterIdQuery = 'SELECT reporter_id FROM  mantis_bug_table WHERE  id ='.$f_bug_id;
$result = $proxyMySql->query ( $getReporterIdQuery );
$reporterId = $result->fetch_object ()->reporter_id;

// consultas a la base de datos
$existMedicalRecordQuery = 'SELECT general FROM mantis_user_medical_record WHERE user_id = ' . $reporterId;
$insertMedicalRecordQuery = 'INSERT INTO mantis_user_medical_record (user_id, general) VALUES (' . $reporterId . ', "'. $realname .'")';
$updateMedicalRecordQuery = 'UPDATE mantis_user_medical_record SET general = "'. $realname .'" WHERE user_id =' . $reporterId;



$result = $proxyMySql->query ( $existMedicalRecordQuery );
if ($result->fetch_object ()) {
	// existe y se actualiza
	$proxyMySql->query ( $updateMedicalRecordQuery );
} else {
	// se inserta por primera vez
	$proxyMySql->query ( $insertMedicalRecordQuery );
}

print_successful_redirect_to_bug ( $f_bug_id );
