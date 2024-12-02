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
    <link rel="stylesheet" href="Estilos/style.css">
    <!-- Link Iconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="body">
    <?php 
        include("Acciones/login.php");
    ?>
    <!-- Metodología BEM -->
    <main>
            <!-- Formulario de Logueo -->
            <div class="form-login">
                    <form action="" method="post">
                        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#A60A6C" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,176C384,203,480,213,576,192C672,171,768,117,864,106.7C960,96,1056,128,1152,160C1248,192,1344,224,1392,240L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                        </svg>
                        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#A60A6C" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,176C384,203,480,213,576,192C672,171,768,117,864,106.7C960,96,1056,128,1152,160C1248,192,1344,224,1392,240L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                        </svg>
                    <h1>Hola de nuevo!</h1>
                        <div class="casilleros">
                            <!-- Email -->
                            <!-- required pattern es para garantizar que el email tenga un formato valido. -->
                            <input type="email" name="email" id="email" placeholder="Ingrese su Email"
                            required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        </div>
                        <div class="casilleros">
                                <!-- Contraseña -->
                                <!-- required minlength es para que tenga que ingresar minimo 8 caracteres -->
                            <input type="password" name="clave" id="clave" placeholder="Ingrese su Contraseña"
                            required minlength="8">
                            <a href="recuperarContra.php" class="passwordforgot">Olvide mi contraseña</a></p>
                        </div>
                        <div class="botonusu">
                                <!-- Botón -->
                            <input class="botonusuario" type="submit" value="Iniciar Sesión" name="ingresar">
                        </div>
                        <div class="linkusuario">
                            <!-- Link para crear cuenta -->
                        <p>¿No tenes cuenta? <a href="crearusuario.php"> ¡Registrate!</a></p>
                        </div>
                    </form>
            </div>
            <script>
    document.querySelector('form').addEventListener('submit', function (event) {
        const traerEmail = document.getElementById('Email');
        const email = traerEmail.value;

        const dominiosValidos = /@(gmail|yahoo|hotmail)\.com$/i;
        if (!dominiosValidos.test(email)) {
            event.preventDefault();
            alert("Por favor, ingresa un correo electrónico válido con dominio Gmail, Yahoo o Hotmail.");
            traerEmail.focus();
        }
    });
    </script>
    </main>

    <!-- <footer>
        <div>
        <p>&copy; 2024 Grupo de estudiantes de la Técnica N*1 de Esteban Echeverría. Todos los derechos reservados.</p>
        </div>
    </footer> -->
</body>
</html>
