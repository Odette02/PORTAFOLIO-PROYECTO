<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Colores</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            margin-top: 20px;
        }
        .emotion-button {
            margin: 10px 0;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: block;
            width: 200px;
        }
        .color-picker-container {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }
        .color-picker {
            margin-left: 10px;
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
            echo '<a href="emoticontrol.html">Volver al inicio</a>';
            exit;
        }
    ?>
    <br>
    <br>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="pagina.php">Inicio</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h3>Configura los colores de los botones</h3>
    <div id="buttons-container">
        <!-- Aquí se insertarán los botones y los pickers de color con JavaScript -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttonsContainer = document.getElementById("buttons-container");

    // Define los botones y sus colores por defecto
    const buttons = [
        { emotion: "feliz", color: "#FFFF00", textColor: "#000000" },
        { emotion: "enojado", color: "#FF0000", textColor: "#FFFFFF" },
        { emotion: "triste", color: "#0000FF", textColor: "#FFFFFF" },
        { emotion: "asustado", color: "#FFA500", textColor: "#000000" },
        { emotion: "ansioso", color: "#800080", textColor: "#FFFFFF" }
    ];

    // Crear botones y color pickers
    buttons.forEach(button => {
        const storedColor = localStorage.getItem(button.emotion) || button.color;

        const buttonElement = document.createElement("button");
        buttonElement.className = "emotion-button";
        buttonElement.dataset.emotion = button.emotion;
        buttonElement.style.backgroundColor = storedColor;
        buttonElement.style.color = getContrastColor(storedColor);
        buttonElement.textContent = button.emotion.charAt(0).toUpperCase() + button.emotion.slice(1);

        const colorPickerContainer = document.createElement("div");
        colorPickerContainer.className = "color-picker-container";

        const colorPicker = document.createElement("input");
        colorPicker.type = "color";
        colorPicker.value = storedColor;
        colorPicker.className = "color-picker";
        colorPicker.dataset.emotion = button.emotion;

        // Actualizar el color del botón
        colorPicker.addEventListener("input", function(e) {
            const color = e.target.value;
            const emotion = e.target.dataset.emotion;
            const mainPageButton = document.querySelector(`.emotion-button[data-emotion="${emotion}"]`);
            if (mainPageButton) {
                mainPageButton.style.backgroundColor = color;
                mainPageButton.style.color = getContrastColor(color);
            }

            // Guardar el color en localStorage
            localStorage.setItem(emotion, color);
        });

        colorPickerContainer.appendChild(buttonElement);
        colorPickerContainer.appendChild(colorPicker);
        buttonsContainer.appendChild(colorPickerContainer);
    });

    function getContrastColor(bgColor) {
        const color = bgColor.replace('#', '');
        const r = parseInt(color.substring(0, 2), 16);
        const g = parseInt(color.substring(2, 4), 16);
        const b = parseInt(color.substring(4, 6), 16);
        return (r * 0.299 + g * 0.587 + b * 0.114) > 186 ? 'black' : 'white';
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
