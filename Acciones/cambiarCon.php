<?php 
session_start();
include_once("ConexionBD.php");
$conexion = mysqli_connect("localhost", "root", "", "ecounlz");

if (!empty($_POST["cambiar"])) {
    // Obtener valores del formulario
    $claveNueva = trim($_POST["claveNueva"]);
    $claveNuevaRep = trim($_POST["claveNuevaRep"]);

    // Verificar que las contraseñas coincidan
    if ($claveNueva === $claveNuevaRep) {
        // Preparar la consulta para actualizar la contraseña del usuario
        $consulta = $conexion->prepare("UPDATE usuarios SET clave = ? WHERE email = ?");
        $claveNuevaHasheada = password_hash($claveNueva, PASSWORD_DEFAULT);
        $consulta->bind_param("ss", $claveNuevaHasheada, $_SESSION['email']);
        $consulta->execute();

        // Redirigir al usuario a la página de inicio
        header("Location: index.html");
        exit();
    } else {
        // Si las contraseñas no coinciden, mostrar un mensaje de error
        echo "Las contraseñas no coinciden.";
    }
}

mysqli_close($conexion);
?>