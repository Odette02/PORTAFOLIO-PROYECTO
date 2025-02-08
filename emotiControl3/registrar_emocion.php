<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    http_response_code(401); 
    exit;
}

$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['emocion']) && !empty($_POST['emocion'])) {
        $emocion = $_POST['emocion'];

        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y-m-d');
        $datetime = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO emociones (usuario, emocion, fecha, datetime) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die('Error en prepare: ' . $conn->error);
        }

        $stmt->bind_param('ssss', $usuario, $emocion, $fecha, $datetime);

        if ($stmt->execute()) {
            echo "Emoción registrada correctamente";
        } else {
            echo "Error al registrar la emoción: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Datos incompletos";
    }
} else {
    echo "Método de solicitud no permitido";
}

$conn->close();
?>
