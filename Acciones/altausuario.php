<?php 
$conexion = mysqli_connect("localhost", "root", "", "ecounlz");
if (mysqli_connect_error()) {
    echo "Error de conexión: " . mysqli_connect_error();
    exit();
} 

if (!empty($_POST["crear"])) {
    if (!empty($_POST["DNI"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["email"]) && !empty($_POST["clave"]) && !empty($_POST["clave2"])) {
        $DNI = $_POST["DNI"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $clave = $_POST["clave"];
        $clave2 = $_POST["clave2"];
        $verf = 'no verificado';

        // Validaciones con preg_match
        if (!preg_match("/^\d{8,}$/", $DNI)) { 
            echo "<script>alert('El DNI debe contener solo números y tener al menos 8 dígitos.'); window.history.back();</script>";
            exit();
        }

        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) { 
            echo "<script>alert('El nombre solo debe contener letras y espacios.'); window.history.back();</script>";
            exit();
        }

        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) { 
            echo "<script>alert('El apellido solo debe contener letras y espacios.'); window.history.back();</script>";
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            echo "<script>alert('El email ingresado no es válido.'); window.history.back();</script>";
            exit();
        }

        if (strlen($clave) < 8) { 
            echo "<script>alert('La contraseña debe tener al menos 8 caracteres.'); window.history.back();</script>";
            exit();
        }

        if ($clave !== $clave2) {
            echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
            exit();
        }

        // Verificar si el email ya existe
        $stmt = $conexion->prepare("SELECT COUNT(*) AS cantidad FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();

        if ($row['cantidad'] > 0) {
            echo "<script>alert('El email ya está registrado.'); window.history.back();</script>";
        } else {
            $clavehash = password_hash($clave, PASSWORD_DEFAULT);    

            if (!$consulta = $conexion->prepare("INSERT INTO usuarios (DNI, email, nombre, apellido, clave, verificado) VALUES (?, ?, ?, ?, ?, ?)")) {
                echo "Error al preparar la consulta: " . $conexion->error;
                exit();
            }

            $consulta->bind_param("ssssss", $DNI, $email, $nombre, $apellido, $clavehash, $verf);
            
            if (!$consulta->execute()) {
                echo "Error al ejecutar la consulta: " . $consulta->error;
                exit();
            } else {
                echo "<script>alert('¡Cuenta creada! Aguarde la verificación.'); window.location.href = 'formulario.php';</script>";
            }

            $consulta->close();
            mysqli_close($conexion);
        }
    }
}
?>
