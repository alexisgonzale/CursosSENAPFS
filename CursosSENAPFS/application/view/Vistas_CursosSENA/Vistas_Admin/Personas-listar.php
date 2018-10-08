<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list" aria-hidden="true"></i> Formulario Usuarios</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= URL ?>Interesados/indexRegistrar">Registrar Usuarios</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <center><h1 class="tile-title"><b>Listar usuarios</b></h1></center>

            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Tipo de Documento</th>
                    <th>N° documento</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Cursos</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $key => $value) : ?>
                  <tr>
                    <td><?= $value->tipoDocumento ?></td>
                    <td><?= $value->documentoPersona ?></td>
                    <td><?= $value->nombrePersona ?> <?= $value->apellidoPersona ?></td>
                    <td><?= $value->telefonoPersona ?></td>
                    <td><?= $value->direccionPersona ?></td>
                    <td><?= $value->correoPersona ?></td>
                    <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cursosPersona" onclick="getCursos(<?= $value->cod_personas ?>)" style="border-radius:20px"><i class="fas fa-plus-circle"></i></button>
                    </td>
                    <td><?= $value->rol ?></td>
                    <?php if ($value->estado_persona == "Activo") { ?>
                      <td><span class="badge badge-info" style="border-radius:20px"><?= $value->estado_persona ?></span></td>
                      <?php 
                    }else if ($value->estado_persona == "Inactivo") { ?>
                      <td><span class="badge badge-dark" style="border-radius:20px"><?= $value->estado_persona ?></span></td>
                      <?php 
                    } else if ($value->estado_persona == "Sancionado") { ?> 
                    <td><span class="badge badge-danger" style="border-radius:20px"><?= $value->estado_persona ?></span></td>
                      <?php 
                    }
                    ?>
                      <td style="text-align: center;">
                       <?php if ($value->estado_persona == "Activo") { ?>
                          <?php if ($value->estado_persona == 'Activo') { ?>
                            <a title="Cambiar Estado" href="<?= URL ?>Personas/cambiarEstadoPersonas/<?= $value->cod_personas ?>/<?= $estado = "Inactivo" ?>"><button class="btn-xs btn-secudary" type="button" style="border-radius:20px"><i class="fas fa-exchange-alt"></i></button></a>
                          <?php 
                        } else if ($value->estado_persona == 'Inactivo') { ?>
                          <a title="Cambiar Estado" href="<?= URL ?>Personas/cambiarEstadoPersonas/<?= $value->cod_personas ?>/<?= $estado = "Activo" ?>"><button class="btn-xs btn-secudary" type="button" style="border-radius:20px"><i class="fas fa-exchange-alt"></i></button></a>
                        <?php 
                      } ?>
                        <a href="#"><button class="btn-xs btn-info" type="button" data-toggle="modal" data-target="#exampleModal" title="Modificar" onclick=" cargarEditar(<?= $value->cod_personas ?>)" style="border-radius:20px"><i class="fas fa-edit"></i></button></a>
                          <button class="btn-xs btn-danger" type="button"   onclick="sancionar(<?= $value->cod_personas ?>)"  title="Sancionar" style="border-radius:20px"><i class="fas fa-user-times"></i></button>
                      <?php 
                    }else if ($value->estado_persona == "Inactivo") { ?>
                        <?php if ($value->estado_persona == 'Activo') { ?>
                          <a title="Cambiar Estado" href="<?= URL ?>Personas/cambiarEstadoPersonas/<?= $value->cod_personas ?>/<?= $estado = "Inactivo" ?>"><button class="btn-xs btn-secudary" type="button" style="border-radius:20px"><i class="fas fa-exchange-alt"></i></button></a>
                          <?php 
                        } else if ($value->estado_persona == 'Inactivo') { ?>
                          <a title="Cambiar Estado" href="<?= URL ?>Personas/cambiarEstadoPersonas/<?= $value->cod_personas ?>/<?= $estado = "Activo" ?>"><button class="btn-xs btn-secudary" type="button" style="border-radius:20px"><i class="fas fa-exchange-alt"></i></button></a>
                        <?php 
                      } ?>
                          <a  href="#"><button class="btn-xs btn-info" type="button" data-toggle="modal" data-target="#exampleModal" title="Modificar" onclick=" cargarEditar(<?= $value->cod_personas ?>)" style="border-radius:20px"><i class="fas fa-edit"></i></button></a>
                          <button class="btn-xs btn-danger" type="button" onclick="sancionar(<?= $value->cod_personas ?>)"  title="Sancionar" style="border-radius:20px"><i class="fas fa-user-times"></i></button></a>                          
                      <?php 
                    } else if ($value->estado_persona == "Sancionado") { ?> 
                            <button class="btn-xs btn-info" type="button" data-toggle="modal" data-target="#exampleModal" title="Modificar" onclick=" cargarEditar(<?= $value->cod_personas ?>)" style="border-radius:20px"><i class="fas fa-edit"></i></button>
                     <?php 
                    }
                    ?>
                      </td>
                  </tr>
                      <?php endforeach ?>
                 </tbody>
              </table></div>
            </div>
          </div>
        </div>
        </div>


        <!-- Sanciones -->  
        <div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exModal">Sancionar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form  id="sanciones" action="<?= URL ?>Personas/sancionarPersona" method="POST">
                  <div class="row">
                  <input type="hidden" name="codPersona" id="codPersona">
                      <div class="form-group col-md-12">
                        <label class="control-label"><b>Meses <label style="color:red">*<label></b></label>
                        <input class="form-control" type="number" max="2" min= "1" name="txtmeses" id="txtmeses" value="" placeholder="Meses de Sanción" style="border-radius:20px" required>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cancelar</button>
                <button type="submit" class="btn btn-info" style="border-radius:20px">Sancionar</button>
              </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->  
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form  id="modificarpu" action="<?= URL ?>Personas/modificarPersonas" method="POST">
                  <div class="row">
                        <input class="form-label" type="hidden" id="txtcod_personas" name="txtcod_personas" value="" placeholder="Código Persona">
                      <div class="form-group col-md-6">
                       <label class="control-label"><b>Nombres <label style="color:red">*<label></b></label>
                       <input class="form-control" type="text" name="txtnombrePersona" id="txtnombrePersona" value="" placeholder="Nombres" style="border-radius:20px" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label class="control-label"><b>Apellidos <label style="color:red">*<label></b></label>
                       <input class="form-control" type="text" name="txtapellidoPersona" id="txtapellidoPersona" value="" placeholder="Apellidos" style="border-radius:20px" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label"><b>Teléfono <label style="color:red">*<label></b></label>
                        <input class="form-control" type="number"  name="txttelefonoPersona" id="txttelefonoPersona" value="" placeholder="Teléfono" style="border-radius:20px" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label class="control-label"><b>Dirección <label style="color:red">*<label></b></label>
                        <input class="form-control" type="text" name="txtdireccionPersona" id="txtdireccionPersona" value="" placeholder="Dirección" style="border-radius:20px" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label"><b>Correo <label style="color:red">*<label></b></label>
                        <input class="form-control" type="email" name="txtcorreoPersona" id="txtcorreoPersona" value="" placeholder="Correo" style="border-radius:20px">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="control-label"><b>Lugar Trabajo <label style="color:red">*<label></b></label>
                        <input class="form-control" type="text" name="txtLugarProfesion" id="txtLugarProfesion" value="" placeholder="Lugar Trabajo" style="border-radius:20px" required>
                      </div>
                      <div class="form-group col-md-12">
                        <label class="control-label"><b>Profesión <label style="color:red">*<label></b></label>
                        <select class="form-control" name="allProfessions" id="allProfessions" style="border-radius:20px" required>
                          <option value="">Seleccione una profesión</option>
                          <?php foreach ($prof as $value): ?>
                          <option value="<?php echo $value->idProfesion ?>"><?php echo $value->nombreProfesion ?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cancelar</button>
                <button type="submit" class="btn btn-info" style="border-radius:20px">Actualizar</button>
                          </form>
              </div>
            </div>
          </div>
        </div>

  <div class="modal fade animated zoomInUp" id="cursosPersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Cursos inscritos</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5><b>Cursos</b></h5>
        <ul>
        
          <il id="cursosxpersona"></il>
        </ul>
      </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
</div>
</div>
</div>
     </main>

    
     <script>
     
        function cargarEditar(id)
        {
          console.log(id);
            $.ajax({
              url: '<?= URL; ?>Personas/cargarEditar/'+id,
              type: 'POST',
              dataType: 'JSON'
            }).done((data)=>{
              console.log(data);
              $('#txtnombrePersona').val(data.nombrePersona);
              $('#txtapellidoPersona').val(data.apellidoPersona);
              $('#txttelefonoPersona').val(data.telefonoPersona);
              $('#txtdireccionPersona').val(data.direccionPersona);
              $('#txtcorreoPersona').val(data.correoPersona);
              $('#txtLugarProfesion').val(data.LugarProfesion);
              $('#txtcod_personas').val(data.cod_personas);
              $('#allProfessions').val(data.profesionPersona);
            $("#exampleModal").modal();
            }).fail(()=>{
              console.log('Error');
            })
        }
    </script>

    <script>
    function getCursos(id)
    {
      $.ajax({
        url: '<?php echo URL ?>personas/cargarCursos',
        type: 'POST',
        dataType: 'JSON',
        data:
        {
          "id":id
        }
      }).done((data)=>{
        $("#cursosxpersona").empty();
        if(data<=0)
        {
          $("#cursosxpersona").append("<tr><td>Esta persona no está inscrita en ningún curso.</td></tr>");
        }
        $.each(data, function(index, value){
        $("#cursosxpersona").append("<tr><td><i class='fas fa-angle-double-right'></i> "+ value['nombreCurso'] +" <button  class='btn btn-outline-danger' style='border-color:#ffffff00; padding:0px' onclick='deleteCurso("+ value['idCursos'] +","+ value['Personas_codPersona']+")'><i class='fas fa-times' style='color:red'></i></button></td></tr>");
        })
        $("#cursosPersona").modal()
      })
    }
   </script>


        <script>
      function sancionar(id) {
        console.log(id);

        $('#codPersona').val(id);
        $('#txtmeses').val();
        $('#exModal').modal();

      }

      </script>
      <script>
      function deleteCurso(id,Personas)
      {
        console.log();
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
            url: '<?php echo URL; ?>Personas/eliminarCurso',
            type: 'POST',
            dataType: 'JSON',
            data:
              {
                "id":id,
                "Personas":Personas
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