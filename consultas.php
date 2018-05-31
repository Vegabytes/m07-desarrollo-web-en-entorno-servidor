<?php
/*
 * Este método recibe como único parámetro el id del usuario. Si el id viene como NULL, significa que queremos
 * recuperar todos los registros de la base de datos para mostrarlos en una tabla. Si el id es un id real de un usuario ya existente,
 * recupera los datos de ese usuario.
 */
function listar($id, $empezar_desde, $cantidad_resultados_por_pagina)
{
    global $conexion;
    if (isset($id)) {
        $sql = "Select * from usuarios where ID = $id";
    } else {
        $sql = "Select * from usuarios order by ID desc limit $empezar_desde,$cantidad_resultados_por_pagina";
    }
    return $conexion->query($sql);
}

/*Este método nos trae el total de registros de una consulta, y lo utilizamos para implementar la lógica de la paginación*/
function calcularTotal()
{
    global $conexion;
    $sql = "Select count(*) as totalUsuarios from usuarios";

    return $conexion->query($sql);
}

/*
 * Este método permite insertar un nuevo registro en la base de datos, cuyos valores serán los que se han introducido
 *  a través del formulario y que recibe aquí como parámtetro
 */
function insertar($nombre, $contrasena, $email, $edad, $fechaDeNacimiento, $direccion, $codigoPostal, $provincia, $genero)
{
    global $conexion;
    $sql = "Insert into usuarios(Nombre,Contrasena,Email,Edad,Fecha_de_Nacimiento,Direccion,Codigo_Postal,Provincia,Genero) 
            values ('$nombre','$contrasena','$email',$edad,'$fechaDeNacimiento','$direccion','$codigoPostal','$provincia','$genero')";
    if ($conexion->query($sql) === TRUE) {
        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
            Se ha creado correctamente el usuario $nombre.
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

/*
 * Este método permite eliminar un registro a través de su id recibido por parámetro.
 */
function eliminar($id)
{
    global $conexion;
    $sql = "Delete from usuarios where ID = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
            El usuario con id $id ha sido eliminado correctamente.
            </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

/*
 * Este método permite actualizar un registro por medio de su id, y los nuevos valores son recibidos como parámetros.
 */
function actualizar($id, $nombre, $contrasena, $email, $edad, $fechaDeNacimiento, $direccion, $codigoPostal, $provincia, $genero)
{
    global $conexion;
    $sql = "Update usuarios set Nombre = '$nombre',Contrasena = '$contrasena',Email='$email',Edad='$edad',Fecha_de_Nacimiento='$fechaDeNacimiento',
Direccion='$direccion',Codigo_Postal='$codigoPostal',Provincia='$provincia',Genero='$genero' where ID = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
            Se ha actualizado correctamente el usuario con id $id.
            </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

/*Este método permite recuperar de la base de datos un listado con todas las provincias españolas para poder listarlas
dentro de un select*/
function listarProvincias()
{
    global $conexion;
    $sql = "Select * from provincias";
    return $conexion->query($sql);
}
/*Este método permite recuperar de la base de datos un listado con todas las provincias españolas para poder listarlas
dentro de un select*/
function recuperarImagenes()
{
    global $conexion;
    $sql = "Select * from imagenes";
    return $conexion->query($sql);
}

function totalImagenes(){
    global $conexion;
    $sql = "Select count(*) as totalImagenes from imagenes";

    return $conexion->query($sql);
}

function consultaImagen($id){
    echo $id;
    global $conexion;
    $sql = "Select foto from imagenes where idfoto = $id";
    echo $sql;
    return $conexion->query($sql);
}

function recuperarNoticias()
{
    global $conexion;
    $sql = "Select * from noticias";
    return $conexion->query($sql);
}


/*Este método permite insertar una nueva provincia en la base de datos, en la tabla provincias*/
function insertarProvincia($nombreProvincia)
{
    global $conexion;
    $sql = "Insert into provincias(Nombre) values ('$nombreProvincia')";
    if ($conexion->query($sql) === TRUE) {
        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
            Se ha creado correctamente la provincia $nombreProvincia.
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

/**/
function insertarImagen($nombreImagen,$imagen,$descripcionImagen)
{
    global $conexion;
    echo $imagen['type'];

    // Recuperamos el blob
    $fp = fopen($imagen['tmp_name'], "rb");
    $tfoto = fread($fp, filesize($imagen['tmp_name']));
    $tfoto = addslashes($tfoto);
    fclose($fp);


    $mime = $imagen['type'];


//    $fp = fopen($imagen['type'], "rb");
//    $mime = fread($fp, filesize($imagen['type']));
//    $mime = addslashes($mime);
//    fclose($fp);



   //echo $tfoto;
   //echo $mime;


    $sql = "Insert into imagenes(Nombre,Foto,Descripcion,Mime) values ('$nombreImagen','$tfoto','$descripcionImagen','$mime')";
    if ($conexion->query($sql) === TRUE) {
        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
            Se ha insertado correctamente la imagen $nombreImagen.
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}


//Este método nos permite saber si un usuario existe en la base de datos. Para ello recibimos como parámetros el email y la contraseña
function comprobarUsuario($email, $contrasena)
{
    global $conexion;
    $sql = "Select * from usuarios where Email = '$email' and Contrasena = '$contrasena'";
    return $conexion->query($sql);
}

//Este método inserta en la base de datos registroEntrada cada ususario que se ha logueado. Insertando el email del usuario y la hora del registro.
function registrarEntrada($usuario)
{
    global $conexion;
    $hora = date('H:i');

    $sql = "Insert into registroentrada (idUsuario,hora) values ('$usuario','$hora')";
    if ($conexion->query($sql) === TRUE) {
        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
            Se ha registrado correctamente $usuario;
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

/*Este método nos trae todos los usuarios de la base de datos que van a ser exportados a XML y a TXT.*/
function listarTodos()
{
    global $conexion;
    $sql = "Select * from usuarios order by ID desc";
    return $conexion->query($sql);
}


/*A continuación se escriben los métodos que crean y eliminan los ficheros xml y txt*/

/*Este método permite crear un archivo xml con información recogida de una base de datos.
Recibe como parámetros la ruta del fichero que se va a crear, y los registros de la base de datos*/
function exportarXml($fichero, $registros)
{
    //Utilizamos la funcionalidad de PHP para crear un nuevo documento del Dom
    $doc = new DOMDocument('1.0', 'UTF-8');
    //Establecemos que este nuevo elemento va a ser de tipo xml
    $doc->formatOutput = true;

    //Creamos un primer nodo llamado "usuarios"
    $usuarios = $doc->createElement("usuarios");
    //Este nodo usuarios va a colgar directamente del objeto DOM padre
    $usuarios = $doc->appendChild($usuarios);

    //Creamos un nodo creado con la fecha de creación, que hija del nodo usuarios
    $fecha = date("d/m/Y");
    $creado = $doc->createElement("creado", $fecha);
    $usuarios->appendChild($creado);

    /*Recorremos los registros recuperados de la base de datos para crear
     por cada usuario un elemento usuario, y un elemento hijo de usuario por cada uno
    de los campos de la tabla usuarios */

    while ($registro = $registros->fetch_assoc()) {

        //Nodo usuario
        $usuario = $doc->createElement("usuario");
        $usuario = $usuarios->appendChild($usuario);

        //Nodos de los campos de la tabla
        $id = $doc->createElement('id', $registro['ID']);
        $usuario->appendChild($id);
        $nombre = $doc->createElement('nombre', $registro['Nombre']);
        $usuario->appendChild($nombre);
        $contrasena = $doc->createElement('contrasena', $registro['Contrasena']);
        $usuario->appendChild($contrasena);
        $email = $doc->createElement('email', $registro['Email']);
        $usuario->appendChild($email);
        $edad = $doc->createElement('edad', $registro['Edad']);
        $usuario->appendChild($edad);
        $fechaNacimiento = $doc->createElement('fechaNacimiento', $registro['Fecha_de_Nacimiento']);
        $usuario->appendChild($fechaNacimiento);
        $direccion = $doc->createElement('direccion', $registro['Direccion']);
        $usuario->appendChild($direccion);
        $codigoPostal = $doc->createElement('codigoPostal', $registro['Codigo_Postal']);
        $usuario->appendChild($codigoPostal);
        $provincia = $doc->createElement('provincia', $registro['Provincia']);
        $usuario->appendChild($provincia);
        $genero = $doc->createElement('genero', $registro['Genero']);
        $usuario->appendChild($genero);
    }


    //Guardamos en el dom la estructura xml generada
    $doc->saveXML();

    //Y guardamos esta estructura en el fichero indicado
    $doc->save($fichero);
//    echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
//            El fichero <b>$fichero</b> se ha creado correctamente.
//              </div>";
    //Una vez creado el fichero navegamos al index.
    header("Location: index.php");
}

/*Este método permite crear un archivo txt con información recogida de una base de datos.
Recibe como parámetros la ruta del fichero que se va a crear, y los registros de la base de datos*/
function exportarTxt($fichero, $registros)
{

    /*Abrimos un nuevo archivo en la ruta especificada. Con w como parámetro se sobreescribe el archivo cada vez
    que se genere*/
    $archivo = fopen($fichero, "w") or die("Error al crear");
    //Escribimos la cabecera del fichero(título y fecha);
    fwrite($archivo, "INFORME DE ACTUALIZACIONES DE USUARIOS\r\n");
    fwrite($archivo, "\r\n");

    $fecha = date("d/m/Y\r\n");
    fwrite($archivo, "Fecha de creación:" . $fecha);

    fwrite($archivo, "\r\n");
    fwrite($archivo, '--------------------------------------');

    fwrite($archivo, "\r\n");
    fwrite($archivo, "\r\n");
    fwrite($archivo, "\r\n");

    /*Recorremos el array de registros y escribimos en el fichero los campos
    email y fecha de nacimiento*/
    while ($registro = $registros->fetch_assoc()) {
        fwrite($archivo, "Email: " . $registro['Email'] . "\r\n");
        fwrite($archivo, "Fecha de Nacimiento: " . $registro['Fecha_de_Nacimiento'] . "\r\n");
        fwrite($archivo, "\r\n");
    }

    //Cerramos el fichero abierto
    fclose($archivo);
//    echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
//            El fichero <b>$fichero</b> se ha creado correctamente.
//          </div>";
    //Una vez creado el fichero navegamos al index.
    header("Location: index.php");
}

//Este método permite eliminar un fichero especificando la ruta
function borrarFichero($fichero)
{
    //Antes de borrar comprobamos que el fichero existe
    if (file_exists($fichero)) {
        //borramos el fichero
        unlink($fichero);
//        echo "<div style='position:absolute;top:0' class='alert alert-success' role='alert'>
//            El fichero <b>$fichero</b> . se ha borrado correctamente.
//              </div>";
        //Una vez eliminado el fichero navegamos al index.
        header("Location: index.php");
    } else {
        //En el caso de que el fichero no exista, lanzamos un mensaje
        echo "<div style='position:absolute;top:0' class='alert alert-danger' role='alert'>
            El fichero <b>$fichero</b> no está creado.
              </div>";
    }

}

?>