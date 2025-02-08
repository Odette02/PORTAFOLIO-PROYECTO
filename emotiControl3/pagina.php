<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    <link rel="icon" href="emoti.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-image: url('https://clicklashandbrow.es/wp-content/uploads/2020/11/E75B621D-F317-4302-8C9A-7341632C9553.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            min-height: 100vh; 
            overflow: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            width: 100%;
        }
        .content {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 80%;
            margin: 20px;
        }
        .highlight {
            background-color: rgba(255, 255, 255, 0.5); /* Fondo blanco semitransparente */
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            max-width: 80%;
            margin: 20px auto;
        }
        label {
            display: block;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.3);
            margin-bottom: 20px;
        }
        label h3 {
            margin: 0 0 10px 0;
        }
        .remote-control {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }
        .emotion-button {
            margin: 5px;
            position: relative;
        }
        .color-picker {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php
    session_start();
    include 'conexion.php';  

    if (isset($_SESSION['usuario'])) {
         echo "<div class='highlight'><p><b>Hola, " . $_SESSION['usuario'] . " Bienvenid@</p></b></div>";
    } else {
        echo "<div class='highlight'><p>No has iniciado sesión.</p></div>";
        echo '<a href="emoticontrol.php">Volver al inicio</a>';
        exit;
    }
    ?>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="emoticontrol.html"></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Configuración
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="cambiar-colores.php">Cambiar Color</a>
                 <a class="dropdown-item" href="info.php">Como identifico mis emociones?</a>
                 <a class="dropdown-item" href="tips.php">Tips</a>
                 <a class="dropdown-item" href="cerrarsesion.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="content">
    <div id="inicioSesionExitoso" style="display: none;">
        <div id="inicioSesionExitosoContent">
            <p>¡Inicio de sesión exitoso!</p>
            <button onclick="cerrarMensajeInicioSesion()">Cerrar</button>
        </div>
    </div>

    <label for="emotion-buttons">
    <div>
        <h3>Registra tu emoción</h3>
        <div class="remote-control">
            <button class="emotion-button" data-emotion="feliz" style="background-color: yellow; color: black;">Feliz</button>
            <button class="emotion-button" data-emotion="enojado" style="background-color: red; color: white;">Enojado</button>
            <button class="emotion-button" data-emotion="triste" style="background-color: blue; color: white;">Triste</button>
            <button class="emotion-button" data-emotion="asustado" style="background-color: orange; color: black;">Asustado</button>
            <button class="emotion-button" data-emotion="ansioso" style="background-color: purple; color: white;">Ansioso</button>
        </div>
    </div>
    </label>

    <div>
        <h3>Emociones del Mes</h3>
        <div id="demo-desktop-month-view" style="width: 250px; height: 330px;"></div>
    </div>

    <div id="retroalimentacion">
    <!-- Aquí se cargará la retroalimentación más reciente -->
</div>
<button id="ver-todas">Ver retroalimentaciones anteriores</button>
<div id="todas-retroalimentaciones" style="display:none;">
    <?php
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT retroalimentacion FROM retroalimentacion WHERE usuario='$usuario' ORDER BY fecha DESC";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<div class='highlight'><p>" . htmlspecialchars($fila['retroalimentacion']) . "</p></div>";
        }
    } else {
        echo "<div class='highlight'><p>No tienes retroalimentaciones aún</p></div>";
    }
    ?>
</div>


    <link href="css/mobiscroll.javascript.min.css" rel="stylesheet" />
    <script src="js/mobiscroll.javascript.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script> 
    <script src="calendario.js"></script>
</div>

</body>
</html>
