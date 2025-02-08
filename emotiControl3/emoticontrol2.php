<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Registro Psicologo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="icon" href="emoti.ico" type="image/x-icon">
</head>
<body>
    <a href="emoticontrol.php" class="home-button">Login Usuarios</a>

<div id="registroForm">
    <h2>Bienvenido a EmotiControl</h2>
    <form action="registro2.php" method="post">
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required> 

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

    <h4>Ya tienes una cuenta?</h4>
    <button type="button" onclick="mostrarLogin()">Iniciar Sesion</button>
</div>

<div id="loginForm" style="display: none;">
    <h2>Iniciar Sesion</h2>
    <form action="login2.php" method="post">
        <label for="correoLogin">Correo Electrónico:</label>
        <input type="email" id="correoLogin" name="correo" required>

        <label for="passwordLogin">Password:</label>
        <input type="password" id="passwordLogin" name="password" required>
        <br><br>
        <input type="submit" value="Iniciar Sesion">
    </form>
    <h4>Aun no tienes una cuenta?</h4> 
    <button type="button" onclick="mostrarRegistro()">Registrar</button>
</div>

<script>
    function mostrarLogin() {
        document.getElementById("registroForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
    }

    function mostrarRegistro() {
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("registroForm").style.display = "block";
    }
</script>



</body>
</html>
