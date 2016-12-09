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
              <div class="btn" onclick="location.href='<?php print(URL); ?>Resultados/index/?id=<?php print($this->idOpcion); ?>&tipo=<?php print($this->tipoOpcion); ?>'">Ver Resultados</div>
              <!--div class="btn" onclick="alert('Estamos trabajando en esta sección, pero no te preocupes, pronto estará lista.')">Ver Resultados</div-->
              <div class="btn" onclick="location.href='<?php print(URL); ?>'">Volver al inicio</div>
          </div>

      </div> <!-- /container -->
    </div>
  </body>
</hmtl>
