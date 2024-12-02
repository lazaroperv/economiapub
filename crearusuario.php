<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Estilos/style.css">
<title>Universidad de Economía</title>
</head>
<body class="body">
    <?php include("Acciones/altausuario.php"); ?>
    <main>
        <div class="form-crearusuario">
            <h1>Vamos a crear tu cuenta!</h1>
            <form action="" method="post">
                <div class="casilleross">
                    <input type="number" name="DNI" id="DNI" placeholder="Ingrese su DNI">
                </div>
                <div class="casilleross">
                    <input type="text" name="nombre" id="Nombre" placeholder="Ingrese su Nombre">
                </div>
                <div class="casilleross">
                    <input type="text" name="apellido" id="Apellido" placeholder="Ingrese su Apellido">
                </div>
                <div class="casilleross">
                    <input type="email" name="email" id="Email" placeholder="Ingrese su Email" required>
                </div>
                <div class="casilleross">
                    <input type="password" name="clave" id="Clave" placeholder="Ingrese su contraseña">
                </div>
                <div class="casilleross">
                    <input type="password" name="clave2" id="Clave2" placeholder="Confirme su contraseña">
                </div>
                <div class="botonusuario">
                    <input type="submit" value="Crear Cuenta" name="crear">
                </div>
                <div class="linkusuario">
                    <a href="loginusuario.php"> Click acá si ya tenés una cuenta!</a>
                </div>
            </form>
        </div>
    </main>
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
</body>
</html>
