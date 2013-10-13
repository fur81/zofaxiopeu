<?php
// establish conecction with data base
$proxyMySql = new mysqli ( 'localhost', 'mninside', 'm4nt1s#2013', 'mninside' );
if (mysqli_connect_errno ()) {
	echo ("Failed to connect, the error message is : " . mysqli_connect_error ());
	exit ();
}
