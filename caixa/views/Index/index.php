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
            
          <?php foreach($this->caixas as $caixa): ?>
          <div class="panel panel-default caixa" style="margin-top: 15px;">
              <div><?php print_r($caixa->getNombre()); ?></div>
              <div class="btn" onclick="location.href='<?php print(URL);?>Index/asunto/<?php print($caixa->getId()); ?>'">COMPARTIR</div>
          </div>
          <?php endforeach; ?>
        </div>

      </div> <!-- /container -->
    </div>
  </body>
</hmtl>
