<?php
require("../Controles/connectdb.php");

$nombreUsuario = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$correoUsuario = $_POST['correoUsuario'];
$passwordUsuario = $_POST['passwordUsuario'];

//$passwordEncrypted = password_hash($passwordUsuario, PASSWORD_BCRYPT);
function cifrarCesar($texto) {
    $resultado = '';
    $desplazamiento = 4;
    for ($i = 0; $i < strlen($texto); $i++) {
        $caracter = $texto[$i];
        if (ctype_alpha($caracter)) {
            $ascii = ord($caracter);
            $base = ctype_upper($caracter) ? ord('A') : ord('a');
            $nuevoAscii = ($ascii - $base + $desplazamiento + 26) % 26 + $base;
            $resultado .= chr($nuevoAscii);
        } else {
            $resultado .= $caracter;
        }
    }
    return $resultado;
}
$passwordEncrypted = cifrarCesar($passwordUsuario);
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
    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "utp0156992@alumno.utpuebla.edu.mx",
                'Name' => "Alpha Dev"
            ],
            'To' => [
                [
                    'Email' => $correoUsuario,
                    'Name' => "Cliente"
                ]
            ],
            'Subject' => "Registro exitoso",
            'HTMLPart' => "<h3>Querido usuario</h3><br />Gracias por registrarte a Cash Save :D"
            ]
        ]
    ];
     
    $ch = curl_init();
     
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "dddc81b2e8eb8691a1d1733cbb961448:477a8db498fe36834861337312f8ada8");
    $server_output = curl_exec($ch);
    curl_close ($ch);
     
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        echo "Email sent successfully.";
    }
    echo ("Registro exitoso");
}

$conexion -> close();