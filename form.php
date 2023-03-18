<!DOCTYPE html>
<html lang="es">
   <head>
      <title>Formulario - Traspaso turno TI</title>
      <meta charset="utf-8">
      <meta name="keywords" content="">
      <meta name="description" content="formulario">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\styleform.css">
      <link rel="shortcut icon" href="img\favico.png">
   </head>
   <body>
      <header>
         <div>
            <a class="textvol" href="logout.php"><button class="botonvol">Cerrar sesión</button>
            </a>
         </div>
         <?php
            session_start();
              if(!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
            header("location:login.php");
             } else {
                echo "<h3 class='welcome'>¡Bienvenido " . $_SESSION['nombre'] . " " . $_SESSION['apellido'] . "!</h3>";
             }
            ?>
      </header>
      <div id="timer"></div>
      <script src="js\temporizador.js"></script>
      <form class="formulario1" action="sendemail.php" method="POST">
         <h4 class="texto">Traspaso turno TI</h4>
         <fieldset>
            <legend class="legendtxt">Fecha del cambio de turno:</legend>
            <div>
               <label for="fechaActual">Especifique la fecha (DD/MM/AAAA) </label>
               <input type="date" id="fechaActual" value="fecha" name="fecha" required>
            </div>
         </fieldset>
         <fieldset>
            <legend class="legendtxt">Colaborador de turno:</legend>
            <div>
               <input class="opcion" type="radio" id="Roberto" name="opcion" value="Roberto Rojas" required>
               <label for="Roberto">Roberto Rojas</label>
            </div>
            <div>
               <input class="opcion2" type="radio" id="Miguel" name="opcion" value="Miguel Marambio" required>
               <label for="Miguel">Miguel Marambio </label>
            </div>
            <div>
               <input class="opcion3" type="radio" id="Luis" name="opcion" value="Luis Baeza" required>
               <label for="Luis">Luis Baeza</label>
            </div>
         </fieldset>
         <fieldset>
            <legend class="legendtxt">Tipo de turno:</legend>
            <div>
               <input class="turno" type="radio" id="mana" name="turno" value="Turno Mañana" required>
               <label for="mana">Turno Mañana</label>
            </div>
            <div>
               <input class="turno2" type="radio" id="inter" name="turno" value="Turno Intermedio" required>
               <label for="inter">Turno Intermedio</label>
            </div>
            <div>
               <input class="turno3" type="radio" id="tarde" name="turno" value="Turno Tarde" required>
               <label for="tarde">Turno Tarde</label>
            </div>
         </fieldset>
         <fieldset>
            <legend class="legendtxt">Comentarios del turno actual:</legend>
            <div>
               <textarea class="texttarea" placeholder="Escriba su respuesta...." rows="5" cols="50" name="turnoactual" required></textarea>
            </div>
         </fieldset>
         <fieldset>
            <legend class="legendtxt">Comentarios del turno anterior:</legend>
            <div>
               <textarea class="texttarea" placeholder="Escriba su respuesta...." rows="5" cols="50" name="turnoanterior" required></textarea>
            </div>
         </fieldset>
         <fieldset>
            <legend class="legendtxt">Incidente grave</legend>
            <h4 class="texto3">
               En caso de haber un incidente grave comentar acciones realizadas
               <p class="texto3">
                  Escribir "SIN COMENTARIOS" si es que no hubieron incidentes graves durante el turno.
               </p>
            </h4>
            <div>
               <textarea class="texttarea" placeholder="Escriba su respuesta...." rows="5" cols="50" name="incidentegrave" required></textarea>
            </div>
         </fieldset>
         <fieldset>
            <legend class="legendtxt">Destinatario</legend>
            <div>
               <select class="selectemail"name="destinatario" required>
                  <option value="" disabled selected>Selecciona un destinatario</option>
                  <option value="mmarambio@agrosuper.com">Miguel Marambio</option>
                  <option value="rrojasg@agrosuper.com">Roberto Rojas</option>
                  <option value="">Luis Baeza</option>
                  <option value="informaticapsv@agrosuper.com">Informatica Planta San Vicente</option>
                  <option value="bryansecu3@outlook.com">Brayan Elgueta</option>
               </select>
            </div>
         </fieldset>
         <div>
            <button type="submit" class="botonenv">Enviar</button>
            <button type="reset" class="botonreset">Borrar</button>
         </div>
      </form>
   </body>
</html>