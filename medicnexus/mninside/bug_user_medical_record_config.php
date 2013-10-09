<?php
// establish conecction with data base
$proxyMySql = new mysqli ( 'localhost', 'root', 'carabobo', 'mninside' );
if (mysqli_connect_errno ()) {
	echo ("Failed to connect, the error message is : " . mysqli_connect_error ());
	exit ();
}
