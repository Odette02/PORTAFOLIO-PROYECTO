<?php
$servidor = "fdb1028.awardspace.net"; // o "localhost"
$puerto = "3306"; // puerto MySQL 
$usuario = "4560070_registroji";
$password = "i9290Iq.";
$base = "4560070_registroji";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $password, $base, $puerto);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
