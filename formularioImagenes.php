<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <?php
    //Incluimos el fichero que realiza la conexión a la base de datos
    include "conexion.php";
    //Incluimos el fichero que se encarga de hacer las consultas a la base de datos
    include "consultas.php";
    //Se incluye la cabecera de la aplicación
    include "cabecera.php";

    ?>

    <h1 class="display-4 mb-5">
        Nueva imagen
    </h1>
    <form action="formularioImagenes.php" method="POST" enctype="multipart/form-data">
        <div class='form-row'>
            <div class='col-md-4 mb-3'>
                <input type='hidden' class='form-control' id='id' placeholder='id' name='id' value=$id>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="nombreImagen">Nombre de la imagen </label>
                <input type="text" class="form-control" id="nombreImagen" placeholder="Introduzca el nombre de la imagen"
                       required
                       name="nombreImagen">
            </div>
            <div class="col-md-4 mb-3">
                <label for="descripcionImagen">Descripción de la imagen </label>
                <input type="text" class="form-control" id="descripcionImagen" placeholder="Introduzca la descripción de la imagen"
                       name="descripcionImagen">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="imagen">Subir imágen </label>
                <input type="file" class="form-control" id="imagen" placeholder="Suba la imágen deseada"
                       name="imagen">
            </div>
        </div>


        <div class="form-row">
            <div class="col-md-8 mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" aria-label="Aceptar condiciones" name="condiciones" required
                                   class="m-1">
                            Acepto enviar el formulario.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    </form>

    <?php
    //Se incluye el pie de la aplicación
    include "pie.php";
    ?>


    <?php

    //Comprobamos que se ha enviado el formulario
    if (!empty($_POST)) {

        //Guardamos los datos del formulario en variables (En este caso el nombre de la nueva provincia)
        if (isset($_POST['nombreImagen'])) {
            $nombreImagen = $_POST['nombreImagen'];
        } else {
            $nombreImagen = null;
        }
        if (isset($_POST['descripcionImagen'])) {
            $descripcionImagen = $_POST['descripcionImagen'];
        } else {
            $descripcionImagen = null;
        }
        if (isset($_FILES['imagen'])) {
            $imagen = $_FILES['imagen'];
        } else {
            $imagen = null;
        }
        /*LLamamos al método insertarProvincia, pasándole como único parámetro el nombre de la nueva provincia*/
        insertarImagen($nombreImagen,$imagen,$descripcionImagen);
    }
    ?>
</div>
</body>
</html>






