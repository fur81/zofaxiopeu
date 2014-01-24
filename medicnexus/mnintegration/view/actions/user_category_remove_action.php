<?php
// se obtienen los datos del formulario
$userCategoryId = $_POST['userCategoryId'];
// se elimina la categoria de usuario
$mantisCore->removeUserCategory($userCategoryId);
?>