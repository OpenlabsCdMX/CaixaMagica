<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php print(URL); ?>public/dist/img/logo.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo "Admin";//print($this->user->getNombre()); ?></p>
        <span><i class="fa fa-user-circle text-blue"></i>	&nbsp;Mágico</span>
      </div>
    </div>
    <!-- search form -->
    <!--form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

      <li><a class="asyncLink" href="<?php print(URL); ?>Caixa/listar/"><i class="fa fa-tasks"></i> <span>Listar Caixas</span></a></li>

      <li><a class="asyncLink" href="<?php print(URL); ?>Caixa/crear/"><i class="ion-android-add-circle"></i> <span>	&nbsp;Crear Caixa</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
