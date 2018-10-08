<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-graduation-cap"></i> Cursos</h1>
        </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index">Inicio</a></li>
          </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            <center><h1>Mis cursos</h1></center><br>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>Curso</th>
                    <th>Encargado Curso</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach($resultados as $value): ?>
                    <tr>
                        <td><?= $value->nombreCurso ?></td>
                        <td><?= $value->encargadoCurso ?></td>
                        <td><?= $value->fechaInicio ?></td>                        
                        <td><?= $value->fechaFin ?></td>   
                        <td><?= $value->estadoCurso ?></td> 
                        <?php if($value->estadoCurso=="Activo") :?>    
                       <td><a><button class="btn btn-secudary" id="dlt" onclick="deleteCurso(<?php echo $value->idCursos?>)" type="button" title="Eliminar" style="border-radius:20px"><i class="fas fa-trash-alt"></i></button></td>
                          <?php endif; ?>
                        <?php if($value->estadoCurso=="Finalizado") :?>
                          <td><a href="http://certificados.sena.edu.co/" target="_blank"><b>Certificados</b><a></td>
                        <?php endif;?>
                        <?php if($value->estadoCurso=="Cursando") :?>
                          <td><span class="badge badge-danger" style="border-radius:20px">Este curso ya se encuentra en ejecución.</span></td>
                        <?php endif;?>
                        <?php if($value->estadoCurso=="Sin cupos") :?>
                          <td><span class="badge badge-danger" style="border-radius:20px">Este curso ya no tiene cupos disponibles.</span></td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>

<script>
      function deleteCurso(id)
      {
      	swal({
      		title: "¡ADVERTENCIA!",
      		text: "¿Seguro desea eliminar la preinscripión?",
      		type: "warning",
          timer: 6000,
      		showCancelButton: true,
      		confirmButtonText: "Sí",
      		cancelButtonText: "No",
      		closeOnConfirm: false,
      		closeOnCancel: false
      	}, function(isConfirm) {
      	  if (isConfirm) {
          $.ajax({
            url: '<?php echo URL; ?>CursosPersona/eliminarCurso',
            type: 'POST',
            dataType: 'JSON',
            data:
              {
                "id":id
              }
            }).done(function(data){
              if(data.status==="statusFinish"){
                swal('Este curso ya ha finalizado. No puede eliminarlo de la lista de MIS CURSOS','',"warning")
              }else if(data.status==="statusInCourse"){
                swal('¡Actualmente se encuentra en formación; mientras se está en formación no es posible eliminarlo de MIS CURSOS!','',"warning")
              }
              else{
      			swal("¡Eliminado!", "Se ha eliminado correctamente la preinscripión", "success");
            setTimeout(function () { location.reload(1); }, 1000);
              }
            })
          }else {
      			swal("¡Cancelado!", "El registro no ha sido eliminado.", "error");
      		}
      	});
      }
    </script>