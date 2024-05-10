function cerrarSesion() {
    // Realizar una solicitud al servidor para cerrar la sesión
    fetch('cerrar_sesion.php', {
        method: 'POST',
    })
    .then(response => {
        if (response.ok) {
            // Redirigir al usuario a la página de inicio de sesión
            window.location.href = 'login.php';
        } else {
            // Manejar cualquier error de cierre de sesión
            console.error('Error al cerrar sesión');
        }
    })
    .catch(error => {
        console.error('Error al cerrar sesión:', error);
    });
}
