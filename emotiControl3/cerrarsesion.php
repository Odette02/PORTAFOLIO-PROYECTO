<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
header('Location: emoticontrol.php'); // Redirige al usuario a la página de inicio o la que prefieras
exit(); // Asegúrate de que no se ejecute ningún otro código
?>
