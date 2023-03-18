<!DOCTYPE html>
<html lang="es">
   <head>
      <title>Inicio Sesión - Traspaso turno TI</title>
      <meta charset="utf-8">
      <meta name="keywords" content="">
      <meta name="description" content="inicio sesion formulario">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\stylelogin.css">
      <link rel="shortcut icon" href="img\favico.png">
   </head>
   <header>
      <div>
         <a class="textvol" href="index.php">
         <button class="botonvolver">Volver a Inicio</button>
         </a>
      </div>
   </header>
   <body>
      <form class="formulario2" method="POST" action="controlador.php">
         <legend class="legendini">Inicia Sesión</legend>
         <?php
            if (isset($_GET["error"])) {
            $error = $_GET["error"];
            
            if ($error == "campos_vacios") {
            echo "<h4 style='color:red' class='txtalert'>Los campos están vacíos.</h4>";
            }
            }
            
            if (isset($_GET["error"])) {
            $error = $_GET["error"];
            
            if ($error == "usuario_incor") {
            echo "<h4 style='color:red' class='txtalert'>No hemos podido autenticarle. Vuelva a intentarlo.</h4>";
            }
            }
            ?>
         <div>
            <label for="inputemail">Ingresa tu correo electrónico:</label>
            <input type="email" placeholder="correo@ejemplo.com" id="email" name="email"></input>
         </div>
         <div>
            <label for="inputpassword">Ingresa tu contraseña:</label>
            <input type="password" placeholder="contraseña" id="password" name="password"></input>
         </div>
         <div>
            <input type="submit" class="buttonlogin" name="btonlogin" value="Iniciar Sesión"></input>
         </div>
         <a class="txtregister" href="register.php">¿No estas registrado?, Haz click aqui!</a>
         <div>
            <img src="img\Logo-login.png" class="img-logg">
         </div>
      </form>
   </body>
</html>