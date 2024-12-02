<?php 
session_start();
include_once("ConexionBD.php");
$conexion = mysqli_connect("localhost", "root", "", "ecounlz");

if (!empty($_POST["recuperar"])) {
    // Obtener valores del formulario
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $dni = trim($_POST["DNI"]);

    // Preparar la consulta para obtener el DNI y la contraseña encriptada del usuario
    $consulta = $conexion->prepare("SELECT DNI, clave FROM usuarios WHERE email = ?");
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows === 1) {
        // El usuario existe, verificar el DNI
        $consulta->bind_result($dniBD, $clavehasheada);
        $consulta->fetch();

        if  (trim($dni) === trim((string)$dniBD)) {
            // Si el DNI es correcto, almacenar Email en la sesión
            $_SESSION['email'] = $email; // Guardar el email en la sesión
            // Redirigir al usuario a la página de cambio de contraseña
            header("Location: cambiarContraseña.php");
            exit();
        } else {
            // Si el DNI no es correcto, mostrar un mensaje de error
            echo "El DNI no es correcto.";

        }
    } else {
        // Si el usuario no existe, mostrar un mensaje de error
        echo "El email no existe.";
    }
}

mysqli_close($conexion);
?>