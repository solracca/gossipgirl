<?php
$conexion = mysqli_connect("localhost", "root", "", "gossipgirl");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>