<?php

// Importa la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye el archivo autoload.php de PHPMailer
require "vendor/autoload.php";

// Crea una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

// Incluye el archivo de conexión a la base de datos
include "conexiondb.php";

// Obtener todos los usuarios de la base de datos
$sql = "SELECT id, email, password FROM users";
$resultado = mysqli_query($conexion, $sql);

// Recorre los resultados de la consulta y obtiene el email y la contraseña de cada usuario
while ($fila = mysqli_fetch_assoc($resultado)) {
    $email = $fila["email"];
    $password = $fila["password"];
}

try {
    // Configura el servidor SMTP y la autenticación para Outlook
    $mail->isSMTP();
    $mail->Host = "smtp.office365.com";
    $mail->SMTPAuth = true;
    $mail->Username = $email;
    $mail->Password = $password;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->CharSet = "UTF-8";

    // Configura el remitente, el destinatario y el asunto del correo electrónico
    // Obtener el nombre y apellido del remitente desde la base de datos
    $sql = "SELECT nombre, apellido FROM users WHERE email = '$email'";
    $resultado_nombre = mysqli_query($conexion, $sql);
    $resultado_apellido = mysqli_query($conexion, $sql);
    $fila_nombre = mysqli_fetch_assoc($resultado_nombre);
    $fila_apellido = mysqli_fetch_assoc($resultado_apellido);
    $remitente_nombre = $fila_nombre["nombre"];
    $remitente_apellido = $fila_apellido["apellido"];

    // Configurar el remitente del correo electrónico
    $mail->setFrom($email, $remitente_nombre . " " . $remitente_apellido);

    // Configura el destinatario y el asunto del correo electrónico
    $mail->addAddress("bryanelgueta123@outlook.com", "Brayan Elgueta");
    $mail->Subject = "Traspaso turno TI";

    // Configura el contenido del correo electrónico a partir de los datos enviados por el formulario
    $fecha = $_POST["fecha"];
    $opcion = $_POST["opcion"];
    $turno = $_POST["turno"];
    $turnoactual = $_POST["turnoactual"];
    $turnoanterior = $_POST["turnoanterior"];
    $incidentegrave = $_POST["incidentegrave"];

    //Crea el cuerpo del correo electrónico
    $contenido = "<h1>Traspaso turno TI</h1>";
    $contenido .= "<p><strong>Fecha del cambio de turno: </strong> {$fecha}</p>";
    $contenido .= "<p><strong>Colaborador de turno: </strong> {$opcion}</p>";
    $contenido .= "<p><strong>Tipo de turno: </strong> {$turno}</p>";
    $contenido .= "<p><strong>Comentarios del turno actual: </strong> {$turnoactual}</p>";
    $contenido .= "<p><strong>Comentarios del turno anterior: </strong> {$turnoanterior}</p>";
    $contenido .= "<p><strong>Incidente grave: </strong> {$incidentegrave}</p>";

    $mail->Body = $contenido;
    $mail->AltBody = strip_tags($contenido);

    //esta linea envia el correo y redirige al index.php con un mensaje de exito.
    $mail->send();
    session_start();
    $_SESSION["formulario_enviado"] = true;

    // Redirige a la página de inicio
    header("location:index.php");
    exit();

    //si hay algun error muestra el mensaje y despues de los : el erroinfo
} catch (Exception $e) {
    echo "Hubo un error al enviar el correo electrónico:  " . $mail->ErrorInfo;
}

?>
