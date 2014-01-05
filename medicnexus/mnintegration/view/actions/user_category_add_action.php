<?php
// se obtienen los datos del formulario
$name = $_POST['categoryText'];
// se adiciona la categoria
$mantisCore->addUserCategory($name);
?>