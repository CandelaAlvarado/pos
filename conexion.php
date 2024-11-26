<?php

$host = 'localhost';
$user = 'root';
$password = 'osc';  
$database = 'pos';

$conexion = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>