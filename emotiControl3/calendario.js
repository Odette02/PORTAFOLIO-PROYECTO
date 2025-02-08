// Configuración del calendario
var inst = mobiscroll.eventcalendar('#demo-desktop-month-view', {
    locale: mobiscroll.localeEs,
    theme: 'ios',
    themeVariant: 'light',
    clickToCreate: false,
    dragToCreate: false,
    dragToMove: false,
    dragToResize: false,
    eventDelete: false,
    view: {
        calendar: { labels: true, width: 250, height: 330 },
    },
    onEventClick: function (args) {
        mobiscroll.toast({
            message: args.event.title,
        });
    },
    onDataLoaded: function (args) {
        cargarEmociones(); // Llama a la función para cargar emociones después de cargar los datos del calendario
    }
});

function mostrarEmociones(emociones) {
    const events = emociones.map(function(emocion) {
        return {
            start: new Date(emocion.fecha).toISOString(), // Asegúrate de que el formato es correcto
            title: emocion.emocion,
            color: '#4caf50' // Color opcional para diferenciar emociones
        };
    });
    inst.setEvents(events);
}

mobiscroll.getJson(
    'https://trial.mobiscroll.com/events/?vers=5',
    function (events) {
        // Procesar eventos obtenidos de la URL externa si es necesario
    },
    'jsonp'
);
