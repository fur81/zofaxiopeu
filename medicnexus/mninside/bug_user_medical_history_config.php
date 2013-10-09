<?php
// establish conecction with data base
$proxyMySql = new mysqli ( 'localhost', 'root', 'carabobo', 'mninside' );
if (mysqli_connect_errno ()) {
	echo ("Failed to connect, the error message is : " . mysqli_connect_error ());
	exit ();
}

// queries
// -- get reporter id
$reporterIdQuery = 'SELECT reporter_id FROM  mantis_bug_table WHERE  id = %value%';
$existMedicalRecordQuery = 'SELECT date_of_birth, sex, records, observations FROM mantis_user_medical_record WHERE user_id = %value%';
$insertMedicalRecordQuery = 'INSERT INTO mantis_user_medical_record (user_id, date_of_birth, sex, records, observations, last_update, owner_id) 
							VALUES (%user_id%, "%dateOfBirth%", "%sex%", "%records%", "%observations%", %lastUpdate%, %ownerId%)';
$updateMedicalRecordQuery = 'UPDATE mantis_user_medical_record SET date_of_birth = "%dateOfBirth%",
							sex = "%sex%", records = "%records%", observations = "%observations%", 
							last_update = %lastUpdate%, owner_id = %ownerId% WHERE user_id = %user_id%';