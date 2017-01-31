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
            <div class="box-header">
              <h3 class="box-title">Listado de Caixas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">

                  <div class="col-sm-6">
                    <div id="list_filter" class="dataTables_filter">
                      <label>Buscar:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                      </label>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length" style="float:right;">

                      <label>Show
                        <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option>
                        </select> entries
                      </label>

                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable fancy-table" role="grid" aria-describedby="example1_info">
                <thead>
                  <tr role="row">
                    <th colspan="9" style="text-align:center;" >Instrumento</th>
                  </tr>
                </thead>
                <thead>
                  <tr role="row">
                    <th>id</th>
                    <th>Titulo de la caixa</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                  </tr>
                </thead>
                <tbody>
                <?php $n = 0; foreach($this->caixas as $caixa): ?>
                  <tr role="row" class="<?php print(($n%2 == 0) ? "even" : "odd"); ?>">
                    <td><?php print($caixa["id"]); ?></td>
                    <td><?php print($caixa["nombre"]); ?></td>
                    <td><?php print($caixa["fecha_ini"]); ?></td>
                    <td><?php print($caixa["fecha_fin"]); ?></td>
                    <td style="text-align:center; cursor:pointer !important;" class="edit-btn" data-id="<?php print($caixa["id"]); ?>">
                      <i class="ion-android-create"></i>
                    </td>
                    <td style="text-align:center; cursor:pointer !important;" class="delete-btn" data-id="<?php print($caixa["id"]); ?>">
                      <i class="ion-android-close"></i>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>

            <tfoot>
                <tr>
                  <th>id</th>
                  <th>Titulo de la caixa</th>
                  <th>Fecha de Inicio</th>
                  <th>Fecha de Fin</th>
                  <th>Editar</th>
                  <th>Borrar</th>
                </tr>
            </tfoot>
          </table>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
            Mostrando 1 a <?php print(count($this->caixas)); ?> de <?php print(count($this->caixas)); ?> Caixas
          </div>
        </div>
        <!--div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
            <ul class="pagination">
              <li class="paginate_button previous disabled" id="example1_previous">
                <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
              </li>
              <li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
              </li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
              <li class="paginate_button next" id="example1_next">
                <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a>
              </li>
            </ul>
          </div>
        </div-->
      </div>
    </div>
            </div>
            <!-- /.box-body -->
          </div>

</section>
<!-- /.content -->

<script>
  $(function(){

    $(".edit-btn").click(function(){
      var id = $(this).data("id");
      $.ajax({
        url: "<?php print(URL); ?>Caixa/editar/"+id,
        method: "GET",
      }).done(function(response){
        $("#asyncLoadArea").html(response);
      });
    });

    $(".delete-btn").click(function(){
      var id = $(this).data("id");
      var r = confirm("De verdad quiere eliminar la Caixa "+id);
      if(r){
        console.log("Eliminando caixa");
      }
    });

  });
</script>
