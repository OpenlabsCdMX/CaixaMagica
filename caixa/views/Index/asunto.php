<?php include MODULE."header.php"; ?>
<body>

    <?php include MODULE."navbar.php" ?>

    <div id="app">

      <?php include MODULE."hamburguer_menu.php" ?>

      <!-- App content -->
      <div id="sombra"></div>
      <div id="loader"></div>
      <div id="content" class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div>
           <?php $n = sizeof($this->asuntos);?>
           <?php foreach($this->asuntos as $key => $asunto): ?>
          <div class="panel panel-default" style="margin-top: 15px;">
            <div class="panel-heading asunto">
                <div><?php print_r($asunto->getTexto()); ?></div>
                <div><?php print($key + 1);?>/<?php print($n);?></div>
            </div>
            <div class="panel-body" style="padding-left: 0px !important;padding-right: 0px !important;">

              <!--carousel -->
              <div class="magicarousel">
                <ul>
                  <?php foreach($asunto->opciones as $opcion ) : ?>
                    <li data-id="<?php print($opcion->getId()); ?>"
                        data-tipo="<?php print(get_class($opcion)); ?>"
                        data-asunto="<?php print($asunto->getId()); ?>">
                        <?php print($opcion->getTexto()); ?>
                        <div class="option-icon">
                            <span class="glyphicon glyphicon-ok"></span>
                        </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <!--/carousel -->

            </div>
          </div>
            <?php endforeach; ?>
            <div class="btn-envio" onclick="enviarDatos()">Enviar Opinión</div>

        </div>

      </div> <!-- /container -->
    </div>
    <!-- magicarousel -->
    <script src="<?php print(URL); ?>public/frameworks/modernizr/modernizr.js"></script>
    <script src="<?php print(URL); ?>public/js/magicarousel.js"></script>
    <script type="text/javascript">
      function enviarDatos(){
        var data = {};
        data.opciones = new Array();
        $.each($(".asunto"),function(){
          var padre = $(this).parent();
          var opcionesMarcadas = padre.find(".magicarousel li.selected");
          //console.log(opcionesMarcadas);
          $.each(opcionesMarcadas,function(i){
            var comments = null;
            if(opcionesMarcadas.data("tipo") == "OpcionAbierta"){
              comments = padre.children(".commentBox")[0].value;
            }
              var key = opcionesMarcadas.data("tipo")+"_id";
              var value = opcionesMarcadas.data("id");
              data.opciones.push({key:key,value:value,comments:comments});
          });
        });
        $.ajax({
          url: "<?php print(URL); ?>Index/participar/",
          method: "POST",
          data: data,
          beforeSend: function(){
            $("#loader").css("display","block");
          }
        }).done(function(r){
            console.log(r);
          $("#loader").css("display","none");
          document.location.href = "<?php print(URL); ?>Index/gracias/?id="+$(".magicarousel li").data("id")+"&tipo="+$(".magicarousel li").data("tipo");
        });
      }
    </script>
  </body>
</hmtl>
