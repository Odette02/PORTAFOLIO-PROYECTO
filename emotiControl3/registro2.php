<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = trim($_POST["cedula"]);
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    if (empty($cedula) || empty($nombre) || empty($correo) || empty($password)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo inválido.";
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios_psicologos (cedula, nombre, correo, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $cedula, $nombre, $correo, $passwordHash);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error en la ejecución de la consulta: " . $stmt->error;
    }
    header("Location: emoticontrol2.php");

    $stmt->close();
}

$conn->close();
?>
