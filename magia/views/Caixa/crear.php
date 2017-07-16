<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <!-- Section Title -->
    <?php print($this->sectionTitle); ?>
    <!-- Section Subtitle -->
    <small><?php print($this->sectionStitle); ?></small>
  </h1>
  <!--ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol-->
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
            <!-- /.box-header -->
            <div class="box-body"><div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva Caixa!</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="crear_caixa">
              <div class="box-body">
                <div class="form-group">
                  <label>Titulo de la Caixa</label>
                  <input name="nombre" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión">
                </div>
                <p class="help-block">Si la caixa va a ser permanente deje sin diligenciar las fechas de inicio y fin.</p>
                <div class="form-group">
                  <label>Fecha inicial</label>
                  <input name="fecha_ini" type="date" class="form-control" placeholder="2017-01-24" value="00-00-0000">
                </div>
                <div class="form-group">
                  <label>Fecha final</label>
                  <input name="fecha_fin" type="date" class="form-control" placeholder="2017-01-30" value="00-00-0000">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Crear Caixa</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
            </div>
            <!-- /.box-body -->
          </div>

</section>
<script>
  $("form").submit(function(e){
    e.preventDefault();

    var fini = ($("input[name='fecha_ini']").val() == "" )? "0000-00-00" : $("input[name='fecha_ini']").val();
    var ffin = ($("input[name='fecha_fin']").val() == "" )? "0000-00-00" : $("input[name='fecha_fin']").val();

    var data = {
      id: null,
      nombre: $("input[name='nombre']").val(),
      fecha_ini: fini,
      fecha_fin: ffin
    };

    $.ajax({
      url: "<?php echo URL; ?>Caixa/create/",
      method: "POST",
      data: data
    }).done(function(r){
      console.log(r);
      var response = JSON.parse(r);
      if(response["error"] == 0){
        alert("Wow, una nueva Caixa ha sido creada!");
        <?php $this->reloadThis("Caixa/listar/"); ?>
      }else{
        alert("Se ha producido un error :(");
      }
    });
  });

</script>
<!-- /.content -->
