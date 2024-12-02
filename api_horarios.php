<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecounlz";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el tipo de contenido
header("Content-Type: application/json");

// Detectar el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todos los horarios
        $sql = "SELECT * FROM horarios";
        $result = $conn->query($sql);
        
        $horarios = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $horarios[] = $row;
            }
        }
        echo json_encode($horarios);
        break;

    case 'POST':
        // Agregar un nuevo horario
        $data = json_decode(file_get_contents("php://input"), true);
        $dia = $data['dia'];
        $hora_inicio = $data['hora_inicio'];
        $hora_fin = $data['hora_fin'];
        $materia = $data['materia'];
        $profesor = $data['profesor'];
        
        $sql = "INSERT INTO horarios (dia, hora_inicio, hora_fin, materia, profesor) 
                VALUES ('$dia', '$hora_inicio', '$hora_fin', '$materia', '$profesor')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Nuevo horario agregado correctamente"]);
        } else {
            echo json_encode(["error" => "Error: " . $conn->error]);
        }
        break;

    case 'PUT':
        // Actualizar un horario
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $dia = $data['dia'];
        $hora_inicio = $data['hora_inicio'];
        $hora_fin = $data['hora_fin'];
        $materia = $data['materia'];
        $profesor = $data['profesor'];
        
        $sql = "UPDATE horarios SET dia='$dia', hora_inicio='$hora_inicio', hora_fin='$hora_fin', materia='$materia', profesor='$profesor' WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Horario actualizado correctamente"]);
        } else {
            echo json_encode(["error" => "Error: " . $conn->error]);
        }
        break;

    case 'DELETE':
        // Eliminar un horario
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        
        $sql = "DELETE FROM horarios WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Horario eliminado correctamente"]);
        } else {
            echo json_encode(["error" => "Error: " . $conn->error]);
        }
        break;
}

$conn->close();
?>
