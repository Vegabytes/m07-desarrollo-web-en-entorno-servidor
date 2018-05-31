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

    <?php
    //Incluimos el fichero que realiza la conexión a la base de datos
    include "conexion.php";
    //Incluimos el fichero que se encarga de hacer las consultas a la base de datos
    include "consultas.php";
    ?>

    <h1 class="display-4 pb-3 pt-3"">
    Login
    </h1>
    <h4 class="mb-5">Por favor ingrese sus datos de acceso para obtener permisos de administrador</h4>
    <form action="login.php" method="POST">
        <div class='form-row'>
            <div class="col-md-4 mb-3">
                <input type="email" class="form-control" id="email" placeholder="Introduzca su email" required
                       name="email">
            </div>
        </div>
        <div class='form-row'>
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Introduzca su contraseña"
                           required
                           aria-describedby="password"
                           name="contrasena">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                <button type="reset" class="btn btn-danger btn-lg">Borrar</button>
            </div>
        </div>
    </form>

    <?php
    //Comprobamos que se ha enviado el formulario
    if (!empty($_POST)) {
        //Guardamos los datos del formulario en variables
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $email = null;
        }
        if (isset($_POST['contrasena'])) {
            $contrasena = $_POST['contrasena'];
        } else {
            $contrasena = null;
        }
        /*Llamamos al método comprobar usuario, pasándole el email y la contraseña, para recuperar el usuario con esos datos*/
        $consulta = comprobarUsuario($email, $contrasena);

        //Recuperamos el usuario de la base de datos
        $usuario = $consulta->fetch_assoc();

        //Calculamos el total de registros recuperados
        $totalFilas = $consulta->num_rows;

        //Si no se ha recuperado ningún registro, significa que el usuario no está logueado
        if ($totalFilas == 0) {

            //Y mostramos un mensaje informándo al usuario
            echo "<div class='alert alert-danger' role='alert'>
                     No existe ningún usuario con los datos introducidos;
                   </div>";
        }
        else {
            /*En el caso de que los datos se correspondan con un usuario de la base de datos
            Guardamos el id y el nombre en variables de sesión*/
            $_SESSION["id"] = $usuario['ID'];
            $_SESSION["nombre"] = $usuario['Nombre'];
            //Registramos a ese usuario que se ha logueado
            registrarEntrada($email);
            //Creamos la ventana emergente y recargamos la página principal
            echo "<script type='text/javascript'>";
            echo "opener.location.reload(true);";
            echo "window.close();";
            echo "</script>";
        }

    }
    ?>
</div>
</body>
</html>






