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
        <div class="box-body">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editando Caja <?php print($this->caixa->getId()); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Titulo de la Caixa</label>
                            <input name="nombre" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión" value="<?php print($this->caixa->getNombre()); ?>">
                        </div>
                        <p class="help-block">Si la caixa va a ser permanente deje sin diligenciar las fechas de inicio y fin.</p>
                        <div class="form-group">
                            <label>Fecha inicial</label>
                            <input name="fecha_ini" type="date" class="form-control" placeholder="2017-01-24" value="<?php print($this->caixa->getFecha_ini()); ?>">
                        </div>
                        <div class="form-group">
                            <label>Fecha final</label>
                            <input name="fecha_fin" type="date" class="form-control" placeholder="2017-01-30" value="<?php print($this->caixa->getFecha_fin()); ?>">
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Asuntos de la Caixa <?php print($this->caixa->getId()); ?></h3>
                        <i class="toggle-box-btn pull-right ion-android-remove" style="cursor:pointer;"></i>
                    </div>
                    <div class="collapsible">
                    <?php foreach ($this->asuntos as $asunto): ?>
                        </br>
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Asunto <?php print($asunto->getId()); ?></h3>
                                    <i class="toggle-box-btn pull-right ion-android-remove" style="cursor:pointer;"></i>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <!-- Asunto collpasible area -->
                                <div class="collapsible">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input data-id="<?php print($asunto->getId()); ?>" name="nombre" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión" value="<?php print($asunto->getTexto()); ?>">
                                    </div>
                                </div>
                                <p>
                                    Opciones del asunto:
                                </p>
                                <!-- /.box-body -->
                                <?php foreach ($asunto->opciones as $n => $opcion): ?>


                                    <div class="collapsible col-md-12">
                                        <!-- general form elements -->
                                        <div class="box box-danger">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Opción <?php print($n + 1); ?></h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label>Tipo de Opción</label>
                                                    <select name="tipoOpcion" class="form-control">
                                                        <option value="OpcionAbierta" <?php if (get_class($opcion) == "OpcionAbierta") {
                                echo "selected='true'";
                            } ?>>Opción Abierta</option>
                                                        <option value="OpcionMultiple" <?php if (get_class($opcion) == "OpcionMultiple") {
                                echo "selected='true'";
                            } ?>>Opción Múltiple</option>
                                                        <option value="OpcionPila" <?php if (get_class($opcion) == "OpcionPila") {
                                echo "selected='true'";
                            } ?>>Opción Pila (No soportado aún)</option>
                                                    </select>
                                                    <label>Opción</label>
                                                    <input data-id="<?php print($opcion->getId()); ?>" name="nombre" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión" value="<?php print($opcion->getTexto()); ?>">
                                                </div>
                                            </div>
                                            <!-- /.box-body -->

                                        </div>
                                        <!-- /.box -->

                                    </div>

                        <?php endforeach; ?>
                                </form>
                            </div>

                            <div class="box-footer">
                                <button class="option-btn btn-block btn-flat btn-danger" style="font-weight:bold;">
                                  <i class="ion-android-add-circle"></i>&nbsp;
                                  Agregar otra opción al Asunto</button>
                            </div>
                            <!-- /.box -->

                        </div>
                      </div>

<?php endforeach; ?>
</div>
<!--/ Collapsible area of asuntos -->

                    <div class="box-footer">
                        <button class="issue-btn btn-block btn-flat btn-warning" style="font-weight:bold;">
                          <i class="ion-android-add-circle"></i>&nbsp;
                          Agregar otro asunto a la Caixa</button>
                    </div>
                </div>
                <!-- /.box -->

            </div>

            <div class="box-footer">
                <button class="update-btn btn-block btn-flat btn-primary" style="font-weight:bold;">
                  <i class="ion-android-add-circle"></i>&nbsp;
                  Actualizar Caixa</button>
            </div>

        </div>

        <!-- /.box-body -->
    </div>

</section>
<script>

    $(function(){

      $.each($(".toggle-box-btn"),function(){
        toggleSlideBox($(this));
      });

      $(".toggle-box-btn").click(function(){
        toggleSlideBox($(this));
      });

      function toggleSlideBox(el){
        var box = el.parent().parent();
        var collapsible = box.find(".collapsible");
        collapsible.slideToggle();

        if(el.hasClass("ion-android-remove")){
          el.removeClass("ion-android-remove").addClass("ion-android-add");
        }else{
          el.removeClass("ion-android-add").addClass("ion-android-remove");
        }
      }

      $(".issue-btn").click(function(){
        alert("adding issue");
      });

      $(".option-btn").click(function(){
        alert("adding option");
      });

      $(".update-btn").click(function(){
        alert("updating caixa");
      });

    });

</script>
<!-- /.content -->
