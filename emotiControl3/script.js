document.addEventListener('DOMContentLoaded', function() {
    // Cargar emociones desde el servidor y mostrar en el calendario
    cargarEmociones();

    // Añadir el manejador de eventos de clic a los botones de emoción
    document.querySelectorAll('.emotion-button').forEach(button => {
        button.addEventListener('click', () => {
            const emotion = button.dataset.emotion;
            registrarEmocion(emotion);
        });
    });
});

function registrarEmocion(emocion) {
    console.log('Registrando emoción:', emocion);
    fetch('registrar_emocion.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ emocion })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta de la red');
        }
        return response.text(); // Opcional: puedes manejar la respuesta si es necesario
    })
    .then(() => {
        alert('Emoción registrada: ' + emocion);
        cargarEmociones(); // Recargar las emociones para actualizar el calendario
    })
    .catch(error => {
        console.error('Error al registrar la emoción:', error);
        alert('Error al registrar la emoción: ' + error.message);
    });
}

function cargarEmociones() {
    fetch('obtener_emociones.php')
    .then(response => response.json())
    .then(emociones => mostrarEmociones(emociones))
    .catch(error => console.error('Error al cargar emociones:', error));
}

function mostrarEmociones(emociones) {
    inst.setEvents(emociones.map(emocion => ({
        start: new Date(emocion.fecha).toISOString(),
        title: emocion.emocion,
        color: '#4caf50'
    })));
}

// Mostrar mensaje de inicio de sesión exitoso si se pasa el parámetro 'login=success'
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('login') === 'success') {
    const mensaje = document.getElementById("inicioSesionExitoso");
    if (mensaje) {
        mensaje.style.display = "block";
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll(".emotion-button");

    buttons.forEach(button => {
        const emotion = button.dataset.emotion;
        const storedColor = localStorage.getItem(emotion);

        if (storedColor) {
            button.style.backgroundColor = storedColor;
            button.style.color = getContrastColor(storedColor);
        }
    });

    function getContrastColor(bgColor) {
        const color = bgColor.replace('#', '');
        const r = parseInt(color.substring(0, 2), 16);
        const g = parseInt(color.substring(2, 4), 16);
        const b = parseInt(color.substring(4, 6), 16);
        return (r * 0.299 + g * 0.587 + b * 0.114) > 186 ? 'black' : 'white';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Función para cargar la retroalimentación más reciente
    function cargarRetroalimentacionReciente() {
        const retroalimentacionDiv = document.getElementById('retroalimentacion');

        fetch('cargar_retroalimentacion.php')
            .then(response => response.text())
            .then(data => {
                retroalimentacionDiv.innerHTML = data;
            })
            .catch(error => console.error('Error al cargar la retroalimentación:', error));
    }

    // Cargar la retroalimentación al cargar la página
    cargarRetroalimentacionReciente();

    // Botón para ver todas las retroalimentaciones
    const verTodasBtn = document.getElementById('ver-todas');
    const todasRetroalimentacionesDiv = document.getElementById('todas-retroalimentaciones');

    verTodasBtn.addEventListener('click', function() {
        if (todasRetroalimentacionesDiv.style.display === 'none') {
            todasRetroalimentacionesDiv.style.display = 'block';
            verTodasBtn.textContent = 'Ocultar retroalimentaciones';
        } else {
            todasRetroalimentacionesDiv.style.display = 'none';
            verTodasBtn.textContent = 'Ver todas las retroalimentaciones';
        }
    });
});

