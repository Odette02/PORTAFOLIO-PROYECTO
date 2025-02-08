<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    echo "No has iniciado sesión.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retroalimentacion'])) {
    $usuario = $_SESSION['usuario'];
    $retroalimentacion = $_POST['retroalimentacion'];
    $fecha = date('Y-m-d H:i:s');

    $conn = new mysqli($servidor, $usuario, $password, $base);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO retroalimentacion (usuario, retroalimentacion, fecha) VALUES ('$usuario', '$retroalimentacion', '$fecha')";
    if ($conn->query($sql) === TRUE) {
        echo "Retroalimentación guardada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Datos inválidos.";
}
?>
