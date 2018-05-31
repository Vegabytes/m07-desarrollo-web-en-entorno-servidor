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
<div class="container" style="text-align: center;">
    <?php
    //Incluimos el fichero que realiza la conexión a la base de datos
    include "conexion.php";
    //Incluimos el fichero que se encarga de hacer las consultas a la base de datos
    include "consultas.php";
    ?>


    <h1 class="display-4 pb-3 pt-3">
        Logout
    </h1>
    <!--Mostramos el nombre del usuario-->
    <h4><?php echo $_SESSION['nombre'] ?>, ¿Seguro que quiere salir de la sesión?</h4>
    <form action="logout.php" method="POST" class="mt-5">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary btn-lg btn-block" name="logout">Salir</button>
            </div>
        </div>
    </form>

    <?php
    //Comprobamos que se ha enviado el formulario
    if (!empty($_POST)) {
        //Si se ha enviado el formulario, destruimos la sesión, cerramos la ventana y regrescamos la página principal
        session_destroy();
        echo "<script type='text/javascript'>";
        echo "opener.location.reload(true);";
        echo "window.close();";
        echo "</script>";
    }
    ?>
</div>
</body>
</html>






