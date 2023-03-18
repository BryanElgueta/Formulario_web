<!DOCTYPE html>
<html lang="es">
   <head>
      <title>Registrate - Traspaso turno TI</title>
      <meta charset="utf-8">
      <meta name="keywords" content="">
      <meta name="description" content="registro usuario formulario">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\styleregister.css">
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
      <form class="formulario2" method="POST" action="">
         <legend class="legendini">Registrate</legend>
         <div>
            <label for="apellido">Ingresa tu nombre:</label>
            <input type="text" placeholder="Apellido de usuario" id="apellido" name="apellido"></input>
         </div>
         <div>
            <label for="nombre">Ingresa tu apellido:</label>
            <input type="text" placeholder="Nombre de usuario" id="nombre" name="nombre"></input>
         </div>
         <div>
            <label for="inputemail">Ingresa tu correo electrónico:</label>
            <input type="email" placeholder="correo@ejemplo.com" id="email" name="email"></input>
         </div>
         <div>
            <label for="inputpassword">Ingresa tu contraseña:</label>
            <input type="password" placeholder="contraseña" id="password" name="password"></input>
         </div>
         <div>
            <input type="submit" class="buttonregister" name="btonregister" value="Registrarse"></input>
         </div>
         <a class="txtlogin" href="login.php">¿Ya estas registrado?, Inicia sesion!</a>
         <div>
            <img src="img\Logo-login.png" class="img-logg">
         </div>
      </form>
   </body>
</html>