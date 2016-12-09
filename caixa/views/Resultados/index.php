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
          <?php print_r($this->respuestas); ?>
          <?php foreach ($this->respuestas as $respuesta): ?>
          <div class="title"><?php print_r($respuesta["asunto"]);?></div>
          <?php endforeach; ?>
        </div>

      </div> <!-- /container -->
    </div>
  </body>
</hmtl>
