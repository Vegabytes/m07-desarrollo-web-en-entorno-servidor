<?php
//Incluimos el fichero que realiza la conexión a la base de datos
include 'conexion.php';
//Incluimos el fichero que se encarga de hacer las consultas a la base de datos
include "consultas.php";

if (isset($_GET['ocultarNoticias'])) {
    $ocultarNoticias= true;
} else {
    $ocultarNoticias= false;
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
            integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
            crossorigin="anonymous">
    </script>
<body>
<div class="container">

    <?php
    //Se incluye el fichero con la cabecera
    include "cabecera.php";
    ?>
    <?php

        include "slider.php";


    ?>

    <div class="jumbotron">
        <div style="float:right">
            <?php
            //Si existe el fichero usuarios.xml, renderizamos el icono que permite leer este fichero
            if (file_exists("xml/usuarios.xml")) {
                ?>
                <!--                Mostramos en una nueva ventan los datos del fichero usuarios.xml-->
                <a class="p-2 text-dark" href="#"
                   onClick="window.open('leerXml.php','Login','toolbar=0,location=yes,directories=0,top=50,left=50 status=yes,menubar=0,scrollbars=yes,resizable=yes,width=1200,height=450,titlebar=yes')">
                    <img src="images/xml.png" alt="mostrar archivo xml" style="width:40px">
                </a>
                <?php
            }
            //Si existe el fichero usuarios.txt, renderizamos el icono que permite leer este fichero
            if (file_exists("txt/usuarios.txt")) {
                ?>
<!--                Mostramos en una nueva ventan los datos del fichero usuarios.txt-->
                <a class="p-2 text-dark" href="#"
                   onClick="window.open('leerTxt.php','Login','toolbar=0,location=yes,directories=0,top=50,left=50 status=yes,menubar=0,scrollbars=yes,resizable=yes,width=1200,height=450,titlebar=yes')">
                    <img src="images/txt.png" alt="mostrar archivo txt" style="width:40px">
                </a>

                <?php
            }
            ?>
        </div>
        <h2> M07: Desarrollo web en entorno servidor
        </h2>
        <h3> Unidad Formativa 4: Servicios web. Páginas dinámicas interactivas.
            Webs híbridas.</h3>




        <?php

        /*Comprobamos que por la url, se está intentanto crear o eliminar un fichero. Es decir, se comprueba si por GET
        se están pasando los parámetros tipo y acción*/
        if (isset($_GET['tipo']) && isset($_GET['accion'])) {
            //Se setean los valores pasado por la Url
            $tipo = $_GET['tipo'];
            $accion = $_GET['accion'];


            //Si vamos a generar un fichero
            if ($accion === 'generar') {

                //Se recuperan todos los registros de la tabla usuarios
                $registros = listarTodos();

                //Llamamos a exportarXml pasando el total de registros
                if ($tipo === 'xml') {
                    exportarXml("xml/usuarios.xml",$registros);
                }
                //Llamamos a exportarTxt pasando el total de registros
                else {
                    exportarTxt("txt/usuarios.txt", $registros);
                }
            }

            //En el caso de querer borrar un fichero
            if ($accion === 'borrar') {

                //Llamamos a borrarFichero, pasando la ruta del fichero que queremos borrar
                if ($tipo === 'xml') {
                    borrarFichero("xml/usuarios.xml");
                } else {
                    borrarFichero("txt/usuarios.txt");

                }
            }


        }
        ?>
    </div>



    <?php
    if($ocultarNoticias){
        include "contenido.php";
    } else {
        include "noticias.php";
    }


    //Se incluye el pie de la aplicación
    include "pie.php";
    ?>

    <?php
    //Si existe id y permanecemos en index.php, eliminamos registro.
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        eliminar($id);
    }
    ?>
</div>
</body>
</html>


<!--https://m07-desarrollo-web-en-entorno-servidor.000webhostapp.com/-->

