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
                        <input name="caixa-id" type="hidden" class="form-control" value="<?php print($this->caixa->getId()); ?>">
                            <label>Titulo de la Caixa</label>
                            <input name="caixa-nombre" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión" value="<?php print($this->caixa->getNombre()); ?>">
                        </div>
                        <p class="help-block">Si la caixa va a ser permanente deje sin diligenciar las fechas de inicio y fin.</p>
                        <div class="form-group">
                            <label>Fecha inicial</label>
                            <input name="caixa-fecha_ini" type="date" class="form-control" placeholder="2017-01-24" value="<?php print($this->caixa->getFecha_ini()); ?>">
                        </div>
                        <div class="form-group">
                            <label>Fecha final</label>
                            <input name="caixa-fecha_fin" type="date" class="form-control" placeholder="2017-01-30" value="<?php print($this->caixa->getFecha_fin()); ?>">
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success issues-container">
                    <div class="box-header with-border">
                        <h3 class="box-title">Asuntos de la Caixa <?php print($this->caixa->getId()); ?></h3>
                        <i class="toggle-box-btn pull-right ion-android-remove" style="cursor:pointer;"></i>
                    </div>
                    <div class="collapsible">
                    <?php foreach ($this->asuntos as $asunto): ?>
                        </br>
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-warning topic-container anIssue">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Asunto <?php print($asunto->getId()); ?>: <?php print($asunto->getTexto());  ?></h3>
                                    <i class="toggle-box-btn pull-right ion-android-remove" style="cursor:pointer;"></i>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <!-- Asunto collpasible area -->
                                <div class="collapsible">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Contenido del asunto:</label>
                                        <input data-id="<?php print($asunto->getId()); ?>" data-caixaid="<?php print($this->caixa->getId()); ?>" name="asunto-texto" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión" value="<?php print($asunto->getTexto()); ?>">
                                    </div>
                                </div>
                                <p style="margin-left:10px;">
                                    Opciones del asunto:
                                </p>
                                <!-- /.box-body -->
                                <div class="daOptions">
                                <?php foreach ($asunto->opciones as $n => $opcion): ?>


                                    <div class="collapsible col-md-12">
                                        <!-- general form elements -->
                                        <div class="box box-danger option-container">
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
                                                    <input data-id="<?php print($opcion->getId()); ?>"
                                                    data-asuntoid="<?php print($asunto->getId()); ?>" name="opcion-texto" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión" value="<?php print($opcion->getTexto()); ?>">
                                                </div>
                                            </div>
                                            <!-- /.box-body -->

                                        </div>
                                        <!-- /.box -->

                                    </div>

                        <?php endforeach; ?>
                        <div class="box-footer">
                                <button class="option-btn btn-block btn-flat btn-danger" style="font-weight:bold;">
                                  <i class="ion-android-add-circle"></i>&nbsp;
                                  Agregar opción al Asunto</button>
                            </div>
                        </div>
                                </form>
                                
                            </div>

                            

                        </div>
                      </div>

<?php endforeach; ?>
</div>
<!--/ Collapsible area of asuntos -->

                    <div class="box-footer">
                        <button class="issue-btn btn-block btn-flat btn-warning" style="font-weight:bold;">
                          <i class="ion-android-add-circle"></i>&nbsp;
                          Agregar asunto a la Caixa</button>
                    </div>
                </div>
                <!-- /.box -->

            </div>

            <div class="box-footer">
                <button class="update-btn btn-block btn-flat btn-primary" style="font-weight:bold;">
                  <i class="ion-android-refresh"></i>&nbsp;
                  Actualizar Caixa</button>
            </div>

        </div>

        <!-- /.box-body -->
    </div>

</section>
<script>

    $(function(){

      //Buttons listeners

      $.each($(".toggle-box-btn"),function(){
        toggleSlideBox($(this));
      });

      $(".toggle-box-btn").click(function(){
        toggleSlideBox($(this));
      });

      $(".issue-btn").click(function(e){
        e.preventDefault();
        addIssue($(this));
      });

      $(".option-btn").click(function(e){
        e.preventDefault();
        addOption($(this));
      });

      $(".update-btn").click(function(){
        alert("updating caixa");

        caixa = {
            id: $("input[name='caixa-id']").val(),
            nombre: $("input[name='caixa-nombre']").val(),
            fecha_ini: ($("input[name='caixa-fecha_ini']").val() != "") ? $("input[name='caixa-fecha_ini']").val() : "0000-00-00",
            fecha_fin: ($("input[name='caixa-fecha_fin']").val() != "") ? $("input[name='caixa-fecha_fin']").val() : "0000-00-00",
            asuntos:[]
        };

        $.each($(".anIssue"),function(){
            asunto = $(this).find("input[name='asunto-texto']");

            asuntoObj = {
                id: asunto.data("id"),
                texto: asunto.val(),
                opciones: []
            };
            
            opciones = $(this).find(".daOptions");
            
            $.each(opciones.find(".collapsible"), function(){
                opcion = {
                    id: $(this).find("input[name='opcion-texto']").data("id"),
                    tipo: $(this).find("select[name='tipoOpcion']").val(),
                    texto: $(this).find("input[name='opcion-texto']").val()
                };

                asuntoObj.opciones.push(opcion);

            });

            caixa.asuntos.push(asuntoObj);
        });

        $.ajax({
            method: "POST",
            url: "<?php echo URL; ?>Caixa/edit/",
            data: {caixa:caixa}
        }).done(function(r){
            console.log(r);
            var response = JSON.parse(r);
            if(response.error == 0){
                <?php $this->reloadThis("Caixa/listar/"); ?>
            }else{
                alert("Error: "+response.msg);
            }
        });

      });

      // Slide Boxes Logic

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

      // Add Issues Button Action Logic
      function addIssue(el){

        var area = el.parent().parent();
        $.ajax({
          url: "<?php echo MODULE.'templates/issue.php'; ?>",
          method:"GET"
        }).done(function(r){
            area.append(r);

            $(".toggle-box-btn").unbind("click").click(function(){
              toggleSlideBox($(this));
            });

            $(".option-btn").unbind("click").on("click",function(e){
              e.preventDefault();
              addOption($(this));
            });
        });

      }

      // Add Options Button Action Logic

      function addOption(el){

        var area = el.parent().parent();
        console.debug(area);
        $.ajax({
          url: "<?php echo MODULE.'templates/option.php'; ?>",
          method:"GET"
        }).done(function(r){
            area.append(r);
            $(".toggle-box-btn").unbind("click").click(function(){
              toggleSlideBox($(this));
            });
        });

      }

    });

</script>
<!-- /.content -->
