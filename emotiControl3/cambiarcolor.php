<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Colores de la Gráfica</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .color-input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="pag_psico.php">Inicio</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2>Cambiar Colores de la Gráfica</h2>
    <form id="colorForm">
        <div class="form-group color-input">
            <label for="chartBgColor">Color de borde de las barras:</label>
            <input type="color" id="chartBgColor" name="chartBgColor" class="form-control">
        </div>
        <div class="form-group color-input">
            <label for="barColor">Color de las barras:</label>
            <input type="color" id="barColor" name="barColor" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<script>
    document.getElementById('colorForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var chartBgColor = document.getElementById('chartBgColor').value;
        var barColor = document.getElementById('barColor').value;

        localStorage.setItem('chartBgColor', chartBgColor);
        localStorage.setItem('barColor', barColor);

        alert('Colores guardados. Vuelve a la página principal para ver los cambios.');
    });
</script>
</body>
</html>
