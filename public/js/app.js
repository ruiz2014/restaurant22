function notify(){
    if (!("Notification" in window)) {
        alert(
        "Este navegador no es compatible con las notificaciones de escritorio",
        );
    }

    // Comprobamos si los permisos han sido concedidos anteriormente
    else if (Notification.permission === "granted") {
        // Si es correcto, lanzamos una notificación
        var img = "https://cvbox.org/_next/image?url=%2Fimages%2Flogo.png&w=256&q=75";
        var text = '¡OYE! Atiende la mesa pedaso de mierda...';
        var notification = new Notification("¡Hola normal!", {
                body: text,
                icon: img,
        });
    }

    // Si no, pedimos permiso para la notificación
    else if (Notification.permission !== "denied") {
        var img = "https://cvbox.org/_next/image?url=%2Fimages%2Flogo.png&w=256&q=75";
        var text = '¡OYE! Tu tarea ahora está vencida.';
        Notification.requestPermission().then(function (permission) {
        // Si el usuario nos lo concede, creamos la notificación
        if (permission === "granted") {
            var notification = new Notification("¡Hola al solicitar!", {
                body: text,
                icon: img,
            });
        }
        });
    }
}