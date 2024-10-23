<?php
require("../Controles/connectdb.php");

$nombreUsuario = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$correoUsuario = $_POST['correoUsuario'];
$passwordUsuario = $_POST['passwordUsuario'];

$passwordEncrypted = password_hash($passwordUsuario, PASSWORD_BCRYPT);
function generarCadenaAleatoria($longitud = 20) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caracteresMezclados = str_shuffle($caracteres);
    $cadenaAleatoria = substr($caracteresMezclados, 0, $longitud);
    return $cadenaAleatoria;
}

$idUsuario = generarCadenaAleatoria();
$consulta2 = mysqli_query($conexion,"INSERT INTO usuarios (idUsuario,nombreUsuario,apellidoPaterno,apellidoMaterno,correoUsuario,passwordUsuario) VALUES ('$idUsuario','$nombreUsuario','$apellidoPaterno','$apellidoMaterno','$correoUsuario','$passwordEncrypted')");

if(!$consulta2){
    echo ("Fallo en el registro de usuario");
}
else{
    echo ("Registro exitoso");
}

$conexion -> close();