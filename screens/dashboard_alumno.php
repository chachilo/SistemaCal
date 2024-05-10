<?php 
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'alumno') {
    // Si no ha iniciado sesión como alumno, redirigir a la página de inicio de sesión
    header("Location: ../login.php");
    exit; // Salir del script después de la redirección
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Estudiante</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/funciones.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Dashboard del Estudiante</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Calificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contraseña</a>
                </li>
                <!-- Agregar más opciones de menú según sea necesario -->
            </ul>
            <span class="navbar-text mr-3">
                Bienvenido, <?php echo $_SESSION['nombreEstudiante']; ?>
            </span>
            <form class="form-inline my-2 my-lg-0" action="../cerrar_sesion.php" method="POST">
            <button class="btn btn-outline-light my-2 my-sm-0 mr-2" type="submit" onclick="return confirm('¿Estás seguro de que deseas cerrar la sesión?')">Cerrar Sesión</button>
            </form>
        </div>
    </nav>


    <div class="container mt-4">
        <h1>Bienvenido, Estudiante</h1>
        <p>Contenido del dashboard para el Estudiante.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>