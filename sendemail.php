<?php

// Importa la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye el archivo autoload.php de PHPMailer
require 'vendor/autoload.php';

// Crea una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

// Incluye el archivo de conexión a la base de datos
include 'conexiondb.php';
include 'controlador.php';

$_SESSION['email'];
$_SESSION['password'];

try {
    // Configura el servidor SMTP y la autenticación para Outlook
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_SESSION['email'];
    $mail->Password = $_SESSION['password'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $sql = "SELECT nombre, apellido FROM users WHERE email = '{$_SESSION['email']}'";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $remitente_nombre = $fila['nombre'];
    $remitente_apellido = $fila['apellido'];

    //guarda la opcion seleccionadaa en el select y uso $destinatario para mandar el correo
    $destinatario = $_POST["destinatario"];

    // Configurar el remitente del correo electrónico
    $mail->setFrom($_SESSION['email'], $remitente_nombre . ' ' . $remitente_apellido);

    // Configura el destinatario y el asunto del correo electrónico
    $mail->addAddress($destinatario);
    $mail->Subject = 'Formulario - Traspaso turno TI';

    // Configura el contenido del correo electrónico a partir de los datos enviados por el formulario
    $fecha = $_POST['fecha'];
    $opcion = $_POST['opcion'];
    $turno = $_POST['turno'];
    $turnoactual = $_POST['turnoactual'];
    $turnoanterior = $_POST['turnoanterior'];
    $incidentegrave = $_POST['incidentegrave'];

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

    // envia el correo y redirige a index.php con un mensaje de exito.
    if ($mail->send()) {
        include 'conexiondb.php';

        // Obtener el usuario_id correspondiente al nombre y apellido
        $consulta_usuario = "SELECT usuario_id FROM users WHERE nombre='$remitente_nombre' AND apellido='$remitente_apellido'";
        $resultado_usuario = $conexion->query($consulta_usuario);

        if ($resultado_usuario->num_rows > 0) {
            // Si se encontró el usuario, obtener su usuario_id
            $fila_usuario = $resultado_usuario->fetch_assoc();
            $usuario_id = $fila_usuario['usuario_id'];
        } else {
            // Si no se encontró el usuario, insertar un nuevo registro en la tabla users y obtener su nuevo usuario_id
            $sql_nuevo_usuario = "INSERT INTO users(nombre, apellido) VALUES('$remitente_nombre', '$remitente_apellido')";
            $conexion->query($sql_nuevo_usuario);
        }

        // Insertar datos en la tabla formulario_traspaso con el usuario_id obtenido
        $sql = "INSERT INTO formulario_traspaso(id_usuario, nombre, apellido, fecha, colaborador_turno, tipo_turno, comentario_turnoactual, comentario_turnoanterior, incidentegrave) 
    VALUES('$usuario_id', '$remitente_nombre', '$remitente_apellido', '$fecha', '$opcion', '$turno', '$turnoactual', '$turnoanterior', '$incidentegrave')";

        // Ejecutar la consulta SQL
        if ($conexion->query($sql) === true) {
            // Cerrar la conexión
            $conexion->close();

            session_destroy();
            // Redirigir a la página de inicio con un mensaje de éxito en la URL
            header("location:index.php?exito=1");
            exit();
        }
    }
} catch (Exception $e) {
    //si hay algun error muestra el mensaje y despues de los : el erroinfo
    echo 'Hubo un error al enviar el correo electrónico:  ' . $mail->ErrorInfo;
}

?>

