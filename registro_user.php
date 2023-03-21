<?php

  // Conectar a la base de datos
  include('conexiondb.php');

// Comprobar si se ha enviado el formulario mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Recoger los datos del formulario
  $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
  $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";

  // Validar que los datos no estén vacíos
  if (empty($apellido) || empty($nombre) || empty($email) || empty($password)) {
    header("location:register.php?error=campos_vaci");
    exit; // Salir del script
  }

  // Escapar los valores para evitar inyecciones SQL
  $apellido = $conexion->real_escape_string($apellido);
  $nombre = $conexion->real_escape_string($nombre);
  $email = $conexion->real_escape_string($email);

  // Preparar y ejecutar la consulta SQL para insertar el usuario en la tabla
  $sql = "INSERT INTO users (nombre, apellido, email, password) VALUES ('$nombre', '$apellido', '$email', '$password')";
  if ($conexion->query($sql) === TRUE) {
    //se registra usuario  se redirige a register.php?exito
    header("location:login.php?exito=registrad");
  } else {
    //hubo un problema con las credenciales redirige a register.php?error
    header("location:register.php?error=registro_incorr");
  }

  // Cerrar la conexión a la base de datos
  $conexion->close();
}
?>
