<?php
require("../Controles/connectdb.php");
session_start();
$correoUsuario = $_SESSION['correoUsuario'];
$safeWord = $_POST['safeWord'];
$hashedWord = md5($safeWord);
$query1 = mysqli_query($conexion,"UPDATE usuarios SET palabraSegura = '$hashedWord' WHERE correoUsuario = '$correoUsuario'");
if(!$query1){
    echo "Fallo en la insersion de palabra segúra D:";
}
else{
    $query2 = mysqli_query($conexion, "UPDATE usuarios SET formularioCompletado = TRUE WHERE correoUsuario = '$correoUsuario'");
    header("Location: ../Vistas/Inicio.php");
}