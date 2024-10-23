<?php
require("../Controles/connectdb.php");
$correoUsuario = $_POST['email'];
$passwordUsuario = $_POST['password'];

$query1 = mysqli_query($conexion, query: "SELECT * FROM Usuarios WHERE correoUsuario = '$correoUsuario'");
if (!$query1) {
    echo "Fallo en el inicio de sesión";
} else {
    $user = mysqli_fetch_assoc(result: $query1);
    $usermail = $user['correoUsuario'];
    $userpass = $user['passwordUsuario'];
    if ($correoUsuario != $usermail || $passwordUsuario != $userpass) {
        header(header: "Location: ../Vistas/loginview.html");
    } else {
        session_start();
        $_SESSION['correoUsuario'] = $correoUsuario;
        header(header: "Location: ../Vistas/Inicio.php");
    }
}
$conexion -> close();