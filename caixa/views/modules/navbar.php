<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">

    <!-- navbar -->
    <div class="navbar-header section-title">
      <button id="hamburguer" type="button" class="nav-btn flx-left mobile-only" data-target="hamburguer-content">
        <span class="	glyphicon glyphicon-menu-hamburger" syle="padding 2px;"></span>
      </button>
      <div class="title mobile-only">
        <?php print($this->mobileTitle); ?>
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
      <li <?php if($this->menuHL == "inicio"){ print('class="active"');} ?>><a href="<?php print(URL); ?>">Inicio</a></li>
      <!--li <?php if($this->menuHL == "resultados"){ print('class="active"');} ?>><a href="<?php print(URL."Resultados/"); ?>">Resultados</a></li-->
      <li <?php if($this->menuHL == "about"){ print('class="active"');} ?>><a href="<?php print(URL."About/"); ?>">¿Qué es caixa mágica?</a></li>
      <li <?php if($this->menuHL == "contacto"){ print('class="active"');} ?>><a href="<?php print(URL."Contacto/"); ?>">Contacto</a></li>
    </ul>
    <!--/ Desktop Menu -->
    <!--/.nav-collapse -->
  </div>
</nav>
