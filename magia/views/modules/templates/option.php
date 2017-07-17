<!--div class="collapsible col-md-12">

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Nueva Opción</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label>Tipo de Opción</label>
                <select name="tipoOpcion" class="form-control">
                    <option value="OpcionAbierta">Opción Abierta</option>
                    <option value="OpcionMultiple">Opción Múltiple</option>
                    <option value="OpcionPila">Opción Pila (No soportado aún)</option>
                </select>
                <label>Opción</label>
                <input name="opcion_texto" type="text" class="form-control" placeholder="Texto de la opción" value="">
            </div>
        </div>
    </div>

</div-->

<div class="collapsible col-md-12">
    <!-- general form elements -->
    <div class="box box-danger option-container">
        <div class="box-header with-border">
            <h3 class="box-title">Nueva Opción:</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div class="form-group">
                <label>Tipo de Opción</label>
                <select name="tipoOpcion" class="form-control">
                    <option value="OpcionAbierta">Opción Abierta</option>
                    <option value="OpcionMultiple">Opción Múltiple</option>
                    <option value="OpcionPila" >Opción Pila (No soportado aún)</option>
                </select>
                <label>Opción</label>
                <input data-id="" name="opcion-texto" type="text" class="form-control" placeholder="Ej: Te invitamos a compartir tu opinión"
                    value="">
            </div>
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->

</div>