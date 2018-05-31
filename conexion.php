<?php
//Necesitamos utilizar esta función para poder utilizar las sesiones
session_start();

//Incluimos el fichero parametros.php que almacena las variables de conexión
require_once('parametros.php');

//Hacemos la conexión a la base de datos utilizando la extensión mysqli
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


//Contemplamos un posible error de conexión
if ($conexion->connect_errno) {
    echo 'Error en la conexión';
    exit;
}


/* Cambiamos el conjunto de caracteres de latin1 a utf8 */
if (!$conexion->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexion->error);
    exit();
} else {
    $conexion->character_set_name();
}

?>