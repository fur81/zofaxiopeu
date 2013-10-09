<?php
require_once ('core.php');

require_once ('bug_api.php');

require_once( 'current_user_api.php' );

# grab the user id currently logged in
$ownerId = auth_get_current_user_id();

// load data from page
$f_bug_id = gpc_get_int ( 'bug_id' );
$dateOfBirth = $_POST ['dateOfBirth'];
$sex = $_POST['sex'];
$records = $_POST['recordsTextArea'];
$observations = $_POST['observationsTextArea'];

// get connection
include_once 'bug_user_medical_record_config.php';

// get queries
include_once 'bug_user_medical_record_queries.php';

// get reporter id from issue id
$query = str_replace('%value%', $f_bug_id, $reporterIdQuery);
$result = $proxyMySql->query ( $query );
$userId = $result->fetch_object ()->reporter_id;

// know if medical record exist for this user
$query = str_replace('%value%', $userId, $existMedicalRecordQuery);
$result = $proxyMySql->query ( $query );
if ($result->fetch_object ()) {
	// set update query
	$query = $updateMedicalRecordQuery;
} else {
	// set insert query
	$query = $insertMedicalRecordQuery;
}

// execute query
$query = str_replace('%user_id%', $userId, $query);
$query = str_replace('%dateOfBirth%', $dateOfBirth, $query);
$query = str_replace('%sex%', $sex, $query);
$query = str_replace('%records%', $records, $query);
$query = str_replace('%observations%', $observations, $query);
$query = str_replace('%lastUpdate%', microtime(TRUE), $query);
$query = str_replace('%ownerId%', $ownerId, $query);
$proxyMySql->query ( $query );

print_successful_redirect_to_bug ( $f_bug_id );
