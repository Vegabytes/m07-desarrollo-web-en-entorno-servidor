<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow"
     id="menu" style="padding: 16px 0 !important;">
<!--    Mostramos el nombre del usuario que se ha logueado-->
    <h5 class="my-0 mr-md-auto font-weight-normal"><?php if (isset($_SESSION['nombre'])) echo "Bienvenido/a " . $_SESSION['nombre'] . ', son las ' . date('H:i') ?></h5>
    <nav class="my-2 my-md-0 mr-md-3" style="font-size: 13px;">

        <!--Mostramos la opción de logout solo cuando el usuario ya está logueado-->
        <?php
        if (isset($_SESSION['id'])) {
            ?>
            <a class="p-2 text-dark" href="#"
               onClick="window.open('logout.php','Login','toolbar=0,location=yes,directories=0,top=50,left=400 status=yes,menubar=0,scrollbars=yes,resizable=yes,width=350,height=350,titlebar=yes')"><i
                        class="fas fa-sign-out-alt" title="Logout"></i></a>
        <?php } ?>


        <!--Mostramos la opción de login solo cuando no hay ningún usuario logueado-->
        <?php
        if (!isset($_SESSION['id'])) {
            ?>
            <a class="p-2 text-dark" href="#"
               onClick="window.open('login.php','Login','toolbar=0,location=yes,directories=0,top=50,left=400 status=yes,menubar=0,scrollbars=yes,resizable=yes,width=400,height=400,titlebar=yes')"><i
                        class="fas fa-sign-in-alt" title="Login"></i></a>
        <?php } ?>

        <a class="p-2 text-dark" href="index.php">Inicio</a>
        <!-- Creamos en el menú superior las opciones para poder crear y borrar ficheros-->
        <a class="p-2 text-dark" href="index.php?tipo=xml&accion=generar">Crear XML</a>|
        <a class="p-2 text-dark" href="index.php?tipo=xml&accion=borrar">Borrar XML</a>
        <a class="p-2 text-dark" href="index.php?tipo=txt&accion=generar">Crear TXT</a>|
        <a class="p-2 text-dark" href="index.php?tipo=txt&accion=borrar">Borrar TXT</a>
        <a class='p-2 text-dark' href='index.php?ocultarNoticias=true'>Ver usuarios</a>


        <!--Tanto la opción Crear usuario como Crear provincia se muestran solo cuando el usuario está logueado-->
        <?php
        if (isset($_SESSION['id'])) {
            echo "<a class='p-2 text-dark' href='formularioUsuario.php'>Crear usuario</a>
                  <a class='p-2 text-dark' href='formularioProvincias.php'>Crear provincia</a>
                  <a class='p-2 text-dark' href='formularioImagenes.php'>Imágenes</a>";
        }
        ?>
    </nav>
</div>




        
