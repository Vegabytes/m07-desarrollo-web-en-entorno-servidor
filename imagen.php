<?php
header("Content-type: image/jpg");
include 'conexion.php';

include "consultas.php";

if(isset($_GET['idfoto'])){
    $id = $_GET['idfoto'];
    $imagen = consultaImagen($id);
    $foto = $imagen->fetch_assoc();
    $blob = $foto['foto'];
    echo $blob;
}


?>