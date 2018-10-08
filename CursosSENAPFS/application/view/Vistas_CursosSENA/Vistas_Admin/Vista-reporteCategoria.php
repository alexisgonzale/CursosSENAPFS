<main class="app-content">
      <div class="app-title">
        <div>
        <h1><i class="fas fa-file-download"></i><b> Reporte fechas por categoría</b></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
      </div>
      <div class="row" style="position:center;margin-left:35%; margin-top: 150px;">
        <div class="col-md-4">
          <div class="tile" style="border-radius:20px;">
          <h3 class="tile-title"> Generar reporte</h3>
            <hr>
            <div class="tile-body">
            <div class="table-responsive">
            <form id="changePassword" action="<?=URL?>home/reporteCategoriaFechas" method="POST">
                <div class="form-group">
                    <label class="control-label"><b>Fecha inicial <label style="color:red">*<label></b></label>
                    <input class="form-control" style="border-radius:20px;" type="date" name="txtfechaInicio"  id="txtfechaInicio" placeholder="" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label"><b>Fecha final <label style="color:red">*<label></b></label>
                    <input class="form-control" style="border-radius:20px;" type="date" name="txtfechaFin"  id="txtfechaFin" placeholder="" value="" required >
                </div>
                <div class="form-group">
                <label class="control-label"><b>Categoría <label style="color:red">*<label></b></label>
                    <select class="form-control" style="border-radius:20px;" name="idCategoria" id="idCategoria" required >
                      <option value="">Seleccione categoría</option>
                      <?php foreach ($traerCat as $key=>$value ): ?>
                      <option value="<?= $value->idCategoria_Cursos?>"><?= $value->nombreCategoria?></option>
                    <?php endforeach?> 
                    </select>
                </div>
            <div class="tile-footer">
              <center><a><button class="btn btn-primary" type="submit" style="border-radius:20px;" formtarget="_blank"> <i class="fa fa-fw fa-lg fa-check-circle"></i> Generar</button></a></center>
            </div>
            </form>
            </div>
            </div>
         </div>
        </div>
</main>
