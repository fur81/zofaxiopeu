<?php

if( isset( $_POST['id']) )
// se realiza solo si existe el datos por post
{
	// se incluyen las variables generales
	include_once  $_SERVER['DOCUMENT_ROOT'].'/medicnexus/general_config.php';

	// se crea la conexion a la base de datos
	$proxyMySql = new mysqli(MN_HOST, MN_MANTIS_ROOT_USERNAME, MN_MANTIS_ROOT_PASSWORD, MN_MANTIS_DATABASE);
	if (mysqli_connect_errno()) {
		echo("Failed to connect, the error message is : ". mysqli_connect_error());
		exit();
	}

	// se establece la consulta que se va a realizar
	$query = 'SELECT  user_id, realname FROM mantis_user_table
		INNER JOIN mantis_project_user_list_table ON user_id = id
		WHERE project_id = %value% AND mantis_project_user_list_table.access_level = 55
		ORDER BY realname;';

	// se realiza la consulta en la base de datos
	$result = '';
	try {
		$value = $_POST['id'];
		$query = str_replace ( '%value%', $value, $query );
		$result = $proxyMySql->query ( $query );
		$users = new ArrayObject();
		while ( $data = $result->fetch_object () ) {
			$user = new stdClass();
			$user->id = $data->user_id;
			$user->realname = utf8_encode($data->realname);
			echo '<option value="'.$user->id.'">'.$user->realname.'</option>';
		}
	} catch (Exception $e) {
	}
}
?>