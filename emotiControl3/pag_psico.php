<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agregar Retroalimentación</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-image: url('https://neopraxis.mx/wp-content/uploads/2022/05/controla-tus-emociones-1024x551.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            min-height: 100vh; 
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .content {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 80%;
            margin: 20px;
        }
        select, input[type="submit"], textarea {
            font-size: 0.8em;
            padding: 5px;
            margin: 5px;
            width: 150px;
        }
        .container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }
        .table-container {
            flex: 1;
            margin-right: 10px;
        }
        .chart-container {
            flex: 1;
            max-width: 400px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
<?php
    session_start();
    include 'conexion.php';  

    if (isset($_SESSION['usuario'])) {
         echo "<div class='highlight'><p><b>Hola, " . $_SESSION['usuario'] . " Bienvenid@</p></b></div>";
    } else {
        echo "<div class='highlight'><p>No has iniciado sesión.</p></div>";
        echo '<a href="emoticontrol2.php">Volver al inicio</a>';
        exit;
    }
    ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Configuración
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="bloc.php">Bloc</a>
                    <a class="dropdown-item" href="cerrarsesion2.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="content">
    <h2>Emociones Registradas y Retroalimentación</h2>
    <?php
    session_start();
    require 'conexion.php';

    // Verifica si la sesión está iniciada
    if (!isset($_SESSION['usuario'])) {
        echo "<div class='highlight'><p>No has iniciado sesión.</p></div>";
        echo '<a href="emoticontrol2.php">Volver al inicio</a>';
        exit;
    }

    // Obtener la cédula del psicólogo
    $nombre_psicologo = $_SESSION['usuario'];
    $sql = "SELECT cedula FROM usuarios_psicologos WHERE nombre = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $nombre_psicologo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cedula_psicologo = $row['cedula'];

        // Buscar pacientes con la cédula del psicólogo
        $sql_pacientes = "SELECT id, nombre FROM usuarios WHERE psicologo_cedula = ?";
        $stmt_pacientes = $conn->prepare($sql_pacientes);

        if ($stmt_pacientes === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt_pacientes->bind_param("s", $cedula_psicologo);
        $stmt_pacientes->execute();
        $result_pacientes = $stmt_pacientes->get_result();

        echo "<h3>Seleccionar Usuario</h3>";
        echo "<form method='GET' action=''>";
        echo "<select name='usuario'>";
        while ($row = $result_pacientes->fetch_assoc()) {
            echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Ver Emociones'>";
        echo "</form>";

        $stmt_pacientes->close();
    } else {
        echo "<p>No se encontró el psicólogo.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>

    <!-- Formulario de selección de usuario -->
    <?php
    session_start();
    require 'conexion.php';

    // Verifica si se ha seleccionado un usuario
    if (isset($_GET['usuario'])) {
        $usuario = $conn->real_escape_string($_GET['usuario']);
        $fecha_inicio = isset($_GET['fecha_inicio']) ? $conn->real_escape_string($_GET['fecha_inicio']) : '';
        $fecha_fin = isset($_GET['fecha_fin']) ? $conn->real_escape_string($_GET['fecha_fin']) : '';

        // Obtener emociones del usuario seleccionado
        $sql_emociones = "SELECT emocion, fecha FROM emociones WHERE usuario = '$usuario'";

        if ($fecha_inicio && $fecha_fin) {
            $sql_emociones .= " AND fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        }

        $result_emociones = $conn->query($sql_emociones);

        $emociones_data = [];

        echo "<h3>Filtrar Emociones por Fecha</h3>";
        echo "<form method='GET' action=''>";
        echo "<input type='hidden' name='usuario' value='$usuario'>";
        echo "<label for='fecha_inicio'>Fecha Inicio:</label>";
        echo "<input type='date' id='fecha_inicio' name='fecha_inicio' value='$fecha_inicio'>";
        echo "<label for='fecha_fin'>Fecha Fin:</label>";
        echo "<input type='date' id='fecha_fin' name='fecha_fin' value='$fecha_fin'>";
        echo "<input type='submit' value='Filtrar'>";
        echo "</form>";

        echo "<div class='container'>";
        echo "<div class='table-container'>";
        echo "<h3>Emociones Registradas</h3>";
        if ($result_emociones->num_rows > 0) {
            echo "<table border='1'><tr><th>Emoción</th><th>Fecha</th></tr>";
            while ($row = $result_emociones->fetch_assoc()) {
                echo "<tr><td>" . $row['emocion'] . "</td><td>" . $row['fecha'] . "</td></tr>";
                $emociones_data[] = $row;
            }
            echo "</table>";
        } else {
            echo "<p>No hay emociones registradas.</p>";
        }
        echo "</div>";

        // Convertir el array PHP a JSON para usarlo en JavaScript
        $emociones_json = json_encode($emociones_data);

        echo "<div class='chart-container'>";
        echo "<h3>Gráfica de Emociones</h3>";
        echo "<canvas id='emocionesChart'></canvas>";
        echo "</div>";
        echo "</div>";

        // Formulario para enviar retroalimentación
        echo "<h3>Enviar Retroalimentación</h3>";
        echo "<form method='POST' action=''>";
        echo "<textarea name='retroalimentacion' rows='4' cols='50'></textarea><br>";
        echo "<input type='hidden' name='usuario' value='$usuario'>";
        echo "<input type='submit' value='Enviar'>";
        echo "</form>";

        // Guardar retroalimentación en la base de datos
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retroalimentacion'])) {
            $retroalimentacion = $conn->real_escape_string($_POST['retroalimentacion']);
            $usuario = $conn->real_escape_string($_POST['usuario']);
            $fecha = date('Y-m-d');

            $sql_insert_retroalimentacion = "INSERT INTO retroalimentacion (usuario, retroalimentacion, fecha) VALUES ('$usuario', '$retroalimentacion', '$fecha')";
            if ($conn->query($sql_insert_retroalimentacion) === TRUE) {
                echo "<p>Retroalimentación enviada exitosamente.</p>";
            } else {
                echo "<p>Error al enviar la retroalimentación: " . $conn->error . "</p>";
            }
        }
    }
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emocionesData = <?php echo json_encode($emociones_data); ?>;
        const labels = [];
        const counts = {};

        emocionesData.forEach(emotion => {
            if (counts[emotion.emocion]) {
                counts[emotion.emocion]++;
            } else {
                counts[emotion.emocion] = 1;
                labels.push(emotion.emocion);
            }
        });

        const data = {
            labels: labels,
            datasets: [{
                label: 'Frecuencia de Emociones',
                data: labels.map(emotion => counts[emotion]),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const ctx = document.getElementById('emocionesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
