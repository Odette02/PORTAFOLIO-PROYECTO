<?php
// Aquí puedes agregar cualquier lógica PHP si es necesario, como incluir archivos, etc.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información sobre Emociones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            margin-top: 30px;
        }
        .emotion-info {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .emotion-info h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #007bff;
        }
        .emotion-info h3 {
            margin-top: 20px;
            font-size: 1.25rem;
            color: #495057;
        }
        .emotion-info p {
            font-size: 1rem;
            line-height: 1.6;
        }
        .emotion-wheel {
            text-align: center;
            margin-top: 30px;
        }
        .emotion-wheel h2 {
            font-size: 1.5rem;
            color: #007bff;
        }
        .emotion-wheel img {
            width: 60%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="pagina.php">Inicio</a>
            </li>
        </ul>
    </div>
</nav>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Información sobre las Emociones</h1>
        <div class="emotion-info">
            <h2>Comprendiendo las Emociones</h2>
            <p>Las emociones son reacciones psicofisiológicas a experiencias y estímulos, y juegan un papel fundamental en nuestra vida diaria. Identificar y entender estas emociones es crucial para proporcionar un apoyo eficaz en el ámbito psicológico.</p>
            <p>A continuación se describen algunas emociones comunes, sus características y señales típicas para ayudar en su identificación.</p>

            <div>
                <h3>Felicidad</h3>
                <p>La felicidad se manifiesta como un sentimiento de alegría, bienestar y satisfacción. Es común observar sonrisas genuinas, risa, y una actitud positiva. Los individuos felices tienden a tener un comportamiento más sociable y abierto.</p>
            </div>
            <div>
                <h3>Tristeza</h3>
                <p>La tristeza se caracteriza por una sensación de desánimo y decaimiento. Las señales típicas incluyen llanto, disminución de energía y un comportamiento más retraído. Las personas tristes a menudo tienen dificultades para encontrar placer en actividades que normalmente disfrutan.</p>
            </div>
            <div>
                <h3>Enojo</h3>
                <p>El enojo se manifiesta a través de una expresión facial tensa, voz elevada y lenguaje corporal agitado. Esta emoción puede llevar a reacciones impulsivas y a veces destructivas. Las personas enojadas pueden tener una actitud confrontativa y pueden sentirse fácilmente frustradas.</p>
            </div>
            <div>
                <h3>Miedo</h3>
                <p>El miedo puede causar palidez, temblores y una actitud de evasión. Las personas que sienten miedo suelen estar en alerta constante y pueden evitar situaciones que les resulten amenazantes. El miedo puede desencadenar respuestas de lucha o huida y afectar la capacidad de concentración.</p>
            </div>
            <div>
                <h3>Ansiedad</h3>
                <p>La ansiedad se caracteriza por una sensación de inquietud y preocupación constante. Los signos pueden incluir sudoración excesiva, nerviosismo, y dificultad para relajarse. Las personas ansiosas a menudo anticipan problemas futuros y pueden experimentar síntomas físicos como palpitaciones.</p>
            </div>
            <div>
                <h3>Calma</h3>
                <p>La calma es un estado de tranquilidad y equilibrio emocional. Las personas que están calmadas suelen mostrar una respiración relajada y un lenguaje corporal sereno. La calma ayuda en la toma de decisiones y en el manejo de situaciones estresantes.</p>
            </div>
        </div>

        <div class="emotion-wheel">
            <h2>Ruleta de Emociones</h2>
            <p>Utiliza nuestra ruleta de emociones para explorar diferentes emociones y sus características. Esta herramienta te ayudará a identificar y entender mejor las emociones en distintas situaciones.</p>
            <img src="https://z5i2z2q6.rocketcdn.me/wp-content/uploads/2023/08/ES-emotion-wheel.png.webp" alt="Ruleta de Emociones">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
