<?php
/**
 * Created by PhpStorm.
 * User: acastillo
 * Date: 31/05/2018
 * Time: 9:35
 */
$consulta = recuperarNoticias();
?>

<div class="row">

<?php
while ($noticia = $consulta->fetch_assoc()) {

    ?>

    <div class="col-3">
    <div class="card">
        <?php echo '<img style="height:400px" class="d-block w-100" src="data:image/jpg;base64,' . base64_encode($noticia['imagen']) . '"/>'; ?>
        <div class="card-body">
            <h5 class="card-title"><?php echo $noticia['titulo'] ?></h5>
            <p class="card-text"><?php echo $noticia['contenido'] ?></p>
        </div>
        <div class="card-body">
            <a href="<?php echo $noticia['link'] ?>" class="card-link">Ir a noticia</a>
        </div>
    </div>
    </div>



    <?php

}
    ?>

</div>
