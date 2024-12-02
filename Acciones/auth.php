<?php
$conexion = mysqli_connect("localhost", "root", "", "ecounlz");
if (mysqli_connect_error()) {
    echo "Error de conexión: " . mysqli_connect_error();
    exit();
} 

// Verificar si se ha enviado una solicitud para cambiar el estado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cambiar'])) {
        $dni = $_POST['dni']; // Obtener el DNI del usuario a actualizar
        // Actualizar el estado a "verificado"
        $sql_update = "UPDATE usuarios SET verificado = ? WHERE DNI = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $nuevo_estado = "verificado";
        $stmt_update->bind_param("ss", $nuevo_estado, $dni);
        $stmt_update->execute();
        $stmt_update->close();
        echo "El usuario con DNI $dni ha sido verificado.<br>";
    } else {
        $valor_seleccionado = $_POST['valor']; // Obtener el valor seleccionado
        #consulta sql
        $sql = "SELECT * FROM usuarios WHERE verificado = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            echo "Error en la preparación de la consulta: " . htmlspecialchars($conexion->error);
            exit();
        }
        $stmt->bind_param("s", $valor_seleccionado);
        $stmt->execute();
        $result = $stmt->get_result();

        #verificamos si hay resultados
        if ($result->num_rows > 0) {
            #imprimimos resultados
            while ($row = $result->fetch_assoc()) {
                echo "DNI: " . $row["DNI"] . " - Nombre: " . $row["nombre"] . " - Apellido: " . $row["apellido"] . " - Email: " . $row["email"] . " - Clave: " . $row["clave"] . " - Verificado: " . $row["verificado"] . "<br>";
                
                // Aquí verificamos el estado de "verificado"
                if ($row["verificado"] == "no verificado") {
                    echo "¿Quiere verificar el usuario?<br>";
                    // Formulario para cambiar el estado
                    echo '<form method="POST" action="">
                            <input type="hidden" name="dni" value="' . htmlspecialchars($row["DNI"]) . '">
                            <input type="hidden" name="valor" value="' . htmlspecialchars($valor_seleccionado) . '">
                            <input type="submit" name="cambiar" value="Cambiar">
                          </form>';
                }
            }
        } else {
            echo "No se encontraron resultados para el estado: " . htmlspecialchars($valor_seleccionado);
        }
        #cierra la consulta
        $stmt->close();
    }
}
?>