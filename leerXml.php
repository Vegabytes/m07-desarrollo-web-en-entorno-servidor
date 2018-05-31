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
    Vista del fichero XML
    </h1>
    <table class="table table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Fecha de Nacimiento</th>
            <th>Dirección</th>
            <th>Código Postal</th>
            <th>Provincia</th>
            <th>Género</th>
        </tr>
        </thead>
        <tbody>

        <?php
        //Recuperamos el fichero xml/usuarios.xml como un objeto
        $fichero = simplexml_load_file('xml/usuarios.xml');


        //Recorremos el objeto devuelto, y renderizamos los atributos de su propiedad usuario
        foreach ($fichero->usuario as $user) {
            ?>
            <tr>
                <td>
                    <?php if (isset($user->id)) {
                        echo $user->id;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->nombre)) {
                        echo $user->nombre;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->contrasena)) {
                        echo $user->contrasena;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->email)) {
                        echo $user->email;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->edad)) {
                        echo $user->edad;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->fechaNacimiento)) {
                        echo $user->fechaNacimiento;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->direccion)) {
                        echo $user->direccion;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->codigoPostal)) {
                        echo $user->codigoPostal;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->provincia)) {
                        echo $user->provincia;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
                <td>
                    <?php if (isset($user->genero)) {
                        echo $user->genero;
                    } else {
                        echo 'No disponible';
                    }; ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>