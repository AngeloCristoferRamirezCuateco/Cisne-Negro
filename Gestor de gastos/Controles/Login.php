<?php
require("../Controles/connectdb.php");
$correoUsuario = $_POST['email'];
$passwordUsuario = $_POST['password'];
//$passwordEncrypted = password_hash($passwordUsuario,PASSWORD_BCRYPT);
$query1 = mysqli_query($conexion, query: "SELECT * FROM Usuarios WHERE correoUsuario = '$correoUsuario'");
if (!$query1) {
    echo "Fallo en el inicio de sesión";
} else {
    $user = mysqli_fetch_assoc(result: $query1);
    $usermail = $user['correoUsuario'];
    $userpass = $user['passwordUsuario'];
    $userType = $user['tipoUsuario'];
    $userAccess = $user['accesoUsuario'];
    $doubleAccess = $user['accesoDoble'];
    if ($correoUsuario == $usermail && password_verify($passwordUsuario, $userpass)) {
        if ($userAccess == "normal" && $userType == "normal") {
            session_start();
            $_SESSION['correoUsuario'] = $correoUsuario;
            header(header: "Location: ../Vistas/Inicio.php");
        }
        if($userType == "Admin"){
            session_start();
            $_SESSION['correoUsuario'] = $correoUsuario;
            header(header: "Location: ../Vistas/ViewsforAdmin/InicioAdmin.html");
        }
    } else {
        header(header: "Location: ../Vistas/loginview.html");
    }
}
$conexion->close();
