<?php
//para la conexion a la base de datos se necesitan los siguientes datos:
//host //usuario //contraseña //nombre base de datos //puerto
$conexion = new mysqli("localhost", "root", "bryan123", "traspaso_turno", "3306");
//charset utf-8 estandar codigo de carcteres default de la base de datos
$conexion->set_charset("utf8");

?>
