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

    <!-- Título -->
    <title>Universidad de Economía</title>
</head>
<body>
<?php 
    session_start();
    
    if(!isset($_SESSION['email'])){
        echo '
            <script>
                alert("Debes iniciar sesion antes de entrar a esta pagina");
                window.location = "../loginusuario.php"; 
            </script>';
        session_destroy();
        die();
    }
    
   // IF para Cerrar Sesión
    if (isset($_POST['cerrar'])) {
        session_destroy();
        header("location:../index.html");
        
    }
    
?>
    <!-- Metodología BEM -->
    <header>
       <ul>
       <form action="" method="post">
            <button type="submit" name="cerrar">Cerrar sesión</button>
        </form>
       </ul>
    </header>
    <main>
   
</form>
    </main>
    <footer>
        <div>
           <p>&copy; 2024 Grupo de estudiantes de la Técnica N*1 de Esteban Echeverría. Todos los derechos reservados.</p>
        </div>
   </footer>
</body>
</html>