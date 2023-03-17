<?php
// Inicia una sesión si no hay una en progreso
if (!isset($_SESSION)) {
    session_start();
}

include 'conexiondb.php';

// Verifica si se ha enviado el formulario de inicio de sesión
if (!empty($_POST["btonlogin"])) {
    // Verifica si los campos de correo electrónico y contraseña están vacíos
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        // Si los campos están vacíos, muestra un mensaje de error
<<<<<<< Updated upstream
        header("location:login.php?error=campos_vacios");
    } else {
        // Si los campos no están vacíos, se procede a verificar la información del usuario

        // Se obtienen los valores de correo electrónico y contraseña de los input email y password
        $email = $_POST['email'];
        $password = $_POST['password'];

        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        // Se realiza una consulta a la base de datos para verificar si hay un usuario registrado con el correo electrónico proporcionado
        $stmt = $conexion->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si se encuentra un usuario con el correo electrónico proporcionado, se verifica la contraseña
        if ($datos = $result->fetch_object()) {

            ////ENCRIPTAR CONTRASEÑAS EN https://onlinephp.io/password-hash e insertar en base de datos 
            ////si no esta encriptada no inicia sesion
            if (password_verify($password, $datos->password)) {
                $_SESSION['nombre'] = $datos->nombre;
                $_SESSION['apellido'] = $datos->apellido;
                header("location:form.php");
            } else {
                header("location:login.php?error=usuario_incor");
            }
=======
        print "<h4 style='color:red' class='txtalert'>Los campos estan vacios.</h4>";
    } else {
        // Si los campos no están vacíos, se procede a verificar la información del usuario

        // Se obtienen los valores de correo electrónico y contraseña del formulario
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Se realiza una consulta a la base de datos para verificar si hay un usuario registrado con el correo electrónico y contraseña proporcionados
        $sql = $conexion->query(
            "SELECT * FROM users WHERE email='$email' AND password='$password'"
        );

        // Si se encuentra un usuario con los valores proporcionados, se inicia sesión y se redirige al usuario a la página 'form.php'
        if ($datos = $sql->fetch_object()) {
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION["apellido"] = $datos->apellido;
            header("location:form.php");

            // Si no se encuentra un usuario con los valores proporcionados, muestra un mensaje de error
>>>>>>> Stashed changes
        } else {
            header("location:login.php?error=usuario_incor");
        }
    }
}
?>





<<<<<<< Updated upstream






=======
>>>>>>> Stashed changes
