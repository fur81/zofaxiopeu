<?php

// queries
// -- get reporter id
$reporterIdQuery = 'SELECT reporter_id FROM  mantis_bug_table WHERE  id = %value%';
// -- get medical history from user id
$existMedicalRecordQuery = 'SELECT date_of_birth, sex, records, observations FROM mantis_user_medical_record WHERE user_id = %value%';
// -- insert new medical history
$insertMedicalRecordQuery = 'INSERT INTO mantis_user_medical_record (user_id, date_of_birth, sex, records, observations, last_update, owner_id)
							VALUES (%user_id%, "%dateOfBirth%", "%sex%", "%records%", "%observations%", %lastUpdate%, %ownerId%)';
// -- update new medical history
$updateMedicalRecordQuery = 'UPDATE mantis_user_medical_record SET date_of_birth = "%dateOfBirth%",
							sex = "%sex%", records = "%records%", observations = "%observations%",
							last_update = %lastUpdate%, owner_id = %ownerId% WHERE user_id = %user_id%';