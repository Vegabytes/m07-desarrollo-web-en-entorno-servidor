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
<div class="container" style="text-align: center">
    <!-- Esta vista renderiza el fichero usuarios.xml-->
    <h1 class="display-4 pb-3 pt-3"">
    Vista del fichero TXT
    </h1>
    <table class="table table table-striped">
        <tbody>

        <?php
        //Abrimos el fichero txt/usuario.txt
        $file = fopen("txt/usuarios.txt", "r") or die("Unable to open file!");

        //Comprobamos si el puntero a un archivo está al final del archivo, para averiguar cuando terminan los datos
        while (!feof($file)) {
            //Renderizamos los datos de cada fila del fichero en una nueva fila de la tabla
            $data = fgets($file);
            echo "<tr><td>" . $data . "</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>