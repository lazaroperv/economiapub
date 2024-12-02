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

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Etiquetas para el SEO -->

    <!-- Etiquetas de SEO locales y especificaciones de idioma -->
    <meta name="language" content="Spanish">
    <meta name="geo.region" content="AR-B"> <!-- AR-B es el código ISO para Buenos Aires, Argentina -->
    <meta name="geo.placename" content="Buenos Aires, Argentina">
    <meta name="geo.position" content="-34.61315;-58.37723"> <!-- Coordenadas aproximadas de Buenos Aires -->
    <meta name="ICBM" content="-34.61315, -58.37723">

    <!-- Autores de la página -->
    <meta name="author" content="Grupo de estudiantes de la Técnica N*1 de Esteban Echeverría">

    <!-- Meta etiqueta de robots -->
    <meta name="robots" content="index, follow">

    <!-- Meta keywords -->
    <meta name="keywords" content="Facultad de Economía, Buenos Aires, estudiantes, UNLZ, educación, Cruce de Lomas">

    <!-- Meta descripción (máx. 160 caracteres) -->
    <meta name="description" content="Proyecto educativo para mejorar la página de Economía de la UNLZ realizado por estudiantes de la Técnica N*1 de Esteban Echeverría.">
    <link rel="stylesheet" href="../Estilos/style-admin.css">
    <!-- Título -->
    <title>Univerdad de Economía</title>
    <!-- Estilos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="body-admin">
    <!-- Metodología BEM -->
    <header>
        <div class="menu">
            <nav>
                <a class="logo" href="index.html"><img src="../Media/logoUNLZ.jpeg" alt="logoUNLZ" width="75px"></a>
                    <ul class="links">
                        <a href="">Salir</a>
                    </ul>
            </nav>
        </div>
    </header>

    <main>
    <div class="bienvenida"></div>
            <h1>Bienvenido Administrador <?php echo $_SESSION['nombre_completo'];?> </h1>
            <h1>Selecciona un Valor</h1>
            <form action="" method="POST">
                <label for="valor">Elige un valor:</label>
                <select id="valor" name="valor" required>
                    <option value="verificado" name="valor">verificados</option>
                    <option value="no verificado" name="valor">No verificados</option>
                </select>
                <input type="submit" value="Enviar" name="seleccion">

                
            </form>
            <?php
                include('../Acciones/auth.php');
            ?>
            
        </div>
        <div>
            <a href="tabla.php">Horarios y Materias</a>
        </div>
        
           
       
    </main>
    <footer>
    <footer>
         <div class="derechos">
            <p>_____________________________________________________________________________________________________________________________________________</p>
            <p>&copy; 2016 | UNLZ - Facultad de Ciencias Económicas |<a href="http://www.economicas.unlz.edu.ar/"> www.economicas.unlz.edu.ar</a> </p>
            <!-- <p>&copy; 2024 Grupo de estudiantes de la Técnica N*1 de Esteban Echeverría. Todos los derechos reservados.</p> -->
         </div>
    </footer>
</body>
</html>