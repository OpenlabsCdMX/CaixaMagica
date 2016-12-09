<?php include MODULE."header.php"; ?>
<body>

    <?php include MODULE."navbar.php" ?>

    <div id="app">

      <?php include MODULE."hamburguer_menu.php" ?>

      <!-- App content -->
      <div id="sombra"></div>
      <div id="content" class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div>
          <h1>Resultados</h1>
          <?php foreach ($this->respuestas as $asuntos): ?>
          <h3 class="title"><?php print_r($asuntos["asunto"]);?></h3>
          <ul class="resultsList">
              <?php foreach ($asuntos["respuestas"] as $respuestas): ?>
              <li>
                  <ul>
                  <?php foreach ($respuestas as $key => $respuesta): ?>
                      <li>
                          <?php if(isset($respuesta["comentarios"])): ?>
                          <div>Comentarios:</div>
                          <ul>
                          <?php foreach ($respuesta["comentarios"] as $comentario): ?>
                              <li>
                                  <div class="comment">
                                      <?php print($respuesta["texto"]." ".$comentario["texto"]); ?>
                                      <span class="votes">Votos: <?php print_r($comentario["votos"]) ?></span>
                                  </div>
                              </li>
                          <?php endforeach; ?>
                          </ul>
                          <?php $tv = 0; if($key == "total_votos"){ $tv = $respuestas["total_votos"]; } ?>
                          <?php elseif(($key."" != "opciones" && $key."" != "total_votos")): ?>
                                <div class="comment">
                                  <?php print($respuesta["texto"]); ?>
                                    <div style="float:right"><?php print($respuesta["votos"]." de ".$tv." (".(($respuesta["votos"]/$tv)*100)."%)"); ?></div>
                                    <div class="filleable" data-percent="<?php print(($respuesta["votos"]/$tv)); ?>"></div>
                                </div>
                          <?php endif; ?>
                      </li>
                  <?php endforeach; ?>
                  </ul>
              </li>
              <?php endforeach; ?>
          </ul>
          <?php endforeach; ?>
        </div>

      </div> <!-- /container -->
    </div>
  </body>
</hmtl>
