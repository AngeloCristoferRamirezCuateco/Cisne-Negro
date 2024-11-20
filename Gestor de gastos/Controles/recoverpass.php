<?php
require("../Controles/connectdb.php");

$mail = $_POST['usermail'];

$query1 = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE correoUsuario = '$mail'");

if(!$query1){
    header(header: "Location: ../Vistas/recoverPass.html");
}
else{
    $user = mysqli_fetch_assoc($query1);
    $userml = $user['correoUsuario'];
    echo $userml . "<br>Usuario disponible";
}