<div class="row carousel-holder">
   <div class="col-md-12">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <?php for($i = 0; $i < count($carrusel); $i++):?>
                <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="<?=($i == 0 ? 'active' : '' )?>"></li>
            <?php endfor ?>
         </ol>
         <div class="carousel-inner">
            <?php
                $i = 0;
                foreach ($carrusel as $productoCarrusel) :
            ?>
                <div class="item <?=($i++ == 0 ? 'active' : '' )?>">
                <img class="slide-image"
                    src="<?= ProyectoWeb\entity\Product::RUTA_IMAGENES_CARRUSEL . $productoCarrusel->getCarrusuel();?>"
                    alt="<?= $productoCarrusel->getNombre()?>" 
                    title="<?= $productoCarrusel->getNombre()?>">
                </div>
            <?php endforeach ?>
            <div class="item">
               <img class="slide-image" src="/images/carrusel/caracteristicas-cuidados-del-tulipan-1280x720x80xX.jpg" alt="Tulipán" title="Tulipán">
            </div>
            <div class="item">
               <img class="slide-image" src="/images/carrusel/20077.jpg" alt="Flor de pascua" title="Flor de pascua">
            </div>
            <div class="item active">
               <img class="slide-image" src="/images/carrusel/Coltivazione-Lilium-800x445.jpg" alt="Lilium" title="Lilium">
            </div>
            <div class="item">
               <img class="slide-image" src="/images/carrusel/Grow-Roses-Header-OG.jpg" alt="Rosa" title="Rosa">
            </div>
         </div>
         <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left"></span>
         </a>
         <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right"></span>
         </a>
      </div>
   </div>
</div>