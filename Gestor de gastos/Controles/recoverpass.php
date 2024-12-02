<?php
require("../Controles/connectdb.php");

$mail = $_POST['usermail'];

$query1 = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE correoUsuario = '$mail'");

function descifrarCesar4($texto) {
    $desplazamiento = 4; // Desplazamiento fijo
    $resultado = '';

    for ($i = 0; $i < strlen($texto); $i++) {
        $caracter = $texto[$i];
        if (ctype_alpha($caracter)) {
            $ascii = ord($caracter);
            $base = ctype_upper($caracter) ? ord('A') : ord('a');
            $nuevoAscii = ($ascii - $base - $desplazamiento + 26) % 26 + $base;
            $resultado .= chr($nuevoAscii);
        } else {
            $resultado .= $caracter;
        }
    }
    return $resultado;
}

if(!$query1){
    header(header: "Location: ../Vistas/recoverPass.html");
}
else {
    $user = mysqli_fetch_assoc($query1);
    if ($user) {
        $userml = $user['correoUsuario'];
        $passUser = $user['passwordUsuario'];
        $passDes = descifrarCesar4($passUser);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "utp0156992@alumno.utpuebla.edu.mx",
                        'Name' => "Alpha Dev"
                    ],
                    'To' => [
                        [
                            'Email' => $userml,
                            'Name' => "Cliente"
                        ]
                    ],
                    'Subject' => "Recover Password",
                    'HTMLPart' => "<h3>Dear user,</h3><br />Here is your password: <strong>" . htmlspecialchars($passDes) . "</strong>"
                ]
            ]
        ];

        // Inicializa CURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, "dddc81b2e8eb8691a1d1733cbb961448:477a8db498fe36834861337312f8ada8");

        $server_output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "CURL error: " . curl_error($ch);
        }

        curl_close($ch);

        $response = json_decode($server_output);

        if (isset($response->Messages[0]->Status) && $response->Messages[0]->Status == 'success') {
            header("Location: ../Vistas/recoverPass.html");
            exit;
        } else {
            echo "Error al enviar el correo: " . $server_output;
        }
    } else {
        echo "No se encontró el usuario.";
    }
}
