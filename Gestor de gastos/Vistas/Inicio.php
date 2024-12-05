<?php
//Nota: Arregla esto ->
require("../Controles/connectdb.php");
session_start();
$correo = $_SESSION['correoUsuario'];
if (!$correo) {
    header("Location: ../Vistas/loginview.html");
}
// Realiza la consulta para obtener el id del usuario
$idUsuarioresult = mysqli_query($conexion, "SELECT idUsuario FROM usuarios WHERE correoUsuario = '$correo'");
$usuarioName = mysqli_query($conexion, "SELECT (nombreUsuario) FROM usuarios WHERE correoUsuario = '$correo'");
$completeform = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correoUsuario = '$correo'");
if (!$idUsuarioresult || mysqli_num_rows($idUsuarioresult) == 0) {
    echo "No hay usuario";
} else {
    // Extrae el resultado de la consulta
    $idUsuario = mysqli_fetch_assoc($idUsuarioresult);
    $username1 = mysqli_fetch_assoc($usuarioName);
    $mailUser = mysqli_fetch_assoc($completeform);
    $musr = $mailUser['formularioCompletado'];
    $iduser = $idUsuario['idUsuario'];
    $nameUser = $username1['nombreUsuario'];
    if($musr == false){
        header("Location: ../Vistas/CompleteForm.html");
    }
}

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container bg-primary text-white m-0 mw-100">
        <div class="row align-items-start">
            <div class="col-10">
                <h2>Bienvenido, <?php echo $nameUser ?></h2>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end align-items-center">
                    <select class="form-select form-select-sm m-2" aria-label="Small select example" id="optionSession">
                        <option value="optionsSession">Opciones</option>
                        <option value="AcountOpptions">Cuenta</option>
                        <option value="closeSession">Cerrar sesión</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 align-items-center ">
        <form action="../Controles/SaveCash.php" method="POST">
            <div class="row align-items-stretch border rounded p-1 bg-primary">

                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">
                    <label for="tipoGasto">Tipo de gasto</label><br>
                </div>
                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">
                    <label for="tipoGasto">Cantidad del gasto</label><br>
                </div>
                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">
                    <label for="tipoGasto">Nombre del gasto</label><br>
                </div>
                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">
                    <label for="tipoGasto">Agregar gasto</label><br>
                </div>
                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">

                    <select class="form-select" id="tipoGasto" name="tipoGasto">
                        <option value="Ocio">Ocio y entretenimiento</option>
                        <option value="Vivienda">Vivienda</option>
                        <option value="Transporte">Transporte</option>
                        <option value="Comunicaciones">Comuniaciones</option>
                        <option value="Educacion">Educación</option>
                        <option value="Alimentos">Alimentos</option>
                        <option value="Ropa">Ropa y calzado</option>
                        <option value="Salud">Salud e higiene</option>
                        <option value="CuidadoP">Belleza y cuidado personal</option>
                        <option value="Deudas">Deudas</option>
                        <option value="Ahorro">Ahorro e inversiones</option>
                        <option value="Impuestos">Impuestos</option>
                        <option value="Emergencias">Emergencias</option>
                        <option value="Celebraciones">Celebraciones y regalos</option>
                        <option value="Eventos">Fiestas y eventos sociales</option>
                    </select>

                </div>

                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">
                    <input id="gasto" name="gasto" type="number" placeholder="$" class=" input-group-text" required><br><br>
                </div>
                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">
                    <input type="text" name="nombregasto" id="nombregasto" placeholder="Ingrese el nombre"
                        class=" input-group-text" required><br>
                </div>
                <div class="col-3 border bg-light d-flex justify-content-center align-items-center">

                    <button type="submit" class="btn btn-primary" name="yes">
                        <i class="bi bi-plus-square"></i> Agregar
                    </button>

                </div>
            </div>
        </form>
    </div>
    <hr>
    <div class="bg-primary p-1 m-2 w-50 border rounded">
        <div class="bg-light">
            <table class="table table-bordered">
                <tr>
                    <th scope="col" class="w-auto">Nombre de gasto</th>
                    <th scope="col" class="w-50">Tipo de gasto</th>
                    <th scope="col" class="">Cantidad</th>
                    <th scope="col" class="w-50">Acciones</th>
                </tr>
                <?php
                $counter = 0;
                $consul1 = mysqli_query($conexion, "SELECT * FROM gasto WHERE idUsuario = '$iduser'");
                while ($fila = mysqli_fetch_assoc($consul1)) {
                    echo "<tr>
                    <td scope='row'><input type='text' class=' input-group-text' value='{$fila['nombreGasto']}'></input></td>
                    <td>{$fila['tipoGasto']}</td>
                    <td><input type='number' class=' input-group-text' value='{$fila['precioGasto']}'></input></td>
                    <td>
                        <button class='btn btn-warning' type='submit'><i class='bi bi-pencil-fill'></i></button>
                        <button class='btn btn-danger' type='submit'><i class='bi bi-trash3-fill'></i></button>
                    </td></tr>";
                    $counter++;
                }
                ?>
            </table>
        </div>
    </div>
</body>
<script>
   optionSession.addEventListener("change", function() {
        if(optionSession.value == "closeSession") {
            <?php 
                $_SESSION = array();    
            ?>
            window.location.href = "loginview.html";
        }
        else if(optionSession.value == "AcountOpptions"){
            window.location.href = "AjustesCuenta.php";
        }
    });
</script>
</html>