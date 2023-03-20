<?php
   // Incluye el archivo de conexión a la base de datos
   include 'conexiondb.php';
   
   // Inicializa las variables de las fechas
   $fechaInicio = '';
   $fechaFin = '';
   $resultado = '';
   
   // Si se ha enviado el formulario, recupera las fechas y realiza la consulta SQL
   if (isset($_POST['submit'])) {
       $fechaInicio = $_POST['fecha_inicio'];
       $fechaFin = $_POST['fecha_fin'];
   
       // Construye la consulta SQL utilizando BETWEEN para obtener las fechas en el rango especificado
       $consulta = "SELECT * FROM formulario_traspaso WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
   
       // Ejecuta la consulta
       $resultado = mysqli_query($conexion, $consulta);
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="keywords" content="">
      <meta name="description" content="consulta registro incidentes">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\styleregistodo.css">
      <link rel="shortcut icon" href="img\favico.png">
      <meta charset="UTF-8">
      <title>Registros de formularios - Traspaso turno TI</title>
   </head>
   <body>
      <header>
         <a class="textvol" href="index.php"><button class="botonvolver">Volver a inicio</button></a>
      </header>
      <h1 class="text1">Consulta registro formulario:</h1>
      <form class="form2" id="registro" method="POST">
         <label class="text_fechaini" for="fecha_inicio">Desde:</label>
         <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fechaInicio; ?>">
         <br>
         <label class="text_fechafin" for="fecha_fin">Hasta:</label>
         <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $fechaFin; ?>">
         <br>
         <input type="submit" name="submit" class="btonbuscar"value="Buscar">
         <?php if ($resultado) { 
            $contador = mysqli_num_rows($resultado); // Obtiene la cantidad de registros devueltos por la consulta
            if ($contador > 0) { // Si hay registros, muestra el botón de descarga de Excel ?>
         <ul class="registros">
            <h3 id="texto2">Registros:</h3>
            <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                <ul>
                <li><strong>Fecha:</strong> <?php echo $fila['fecha']; ?></li>
                <li><strong>Nombre:</strong> <?php echo $fila['nombre']; ?></li>
                <li><strong>Apellido:</strong> <?php echo $fila['apellido']; ?></li>
                <li><strong>Colaborador turno:</strong> <?php echo $fila['colaborador_turno']; ?></li>
                <li><strong>Tipo de turno:</strong> <?php echo $fila['tipo_turno']; ?></li>
                <li><strong>Comentario turno actual:</strong> <?php echo $fila['comentario_turnoactual']; ?></li>
                <li><strong>Comentario turno anterior:</strong> <?php echo $fila['comentario_turnoanterior']; ?></li>
                <li><strong>Incidente grave:</strong> <?php echo $fila['incidentegrave']; ?></li>
                <hr style="width:50%;text-align:left;margin-left:0">
                </ul>
                
            <?php } ?>
         </ul>
         <button type="submit" form="registro" class="dwexcel" formaction="downloadexcelregistodo.php" name="descargar">Descargar en Excel<img class="xlsico"src="img\xls-file.png"></button>
         <?php 
            } else { // Si no hay registros, muestra un mensaje
            echo "<p class='noregis'>No se encontraron registros para las fechas seleccionadas.</p>";
            }} ?> 
      </form>
   </body>
</html>