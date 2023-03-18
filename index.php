<!DOCTYPE html>
<html lang="es">
   <head>
      <title>Inicio - Traspaso turno TI</title>
      <meta charset="utf-8">
      <meta name="keywords" content="">
      <meta name="description" content="inicio formulario">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\styleindex.css">
      <link rel="shortcut icon" href="img\favico.png">
   </head>
   <?php
      if (isset($_GET['exito']) && $_GET['exito'] == 1) {
       echo '<div id="mensaje-exito transicion" class="mensaje-exito transicion">¡Mensaje enviado con exito!</div>';
       header("Refresh:4; url=index.php");
      }
      
      ?>
   <script>
      // Oculta el mensaje de éxito después de 3 segundos
      setTimeout(function() {
        var mensaje = document.getElementById('mensaje-exito');
        if (mensaje) {
          mensaje.classList.add('transicion'); // Agrega la clase "transicion" para mostrar la animación
          setTimeout(function() {
            mensaje.style.display = 'none'; // Oculta el mensaje después de que la animación haya finalizado
          }, 3000);
        }
      }, 3000);
   </script>
   <body>
      <header>
         <a class="textregis" href="registro_incidente.php"><button class="registroincidente">Registro incidente grave</button></a>
      </header>
      <h1 class="textwelcome">Traspaso turno TI</h1>
      <div id="current_date">
         <script>
            date = new Date();
            year = date.getFullYear();
            month = date.getMonth() + 1;
            day = date.getDate();
            document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;
         </script>
      </div>
      <div>
         <h2 class="subtxt">Bitácora diaria de cambio de turno en TI</h2>
      </div>
      <div>
         <a class="textlogin" href="login.php"><button class="buttonl">Comenzar</button></a>
      </div>
      <footer>
         <img class="imgfooter" src="img\logo-header.png" name="imgfooter">
      </footer>
   </body>
</html>