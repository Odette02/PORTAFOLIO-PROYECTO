<?php
session_start();
include 'conexion.php';

$usuario = $_SESSION['usuario'];
$sql = "SELECT retroalimentacion FROM retroalimentacion WHERE usuario='$usuario' ORDER BY fecha DESC LIMIT 1";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    echo "<div class='highlight'><p>" . htmlspecialchars($fila['retroalimentacion']) . "</p></div>";
} else {
    echo "<div class='highlight'><p>No tienes retroalimentaciones aún</p></div>";
}
?>
