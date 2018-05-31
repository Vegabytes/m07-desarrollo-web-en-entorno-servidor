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


    /*Comprobamos si en la llamada GET se ha pasado un id, si es así,
    hacemos una consulta a la base de datos, pidiendo los datos del usuario con
    ese id, de manera que podemos mostrar sus datos ya cargados en el formulario*/
    if (isset($_GET['id'])) {
        /*Llamamos a la función listar, pasándole como parámetro el id. Esta función se encarga de
        consultar los datos del usuario cuyo id se ha pasado como parámetro.*/
        $consulta = listar($_GET['id'], null, null);
        //Seteamos los datos devueltos en variables
        $persona = $consulta->fetch_assoc();
        $id = $persona["ID"];
        $nombre = $persona["Nombre"];
        $contrasena = $persona["Contrasena"];
        $email = $persona["Email"];
        $edad = $persona["Edad"];
        $fechaDeNacimiento = $persona["Fecha_de_Nacimiento"];
        $direccion = $persona["Direccion"];
        $codigoPostal = $persona["Codigo_Postal"];
        $provincia = $persona["Provincia"];
        $genero = $persona["Genero"];
    }
    ?>

    <h1 class="display-4 mb-5">
        <?php
        //El título del formulario cambio según estemos editando o creando un nuevo usuario
        if (isset($_GET['id'])) {
            echo "Editar usuario";
        } else {
            echo "Nuevo usuario";
        } ?>
    </h1>
    <form action="formularioUsuario.php" method="POST">
        <?php
        //El campo id solo se muestra si estamos editanto un usuario
        if (isset($id)) {
            echo "<div class='form-row'>
                <div class='col-md-4 mb-3'>
                <label for='id'>ID </label>
                <input type='text' class='form-control' id='id' placeholder='id' name='id' value=$id>
                </div>
                </div>";
        }
        ?>

        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="nombre">Nombre </label>
                <input type="text" class="form-control" id="nombre" placeholder="Introduzca su nombre" required
                       name="nombre" <?php if (isset($nombre)) echo "value=$nombre" ?>>
            </div>
            <div class="col-md-4 mb-3">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Introduzca su contraseña"
                           required
                           aria-describedby="password"
                           name="contrasena" <?php if (isset($contrasena)) echo "value=$contrasena" ?>>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Introduzca su email" required
                       name="email" <?php if (isset($email)) echo "value=$email" ?>>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="edad">Indique edad</label>
                <input type="number" class="form-control" id="edad" placeholder="Introduzca su edad" required
                       name="edad" <?php if (isset($edad)) echo "value=$edad" ?>>
            </div>
            <div class="col-md-4 mb-3">
                <label for="fechaDeNacimiento">Fecha nacimiento</label>
                <input type="date" class="form-control" id="fechaDeNacimiento" required
                       placeholder="Introduzca su fecha de nacimiento"
                       name="fechaDeNacimiento" <?php if (isset($fechaDeNacimiento)) echo "value=$fechaDeNacimiento" ?>>
            </div>
            <div class="col-md-4 mb-3">
                <label for="direccion">Dirección </label>
                <input type="text" class="form-control" id="direccion" placeholder="Introduzca su direccion" required
                       name="direccion" <?php if (isset($direccion)) echo "value=$direccion" ?>>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="codigoPostal">Código postal</label>
                <input type="text" class="form-control" id="codigoPostal" placeholder="Introduzca su código postal"
                       required
                       name="codigoPostal" <?php if (isset($codigoPostal)) echo "value=$codigoPostal" ?>>
            </div>
            <div class="col-md-4 mb-3">
                <label for="provincia">Provincia</label>

                <select class="form-control" id="provincia" name="provincia">
                    <?php
                    $consulta = listarProvincias();
                    while ($provincia = $consulta->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $provincia['nombre'] ?> ">
                            <?php echo $provincia['nombre'] ?>
                        </option>
                        <?php
                    }


                    ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <p>Género</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genero" id="hombre"
                           value="H" <?php if (isset($genero) && $genero == 'H') echo "checked"; ?>>
                    <label class="form-check-label" for="hombre">
                        Hombre
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genero" id="mujer"
                           value="M" <?php if (isset($genero) && $genero == 'M') echo "checked" ?>>
                    <label class="form-check-label" for="mujer">
                        Mujer
                    </label>
                </div>
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
        //Guardamos los datos del formulario
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            $id = null;
        }
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        } else {
            $nombre = null;
        }
        if (isset($_POST['contrasena'])) {
            $contrasena = $_POST['contrasena'];
        } else {
            $contrasena = null;
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $email = null;
        }
        if (isset($_POST['edad'])) {
            $edad = $_POST['edad'];
        } else {
            $edad = null;
        }
        if (isset($_POST['fechaDeNacimiento'])) {
            $fechaDeNacimiento = $_POST['fechaDeNacimiento'];
        } else {
            $fechaDeNacimiento = null;
        }
        if (isset($_POST['direccion'])) {
            $direccion = $_POST['direccion'];
        } else {
            $direccion = null;
        }
        if (isset($_POST['codigoPostal'])) {
            $codigoPostal = $_POST['codigoPostal'];
        } else {
            $codigoPostal = null;
        }
        if (isset($_POST['provincia'])) {
            $provincia = $_POST['provincia'];
        } else {
            $provincia = null;
        }
        if (isset($_POST['genero'])) {
            $genero = $_POST['genero'];
        } else {
            $genero = null;
        }


        //Si hay id de usuario, llamamos a la función actualizar, pasándole como parámetro los datos del usuario
        if (isset($id)) {
            actualizar($id, $nombre, $contrasena, $email, $edad, $fechaDeNacimiento, $direccion, $codigoPostal, $provincia, $genero);
        } //Si no hay id, llamamos a la función insertar pasándole como parámetro los datos introducidos en el formulario
        else {
            insertar($nombre, $contrasena, $email, $edad, $fechaDeNacimiento, $direccion, $codigoPostal, $provincia, $genero);
        }
    }
    ?>
</div>
</body>
</html>






