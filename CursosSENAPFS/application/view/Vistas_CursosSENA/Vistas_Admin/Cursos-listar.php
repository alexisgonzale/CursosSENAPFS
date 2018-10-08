<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-graduation-cap"></i> Cursos</h1>
      <!-- <p>Table to display analytical data effectively</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item active"><a href="<?php echo URL ?>cursos/create">Registrar Cursos</a>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <center>
            <h1>Lista de cursos</h1>
          </center><br>
          <div class="table-responsive">
          <table class="table table-hover table-bordered" id="myTable">
            <thead>
              <tr>
                <th>Curso</th>
                <th>Horas</th>
                <th>Encargado</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Ofertados</th>
                <th>Disponibles</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php foreach($courses as $value): ?>
              <tr>
                <td><?= $value->nombreCurso ?></td>
                <td><?= $value->cantidadHoras ?> horas</td>
                <td><?= $value->encargadoCurso ?></td>
                <td><?= $value->fechaInicio ?></td>
                <td><?= $value->fechaFin ?></td>
                <td><?= $value->cupos1 ?></td>
                <td><?= $value->cupos ?></td>
                <td><?= $value->nombreCategoria ?></td>
                <td><?= $value->estadoCurso ?></td>
                <td style="text-align: center;">
                       <?php if ($value->estadoCurso == "Activo") { ?>      
                    <button class="btn btn-primary" style="border-radius:20px" type="button" data-toggle="modal" data-target="#editarCursos" title="Modificar" href="" onclick=" editCourse(<?= $value->idCursos?>)"><i
                    class="fas fa-edit"></i></button>        
                    <a  href="<?=URL?>Cursos/informePersonaXcurso/<?=$value->idCursos?>" target="_blank"><button class="btn btn-outline-danger" style="border-radius:20px" type="button" title="Generar PDF" href=""><i class="fas fa-file-pdf"></i></button></a> 
                       <?php 
                        } else if ($value->estadoCurso != 'Activo') 
                        { ?>
                         <a  href="<?=URL?>Cursos/informePersonaXcurso/<?=$value->idCursos?>" target="_blank"><button class="btn btn-outline-danger" style="border-radius:20px" type="button" title="Generar PDF" href=""><i class="fas fa-file-pdf"></i></button></a>                         
                        <?php 
                      } ?>
              </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="editarCursos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar cursos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="signupFormes" action="<?= URL?>Cursos/updateCourse" method="POST">
            <input readOnly class="form-control" name="txtCodigoCurso" type="hidden" id="txtCodigoCurso" placeholder="Código del curso"
              value="" style="border-radius:20px" required>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label"><b>Nombre <label style="color:red">*<label></b></label>
                <input class="form-control" name="txtNameCourse" id="txtNameCourse" type="text" placeholder="Nombre del curso"
                  value="" style="border-radius:20px" required>
              </div>
              <div class="form-group col-md-6">
                <label class="control-label"><b>Duración del curso <label style="color:red">*<label></b></label>
                <input class="form-control" name="txtQHours" type="number" min="1" id="txtQHours" placeholder="Cantidad de horas del curso"
                  value="" style="border-radius:20px" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label"><b>Encargado del curso <label style="color:red">*<label></b></label>
                <input class="form-control" name="txtAttendant" type="text" id="txtAttendant" placeholder="Nombre del encargado"
                  value="" style="border-radius:20px" required>
              </div>
              <div class="form-group col-md-6">
                <label class="control-label"><b>Cupos <label style="color:red">*<label></b></label>
                <input class="form-control" name="txtCupos" type="number" min="1" id="txtCupos" placeholder="Cupos del curso"
                  value="" style="border-radius:20px" required>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-12">
                <label class="control-label"><b>Categoría <label style="color:red">*<label></b></label>
                <select class="form-control" id="allCategories" name="allCategories" style="border-radius:20px" required>
                  <option value="0">Seleccione una categoría</option>
                  <?php foreach($categories as $value): ?>
                  <option value="<?php echo $value->idCategoria_Cursos ?>">
                    <?php echo $value->nombreCategoria ?>
                  </option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label"><b>Fecha de inicio <label style="color:red">*<label></b></label>
                <input class="form-control" name="txtDateStart" type="date" id="txtDateStart" placeholder="" value=""
                  style="border-radius:20px" required>
              </div>
              <div class="form-group col-md-6">
                <label class="control-label"><b>Fecha fin <label style="color:red">*<label></b></label>
                <input class="form-control" name="txtEndingDate" type="date" id="txtEndingDate" placeholder="" value=""
                  style="border-radius:20px" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
          <button type="submit" class="btn btn-primary" style="border-radius:20px">Actualizar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  function editCourse(id) {
    $.ajax({
      url: '<?php echo URL;?>cursos/editCourse',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "id": id
      }
    }).done((data) => {
      console.log(data);
      $('#txtNameCourse').val(data.nombreCurso);
      $('#txtQHours').val(data.cantidadHoras);
      $('#txtAttendant').val(data.encargadoCurso);
      $('#txtCupos').val(data.cupos);
      $('#allCategories').val(data.categoria_id);
      if (data.estadoCurso == 1) {
        $('#txtEstado').val("Activo");
      } else {
        $('#txtEstado').val("Inactivo");
      }
      $('#txtDateStart').val(data.fechaInicio);
      $('#txtEndingDate').val(data.fechaFin);
      $('#txtCodigoCurso').val(data.idCursos);

      $("#editarCursos").modal();
    }).fail(() => {
      console.log('Error');
    })
  }
</script>
