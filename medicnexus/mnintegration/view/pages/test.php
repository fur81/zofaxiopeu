<?php
//$client = new SoapClient ("http://localhost/cero/mninside/api/soap/mantisconnect.php?wsdl");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
echo $_POST['casa'];
echo '<br>';
$pos = strlen($_POST['fileAttached']) - 3;
echo $pos;
echo '<br>';
print_r($_FILES);
?>
	<form enctype="multipart/form-data" method="post" action="#">
		<input class="btn" type="file" id="fileAttached" name="fileAttached" /> <input
			class="btn" type="submit" name="uploadFile" value="Upload File">
			<input type="hidden" name="casa" value="casa">
	</form>
</body>
</html>
