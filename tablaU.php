<?php
 include('ConexionBD.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios y Materias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Estilos/horarios.css">
</head>
<body>
<header>
</header>    
<main>
    <div class="d-flex justify-content-start mb-4">
        <a href="index.html" class="btn-volver">Volver a Inicio</a>
    </div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Horarios Guardados</h1>
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
                        $result = $conexion->query($sql);

                        if ($result->num_rows > 0) 
                        {
                            // Mostrar los resultados
                            while($row = $result->fetch_assoc())
                                {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["dia"] . "</td>";
                                    echo "<td>" . $row["hora_inicio"] . "</td>";
                                    echo "<td>" . $row["hora_fin"] . "</td>";
                                    echo "<td>" . $row["materia"] . "</td>";
                                    echo "<td>" . $row["profesor"] . "</td>";
                                    echo "</tr>";
                                }
                        } else
                        {
                            echo "<tr><td colspan='6' class='text-center'>No hay horarios registrados</td></tr>";
                        }
                            $conexion->close();
                        ?>
                </tbody>
            </table>
    </div>
</main>
<footer>

</footer>
</body>
</html>