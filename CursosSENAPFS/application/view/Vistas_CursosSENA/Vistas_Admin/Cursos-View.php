<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-home"></i> Cursos </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo URL; ?>cursos/index">Consultar Cursos</a>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><b>Registrar Cursos</b></h3><hr>
            <div class="tile-body">
              <form id="signupFormes" action="<?php echo URL?>cursos/addCourses" method="POST">
              <div class="row">
                <div class="form-group col-md-3">
                  <label class="control-label"><b>Nombre <label style="color:red">*<label></b></label>
                  <input class="form-control" name="txtNameCourse" id="txtNameCourse" type="text" placeholder="Nombre del curso" style="border-radius:20px" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label"><b>Duración del curso <label style="color:red">*<label></b></label>
                  <input class="form-control" name="txtQHours" min="1" id="txtQHours" type="number" placeholder="Cantidad de horas del curso" style="border-radius:20px" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label"><b>Encargado del curso <label style="color:red">*<label></b></label>
                  <input class="form-control" name="txtAttendant" id="txtAttendant" type="text" placeholder="Nombre del encargado" style="border-radius:20px" required>
                </div>
                <div class="form-group col-md-3">
                        <label class="control-label"><b>Cupos <label style="color:red">*<label></b></label>
                        <input class="form-control" name="txtCupos" min="1" id="txtCupos" type="number" placeholder="Cupos del curso" style="border-radius:20px" required>
                </div>
                </div>
                  <div class="row">
                      <div class="form-group col-md-6">
                      <label class="control-label"><b>Categoría <label style="color:red">*<label></b></label>
                      <div class="input-group">
                        <select class="form-control" name="allCategories" id="allCategories" style="border-radius:20px" required>
                              <option value="">Seleccione una categoría</option>
                              <?php foreach($categories as $value): ?>
                                  <option value="<?php echo $value->idCategoria_Cursos?>"><?php echo $value->nombreCategoria ?></option>
                              <?php endforeach;?>
                      </select>
                      </div>
                    <br>
                 </div>
                <div class="form-group col-md-3">
                        <label class="control-label"><b>Fecha de inicio <label style="color:red">*<label></b></label>
                        <input class="form-control" name="txtDateStart" id="txtDateStart" type="date" placeholder="" style="border-radius:20px" required>
                </div>
                <div class="form-group col-md-3">
                        <label class="control-label"><b>Fecha final <label style="color:red">*<label></b></label>
                        <input class="form-control" name="txtEndingDate" id="txtEndingDate" type="date" placeholder="" style="border-radius:20px" required>
                </div>
                <div class="col-md-12">
                <br><hr><br>
                <center>
                  <button type="submit" style="margin-top: -6px; border-radius:20px;" class="btn btn-info"><i class="fas fa-check-circle"></i> Registrar</button>
                </center>  
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </main>
  
