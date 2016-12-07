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
           <?php $n = sizeof($this->asuntos);?>
           <?php foreach($this->asuntos as $key => $asunto): ?>
          <div class="panel panel-default" style="margin-top: 15px;">
            <div class="panel-heading asunto">
                <div><?php print_r($asunto->getTexto()); ?></div>
                <div><?php print($key + 1);?>/<?php print($n);?></div>
            </div>
            <div class="panel-body" style="padding-left: 0px !important;padding-right: 0px !important;">

              <!--carousel -->
              <div class="magicarousel">
                <ul>
                  <?php foreach($asunto->opciones as $opcion ) : ?>
                    <li><?php echo $opcion->getTexto(); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <!--/carousel -->

            </div>
          </div>
            <?php endforeach; ?>

        </div>

      </div> <!-- /container -->
    </div>
    <!-- magicarousel -->
    <script src="<?php print(URL); ?>public/frameworks/modernizr/modernizr.js"></script>
    <script src="<?php print(URL); ?>public/js/magicarousel.js"></script>
  </body>
</hmtl>
