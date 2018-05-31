<body>
<!--Tabla donde se listan los usuarios-->
<?php

/*Aquí va la lógica de la paginación de la tabla*/
/*En la variable $pagina vamos indicar en qué página estamos cada vez, pasándo este parámetro
por la url. En caso de que venga vació, no sea numérico o no venga, redirigimos a la primera página*/

if (isset($_GET["pagina"])) {
    if (is_numeric($_GET["pagina"])) {
        if ($_GET["pagina"] == 1) {
            $pagina = 1;
        } else {
            $pagina = $_GET["pagina"];
        }
    } else {
        $pagina = 1;
    }
} else {
    $pagina = 1;
}

//En esta variable definimos cuántos registros queremos por página, para esta práctica son 10
$cantidad_resultados_por_pagina = 10;

/*Para definir a partir de qué registro queremos listar, y que viene determinado por la página
en la que nos encontramos y por el total de regsitros que queremos mostrar.
Hay que tener en cuenta que el primer registro es el 0, por eso restamos la página
actual menos 1*/
$empezar_desde = ($pagina - 1) * $cantidad_resultados_por_pagina;

/*Ejecutamos la función listar que pide a la base de datos usuarios empezando por el registro que le indiquemos con $empezar_desde,
y el total de registros que queremos recuperar indicado con $cantidad_resultados_por_pagina*/
$consulta = listar(null, $empezar_desde, $cantidad_resultados_por_pagina);



/*Para averiguar el número total de páginas que vamos a tener, debemos obtener el número total
de registros de la base de dastos*/
$consulta2 = calcularTotal();


/*Y dividiendo el total de usuario entre el número de registros por página, obtenemos el número total de páginas*/
$total = $consulta2->fetch_assoc();
$total_paginas = ceil($total['totalUsuarios'] / $cantidad_resultados_por_pagina);

?>

<h3>Lista de usuarios</h3>
<p>Total usuarios <?php echo $total['totalUsuarios'] ?></p>
<table class="table table table-striped">
    <thead>

    <?php
    //Si no hay registros, no mostramos la tabla
    $totalFilas = $consulta->num_rows;
    if ($totalFilas > 0) {
        echo "    <tr>
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
    </tr>";
    }
    ?>
    </thead>
    <tbody>
    <?php

    /*Creamos un array asociativo con fetch_assoc con todos los resultados de la consulta,
    y lo recorremos con un bucle while para poder renderizarlos como filas de la tabla*/

    while ($persona = $consulta->fetch_assoc()) {
        ?>
        <!--Generamos el listado vaciando las variables de la consulta en la tabla-->
        <tr>
            <td>
                <?php if (isset($persona['ID'])) {
                    echo $persona['ID'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Nombre'])) {
                    echo $persona['Nombre'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Contrasena'])) {
                    echo $persona['Contrasena'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Email'])) {
                    echo $persona['Email'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Edad'])) {
                    echo $persona['Edad'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Fecha_de_Nacimiento'])) {
                    //Formateamos la fecha para que se muestre en el formato deseado
                    echo date("d-m-Y", strtotime($persona['Fecha_de_Nacimiento']));
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Direccion'])) {
                    echo $persona['Direccion'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Codigo_Postal'])) {
                    echo $persona['Codigo_Postal'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Provincia'])) {
                    echo $persona['Provincia'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <td>
                <?php if (isset($persona['Genero'])) {
                    echo $persona['Genero'];
                } else {
                    echo 'No disponible';
                }; ?>
            </td>
            <?php     /*Si no hay un usuario registrado no mostramos los botones de eliminar y editar*/
            if (isset($_SESSION['id'])) { ?>
                <td><a href="formularioUsuario.php?id=<?php echo $persona['ID'] ?>"><i class="fas fa-pencil-alt"
                                                                                       title="Editar usuario"></i></a>
                </td>
                <td><a href="index.php?id=<?php echo $persona['ID'] ?>"><i class="fas fa-trash-alt"
                                                                           title="Eliminar usuario"></i></a></td>
            <?php } ?>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
<!--Este es el código para realizar la paginación de usuario-->
<nav aria-label="Page navigation example" style="float: right">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="index.php" aria-label="Previous">
                <span aria-hidden="true">&laquo;&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>

        <?php
        //Si estamos en la página uno, deshabilitamos el botón de ir a vista previa
        if ($pagina == 1) {
            ?>
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php
        } else {
            ?>
            <li class="page-item">
                <a class="page-link" href="index.php?pagina=<?php echo $pagina - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php
        }
        ?>

        <?php
        for ($i = 1; $i <= $total_paginas; $i++) {
            ?>
            <li class="page-item <?php if ($pagina == $i) {
                echo active;
            } ?>"><a class="page-link" href="index.php?pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php
        }
        ?>
        <?php
        //Si estamos en la última página, deshabilitamos la opción de ir a la vista siguiente
        if ($pagina == $total_paginas) {
            ?>
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php
        } else {
            ?>
            <li class="page-item">
                <a class="page-link" href="index.php?pagina=<?php echo $pagina + 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php
        }
        ?>

        <li class="page-item">
            <a class="page-link" href="index.php?pagina=<?php echo $total_paginas ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>