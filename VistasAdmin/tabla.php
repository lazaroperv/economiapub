<?php
session_start();

if(!isset($_SESSION['email'])){
    echo '
        <script>
            alert("Debes iniciar sesion antes de entrar a esta pagina");
            window.location = "../index.html"; 
        </script>';
    session_destroy();
    die();
}

if (isset($_POST['cerrar'])) {
  session_destroy();
  header("location:../index.html");
  
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecounlz";
 
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Error en codigo mysqli o conexion";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los datos del formulario
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $materia = $_POST['materia'];
    $profesor = $_POST['profesor'];
    // Insertamos los datos en la base de datos
    $sql = "INSERT INTO horarios (dia, hora_inicio, hora_fin, materia, profesor) 
            VALUES ('$dia', '$hora_inicio', '$hora_fin', '$materia', '$profesor')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success custom-alert'>Nuevo horario agregado correctamente</div>";
    } else {
        echo "<div class='alert alert-danger custom-alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Horarios</title>
    <!-- Incluir Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Estilos/horarios.css">
</head>
<body>
    <!-- Botón para volver a Index en la parte superior izquierda -->
    <div class="d-flex justify-content-start mb-4">
            <a href="inicioA.php" class="btn-volver">Volver a Inicio</a>
    </div>
    <form id="form-cerrar-sesion" class="form-sesion" action="" method="post">
        <input type="submit" value="Cerrar Sesión" name="cerrar" >
    </form>
    <div class="container mt-5">

        <h1 class="text-center mb-4">Formulario de Horarios y Materias</h1>

        <!-- Formulario para ingresar datos -->
        <form method="POST" action="tabla.php" class="mb-4">
            <div class="mb-3">
                <label for="dia" class="form-label">Día de la Semana:</label>
                <input type="text" name="dia" id="dia" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de Inicio:</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="hora_fin" class="form-label">Hora de Fin:</label>
                <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="materia" class="form-label">Materia:</label>
                <input type="text" name="materia" id="materia" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="profesor" class="form-label">Profesor:</label>
                <input type="text" name="profesor" id="profesor" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-50 mx-auto d-block">Agregar Horario</button>
        </form>

        <!-- Tabla para mostrar los horarios guardados -->
        <h2 class="text-center mb-4">Horarios Guardados</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Día</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Materia</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM horarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar los resultados
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["dia"] . "</td>";
                        echo "<td>" . $row["hora_inicio"] . "</td>";
                        echo "<td>" . $row["hora_fin"] . "</td>";
                        echo "<td>" . $row["materia"] . "</td>";
                        echo "<td>" . $row["profesor"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay horarios registrados</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Incluir el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
