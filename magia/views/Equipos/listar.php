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
              <h3 class="box-title">Listado de Equipos</h3>
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
                    <th colspan="9" style="text-align:center; border-bottom:3px solid #ff3d00; border-right:3px solid #ff3d00;" >Instrumento</th>
                    <th colspan="2" style="text-align:center; border-bottom:3px solid #fc812c; border-left:3px solid #fc812c" >Calibración</th>
                  </tr>
                </thead>
                <thead>
                  <tr role="row">
                    <th>Instrumento</th>
                    <th>Rango</th>
                    <th>Resolución</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Código Equipo Interno</th>
                    <th>serie equipo</th>
                    <th>Ubicación</th>
                    <th>Responsable</th>

                    <th>Frec. (meses)</th>
                    <th>Última</th>
                  </tr>
                </thead>
                <tbody>
                <?php $n = 0; foreach($this->equipos as $equipo): ?>
                  <tr role="row" class="<?php print(($n%2 == 0) ? "even" : "odd"); ?>">
                    <td><?php print($equipo["descripcion"]); ?></td>
                    <td><?php print($equipo["rango_indicacion_min"]." - ".$equipo["rango_indicacion_max"]." ".$equipo["unidad_rango_indicacion"]["value"]); ?></td>
                    <td>¿De dónde sale?</td>
                    <td><?php print($equipo["marca"]["value"]); ?></td>
                    <td><?php print($equipo["modelo"]); ?></td>
                    <td><?php print($equipo["codigo_interno"]); ?></td>
                    <td><?php print($equipo["serial"]); ?></td>
                    <td><?php print($equipo["ubicacion"]["value"]); ?></td>
                    <td><?php print($equipo["responsable"]["value"]); ?></td>
                    <td><?php print($equipo["frecuencia_calib"]); ?></td>
                    <td><?php print($equipo["calibracion"]["value"]); ?></td>
                    <td><div class="iconAnchor" onclick="editThis(this);"><i class="fa ion-edit"></i></div></td>
                    <td><div class="iconAnchor" onclick="editThis(this);"><i class="fa ion-trash-a"></i></div></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>

            <tfoot>
                <tr>
                  <th>Instrumento</th>
                  <th>Rango</th>
                  <th>Resolución</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Código Equipo Interno</th>
                  <th>serie equipo</th>
                  <th>Ubicación</th>
                  <th>Responsable</th>

                  <th>Frec. (meses)</th>
                  <th>Última</th>

                </tr>

            </tfoot>
          </table>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
            Mostrando 1 a <?php print(count($this->equipos)); ?> de <?php print(count($this->equipos)); ?> Equipos
          </div>
        </div>
        <div class="col-sm-7">
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
        </div>
      </div>
    </div>
            </div>
            <!-- /.box-body -->
          </div>

</section>
<!-- /.content -->
