<?php include MODULE."header.php"; ?>
<body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">

        <!-- navbar -->
        <div class="navbar-header section-title">
          <button id="hamburguer" type="button" class="nav-btn collapsed flx-left mobile-only" data-target="hamburguer-content">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="title mobile-only">
            Inicio
          </div>
          <button type="button" class="nav-btn collapsed flx-right mobile-only" style="padding: 6px 10px;">
            <a href="<?php print(URL); ?>">
              <span class="glyphicon glyphicon-home"></span>
            </a>
          </button>
        </div>
        <!-- fin navbar -->
        <!-- Desktop Menu -->
        <ul id="desktop-menu" class="nav navbar-nav">
          <li class="active"><a href="<?php print(URL); ?>">Inicio</a></li>
          <li><a href="#results">Resultados</a></li>
          <li><a href="#about">¿Qué es caixa mágica?</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
        <!--/ Desktop Menu -->
        <!--/.nav-collapse -->
      </div>
    </nav>
    <div id="app">
      <!-- hidden hamburguer content -->
      <div id="hamburguer-content" data-hidden="true">
        <ul class="nav navbar-nav">
          <!-- Automatic filled with desktop content -->
        </ul>
      </div>
      <!-- App content -->
      <div id="content" class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div>
          <h1>Caixa Mágica</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p>Debemos actualizar esto pronto</p>
        </div>

      </div> <!-- /container -->
    </div>
  </body>
</hmtl>
