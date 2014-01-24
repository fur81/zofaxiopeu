<?php
//se obtienen los datos del formulario
$userId = $_POST['medicoId'];
$categoryId = $_SESSION['categoryId'];
// se adiciona el medico a la categoría
$mantisCore->addUserToCategory($userId, $categoryId);
?>