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

          <div class="panel panel-default caixa" style="margin-top: 15px;">
              <div>Gracias por compartir tu punto de vista</div>
              <div>¡Tu contribución es muy importante!</div>
              <div class="btn" onclick="location.href='<?php print(URL); ?>Resultados/'">Ver Resultados</div>
        </div>

      </div> <!-- /container -->
    </div>
  </body>
</hmtl>
