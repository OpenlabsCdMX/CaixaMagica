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

          <div class="panel panel-default" style="margin-top: 15px;">
            <div class="panel-heading">¿QUÉ TE A ESTE LUGAR? </div>
            <div class="panel-body" style="padding-left: 0px !important;padding-right: 0px !important;">

              <!--carousel -->
              <div id="magicarousel">
                <ul>
                  <li>1</li>
                  <li>2</li>
                  <li>3</li>
                  <li>4</li>
                  <li>5</li>
                  <li>6</li>
                  <li>7</li>
                  <li>8</li>
                  <li>9</li>
                </ul>
              </div>
              <!--/carousel -->

            </div>
          </div>

        </div>

      </div> <!-- /container -->
    </div>
    <!-- magicarousel -->
    <script src="<?php print(URL); ?>public/frameworks/modernizr/modernizr.js"></script>
    <script src="<?php print(URL); ?>public/js/magicarousel.js"></script>
  </body>
</hmtl>
