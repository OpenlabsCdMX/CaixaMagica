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

  <div class="col-md-12">
    <div class="box box-danger">
            <div class="box-body">

              <div class="form-group">
                  <label>
                    <h3>
                      Seleccione el Operador responsable
                    </h3>
                    <small>Operadores activos</small>
                  </label>
                  <select id="selectOperador" class="form-control">
                    <option value="">Seleccione un operador</option>
                    <?php foreach ($this->operadores as $index => $operador) : ?>
                      <option value="<?php print($operador["documento"]); ?>" style="font-size:120%; padding:5px;"><?php print($operador["nombres"]." ".$operador["apellidos"]." - ".$operador["cargo"]["value"]); ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>

              <div class="form-group">
                  <label>
                    <h3>
                      Seleccione los Equipos a asignar
                    </h3>
                    <small>(para seleccionar mas de un equipo presione la tecla Ctrl y haga click)</small>
                  </label>
                  <select id="selectEquipos" multiple="" class="form-control">
                    <?php foreach ($this->equipos as $index => $equipo) : ?>
                    <option value="<?php print($equipo["serial"]); ?>" style="font-size:120%; border-bottom: 1px solid rgba(0,0,0,0.2); padding:5px;"><?php print($equipo["descripcion"]." - ".$equipo["leyenda"]); ?></option>
                  <?php endforeach; ?>
                  </select>
              </div>

              <button type="button" id="asignarBtn" class="btn btn-block btn-danger btn-lg">Asignar Equipos</button>

            </div>
            <!-- /.box-body -->
          </div>
  </div>
  <script type="text/javascript">
    $(function(){
        $("#asignarBtn").click(function(e){
          e.preventDefault();
          var data = {};
          data.documentoOperario = $("#selectOperador").val();
          data.equipos = $("#selectEquipos").val();

          $.ajax({
            url: "<?php print(URL); ?>Equipos/prestamo",
            method: "POST",
            data: data
          }).done(function(r){
            console.log(r);
          });

        });
    });
  </script>
</section>
<!-- /.content -->
