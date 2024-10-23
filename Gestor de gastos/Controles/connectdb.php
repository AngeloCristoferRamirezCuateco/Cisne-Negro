<?php

$conexion = mysqli_connect('localhost','root','','gestionbeta');
if(!$conexion){
    die("Conexion con la base de datos fallida");
}