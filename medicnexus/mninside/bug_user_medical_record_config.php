<?php
// se establece la conexión con la base de datos
$proxyMySql = new mysqli ( MN_MYSQL_HOST, MN_MYSQL_USER, MN_MYSQL_PASSWORD, MN_MANTIS_DATABASE );
if (mysqli_connect_errno ()) {
	echo ("Failed to connect, the error message is : " . mysqli_connect_error ());
	exit ();
}
