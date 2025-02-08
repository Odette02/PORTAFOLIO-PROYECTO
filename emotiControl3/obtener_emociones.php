<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    http_response_code(401); 
    exit;
}

$usuario = $_SESSION['usuario'];
$sql = "SELECT emocion, fecha FROM emociones WHERE usuario = '$usuario' ORDER BY fecha DESC";
$result = $conn->query($sql);

$emociones = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emociones[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($emociones);

$conn->close();
?>
