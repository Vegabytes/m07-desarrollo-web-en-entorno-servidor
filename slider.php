<?php
$consulta = recuperarImagenes();

$consulta2 = totalImagenes();
$total = $consulta2->fetch_assoc();
$totalImagenes = $total['totalImagenes'];


$imagen = $consulta->fetch_assoc();

//var_dump($imagen);
//echo $imagen['nombre'];
//$totalImagenes['totalImagenes'];

//while ($imagen = $consulta->fetch_assoc()) {
//    echo '<img style="width:50px" src="data:' . $imagen['mime'] . ';base64,'.base64_encode( $imagen['foto'] ).'"/>';
//}
//?>



<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php

        if($totalImagenes > 0){
            ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <?php
        }
        ?>


        <?php for ($i=1;$i<$totalImagenes;$i++){
            ?>
            <li data-target="#carouselExampleIndicators" data-slide-to=" <?php echo $i ?>"></li>

        <?php

        }?>

    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <?php



            if ($totalImagenes > 0) {
            echo '<img style="height:400px" class="d-block w-100" src="data:' . $imagen['mime'] . ';base64,'.base64_encode( $imagen['foto'] ).'"/>';

            } ?>
            <div class="carousel-caption d-none d-md-block">
                <h5><?php echo $imagen['nombre']?></h5>
                <p><?php echo $imagen['descripcion']?></p>
            </div>
        </div>


        <?php
        while ($imagen = $consulta->fetch_assoc()) {
            ?>
        <div class="carousel-item">
            <img class="d-block w-100" <?php echo '<img style="height:400px" class="d-block w-100" src="data:' . $imagen['mime'] . ';base64,'.base64_encode( $imagen['foto'] ).'"/>'; ?>
            <div class="carousel-caption d-none d-md-block">
                <h5><?php echo $imagen['nombre']?></h5>
                <p><?php echo $imagen['descripcion']?></p>
            </div>
        </div>
        <?php
        }
        ?>




    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>







