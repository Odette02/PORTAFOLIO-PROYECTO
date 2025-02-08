<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            margin-top: 70px; 
            flex: 1;
            overflow-y: auto;
        }
        textarea {
            width: 100%;
            height: 300px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 1em;
            box-sizing: border-box;
        }
        .saved-notes {
            margin-top: 20px;
            border-top: 1px solid #ced4da;
            padding-top: 10px;
        }
        .note-item {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            position: relative;
        }
        .note-item:hover {
            background-color: #f1f1f1;
        }
        .note-delete {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            color: red;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">  
    <?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        echo "<div class='highlight'><p><b>Hola Psic. " . $_SESSION['usuario'] . " Bienvenid@</p></b></div>";
    } else {
        echo "<div class='highlight'><p>No has iniciado sesión.</p></div>";
        echo '<a href="emoticontrol2.html">Volver al inicio</a>';
        exit;
    }
    ?>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="pag_psico.php">Inicio</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Bloc de Notas</h2>
    <form id="blocForm">
        <textarea id="noteContent" placeholder="Escribe tus notas aquí..."></textarea>
        <button type="submit" class="btn btn-primary mt-3">Guardar Nota</button>
    </form>
    
    <div class="saved-notes">
        <h3>Notas Guardadas</h3>
        <ul id="notesList" class="list-unstyled"></ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadSavedNotes();
    });

    document.getElementById('blocForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var noteContent = document.getElementById('noteContent').value.trim();

        if (noteContent !== '') {
            saveNoteToList(noteContent);
            document.getElementById('noteContent').value = ''; // Limpiar el textarea
        } else {
            alert('La nota está vacía. No se puede guardar.');
        }
    });

    function loadSavedNotes() {
    var notesList = document.getElementById('notesList');
    var savedNotes = JSON.parse(localStorage.getItem('savedNotes')) || [];

    notesList.innerHTML = ''; // Limpiar la lista antes de cargar las notas

    savedNotes.forEach(function(note, index) {
            var li = document.createElement('li');
            li.classList.add('note-item');
            li.innerHTML = note + ' <span class="note-delete" onclick="deleteNote(' + index + ')">X</span>';
            notesList.appendChild(li);
        });
    }


    function saveNoteToList(noteContent) {
        var savedNotes = JSON.parse(localStorage.getItem('savedNotes')) || [];
        savedNotes.push(noteContent);
        localStorage.setItem('savedNotes', JSON.stringify(savedNotes));
        loadSavedNotes();
    }


        function deleteNote(index) {
        var savedNotes = JSON.parse(localStorage.getItem('savedNotes')) || [];
        savedNotes.splice(index, 1);
        localStorage.setItem('savedNotes', JSON.stringify(savedNotes));
        loadSavedNotes();
    }

</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
