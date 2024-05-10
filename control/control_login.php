<?php
// Inicia la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include("../modelos/conexion.php");

// Verificar si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el usuario y contraseña de la solicitud POST
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = htmlspecialchars($_POST['contrasena']);

    // Verificar si los campos de usuario y contraseña no están vacíos
    if (empty($usuario) || empty($contrasena)) {
        // Establecer un mensaje de error si alguno de los campos está vacío
        $_SESSION['error'] = "Por favor, complete todos los campos.";
        header("Location: ../login.php"); // Redirigir de vuelta a la página de inicio de sesión
        exit; // Salir del script después de la redirección
    }

    // Preparar una consulta SQL para buscar el usuario en la tabla de administradores
    $stmt = $conn->prepare("SELECT usuario FROM admin WHERE usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $resultAdmin = $stmt->get_result();

    // Preparar una consulta SQL para buscar el usuario en la tabla de maestros
    $stmt = $conn->prepare("SELECT nombre, apellido, usuario FROM maestros WHERE usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $resultMaestro = $stmt->get_result();

    // Preparar una consulta SQL para buscar el usuario en la tabla de estudiantes
    $stmt = $conn->prepare("SELECT nombre, apellido, usuario FROM estudiantes WHERE usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $resultEstudiante = $stmt->get_result();

    // Verificar en qué tabla se encontraron las credenciales y asignar el rol correspondiente
    if ($resultAdmin->num_rows == 1) {
        $_SESSION['rol'] = 'admin';
        header("Location: ../screens/dashboard_admin.php"); // Redirigir al dashboard del administrador
        exit; // Salir del script después de la redirección
    } elseif ($resultMaestro->num_rows == 1) {
        // Obtener el nombre y apellido del maestro
        $maestro = $resultMaestro->fetch_assoc();
        $_SESSION['nombreMaestro'] = $maestro['nombre'] . ' ' . $maestro['apellido'];
        $_SESSION['rol'] = 'maestro';
        header("Location: ../screens/dashboard_maestro.php"); // Redirigir al dashboard del maestro
        exit; // Salir del script después de la redirección
    } elseif ($resultEstudiante->num_rows == 1) {
        // Obtener el nombre y apellido del estudiante
        $estudiante = $resultEstudiante->fetch_assoc();
        $_SESSION['nombreEstudiante'] = $estudiante['nombre'] . ' ' . $estudiante['apellido'];
        $_SESSION['rol'] = 'alumno';
        header("Location: ../screens/dashboard_alumno.php"); // Redirigir al dashboard del alumno
        exit; // Salir del script después de la redirección
    } else {
        // Establecer un mensaje de error si las credenciales del usuario son inválidas
        $_SESSION['error'] = "Por favor, revise sus credenciales. Datos Inválidos";
        header("Location: ../login.php"); // Redirigir de vuelta a la página de inicio de sesión
        exit; // Salir del script después de la redirección
    }

    // Cerrar la sentencia SQL
    $stmt->close();
}
?>
