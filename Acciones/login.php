<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("ConexionBD.php");
$conexion = mysqli_connect("localhost", "root", "", "ecounlz");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

if (!empty($_POST["ingresar"])) {
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $clave = trim($_POST["clave"]);

    // Verificar en la tabla de Administradores
    $consulta = $conexion->prepare("SELECT * FROM administrador WHERE email = ? AND clave = ?");
    $consulta->bind_param("ss", $email, $clave);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if ($row["validacion"] != 0) {
            $_SESSION['email'] = $email;
            $_SESSION['nombre_completo'] = $row["nombre_completo"];
            header("Location: VistasAdmin/inicioA.php");
            exit();
        } else {
            echo "No tienes permisos para acceder.";
        }
    } else {
        $consulta = $conexion->prepare("SELECT clave FROM usuarios WHERE email = ?");
        $consulta->bind_param("s", $email);
        $consulta->execute();
        $consulta->store_result();

        if ($consulta->num_rows === 1) {
            $consulta->bind_result($clavehasheada);
            $consulta->fetch();

            if (password_verify($clave, $clavehasheada)) {
                $row = $consulta->fetch_assoc();
                $_SESSION['email'] = $email;
                $_SESSION['nombre'] = $row["nombre"];
                header("Location: VistasUsuario/inicioU.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    }
    $consulta->close();
}

mysqli_close($conexion);
?>
