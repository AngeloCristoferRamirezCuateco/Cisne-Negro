<?php
require("../Controles/connectdb.php");
session_start();
$correo = $_SESSION["correoUsuario"];
$TipoGasto = $_POST['tipoGasto'];
$Gasto = $_POST['gasto'];
$NombreGasto = $_POST['nombregasto'];
$FechaActual = date(format: 'Y-m-d H:i:s');

function generarCadenaAleatoria($longitud = 20) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caracteresMezclados = str_shuffle($caracteres);
    $cadenaAleatoria = substr($caracteresMezclados, 0, $longitud);
    return $cadenaAleatoria;
}

$idGasto = generarCadenaAleatoria();

$idUsuarioresult = mysqli_query($conexion, "SELECT idUsuario FROM usuarios WHERE correoUsuario = '$correo'");
if (!$idUsuarioresult || mysqli_num_rows($idUsuarioresult) == 0) {
    echo "No hay usuario";
} else {
    // Extrae el resultado de la consulta
    $idUsuario = mysqli_fetch_assoc($idUsuarioresult);
    $iduser = $idUsuario['idUsuario'];
}

//Consulta para guardar el gasto en la base de datos

$SaveCash = mysqli_query($conexion,"INSERT INTO gasto VALUES ('$idGasto','$iduser','$TipoGasto','$FechaActual','$Gasto','$NombreGasto')");

if(!$SaveCash){
    echo "Insersion fallida";
}
else{
    header("Location: ../Vistas/Inicio.php");
}