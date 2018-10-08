
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="app-menu__icon fas fa-cog"></i>  Configuración</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= URL?>Personas">Nuevo Administrador</a></li>
        </ul>
      </div>
      <div class="row">

      <div class="col-md-12">
          <div class="tile">
          <center><h1 class="tile-title"><b>Listar Administradores</b><a href="<?= URL?>Personas"><button type="button" title="Añadir administrador" class="btn btn-primary float-right" style="border-radius:50%;"><i class="fas fa-plus"></i></button></h1></center></a>
            <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Tipo ID.</th>
                    <th>N°. Documento</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados1 as $key => $value): ?>
                  <tr>
                    <td><?=$value->tipoDocumento?></td>
                    <td><?=$value->documentoPersona?></td>
                    <td><?=$value->nombrePersona?> <?=$value->apellidoPersona?></td>
                    <td><?=$value->telefonoPersona?></td>
                    <td><?=$value->direccionPersona?></td>
                    <td><?=$value->correoPersona?></td>
                    <td><?=$value->rol?></td>
                    <?php if($value->estado_persona=="Activo"){?>
                      <td><span class="badge badge-info" style="border-radius:20px"><?=$value->estado_persona?></span></td>
											<?php }else if($value->estado_persona=="Inactivo"){?>
                      <td><span class="badge badge-dark" style="border-radius:20px"><?=$value->estado_persona?></span></td>
                      <?php }?>
                      <td>
                        <?php if($value->estado_persona=='Activo'){?>
                          <a title="Cambiar Estado" href="<?=URL?>Personas/cambiarEstadoAdmin/<?=$value->cod_personas?>/<?=$estado="Inactivo"?>"><button class="btn btn-secudary" type="button" style="border-radius:20px"><i class="fas fa-exchange-alt"></i></button></a>
                          <?php }else if($value->estado_persona=='Inactivo'){ ?>
                          <a title="Cambiar Estado" href="<?=URL?>Personas/cambiarEstadoAdmin/<?=$value->cod_personas?>/<?=$estado="Activo" ?>"><button class="btn btn-secudary" type="button" style="border-radius:20px"><i class="fas fa-exchange-alt"></i></button></a>
                        <?php } ?>
                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#exampleModal1" title="Modificar" onclick=" cargarEditar(<?= $value->cod_personas?>)" style="border-radius:20px"><i class="fas fa-edit"></i></button>
                        <button type="button" style="border-radius:20px" title="Ver cursos" class="btn btn-secondary" onclick="cursosxadmin(<?= $value->cod_personas?>)"><i class="fas fa-plus"></i></button>
                      </td>
                  </tr>
                      <?php endforeach ?>
                 </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
          <center>  <h3 class="tile-title">Roles</h3></center><hr>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Rol</th>
                 <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
              <!-- Listar Roles -->
               <?php 
               foreach($listar as $key => $value): ?>
                <tr>
                <td><?=$value->nombreRol?></td>
                <td>
                <center>
                  <button class="btn btn-info" title="Modificar rol"onclick="consultar(<?=$value->id?>)" data-target="#exampleModal" style="border-radius:20px">  <i class="fas fa-edit"></i></button>
                </center>
                </td>
                </tr>              
               <?php endforeach ?>
              </tbody>
            </table>
            </div>
            </div>            
          </div>       
        <!-- Acá empieza la vista tipo de documentos -->
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">          
           <center>
            <h3 class="tile-title">Tipo de documentos</h3><hr>
            </center>
            <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>                  
                  <th>Tipo documento</th>      
                  <th>Opciones</th>          
                </tr>
              </thead>
              <tbody>
              <?php
              foreach($listarTD as $key => $value):?>
              <tr>
              <td><?=$value->nombreTipoDocumento?></td>
              <td>
              <center>
                <button onclick="consultarTD(<?=$value->idtipoDocumento?>)" class="btn btn-info" data-target="#modalTD" style="border-radius:20px"> <i class="fas fa-edit"></i></button>
              </center>
              </td>            
             <?php endforeach ?>
              </tr>
              </tbody>
            </table>
            </div>        
            </div>
          </div>
        </div>

<!--Modals Roles-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= URL ?>Configuraciones/modificarPersona" method="POST">
          <div class="form-group">
            <input type="hidden" name="idrol" class="form-control" id="recipient_name" style="border-radius:20px"required>
          </div>
          <div class="form-group">
            <label class="col-form-label"><b>Rol <label style="color:red">*<label></b></label>
            <input class="form-control" id="message_text" maxlength="45" name="txtrol" style="border-radius:20px" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
        <button type="submit" class="btn btn-info" style="border-radius:20px">Editar</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!--Modals tipo documento-->


<div class="modal fade" id="modalTD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Tipo documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= URL?>Configuraciones/modificar" method="POST">
          <div class="form-group">
            <input type="hidden"  id="principalTD" class="form-control" name="idtipod" style="border-radius:20px" required>
          </div>
          <div class="form-group">
            <label class="col-form-label"><b>Tipo documento <label style="color:red">*<label></b></label>
            <input class="form-control" id="nombreTipoDocumento" maxlength="45" name="descripciontd" style="border-radius:20px" required>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
        <button type="submit" class="btn btn-info" style="border-radius:20px">Editar</button>
        </form>
      </div>
    </div>
  </div>
</div>

 <!-- Modal Admin-->
 <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form  id="modificarp" action="<?=URL?>Personas/modificarAdmin" method="POST">
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
                      <input class="form-control" type="number" min="7"name="txttelefonoPersona" id="txttelefonoPersona" value="" placeholder="Teléfono" style="border-radius:20px" required>
                      </div>
                      <div class="form-group col-md-6">
                      <label class="control-label"><b>Dirección <label style="color:red">*<label></b></label>
                      <input class="form-control" type="text" name="txtdireccionPersona" id="txtdireccionPersona" value="" placeholder="Dirección" style="border-radius:20px" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-12">
                      <label class="control-label"><b>Correo <label style="color:red">*<label></b></label>
                      <input class="form-control" type="email" name="txtcorreoPersona" id="txtcorreoPersona" value="" placeholder="Correo" style="border-radius:20px" required>
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

  <div class="modal fade animated zoomInUp" id="cursosxadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        
          <il id="cursos_admin"></il>
        </ul>
      </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
</div>
</div>
</div>
     </main>   

     <script>
      function cursosxadmin(id)
      {
        $.ajax({
          url: '<?=URL?>configuraciones/cursosXadmin',
          type: 'POST',
          dataType: 'JSON',
          data:
          {
            "id":id
          }
        }).done((data)=>{
          $("#cursos_admin").empty();
          if(data<=0)
          {
            $("#cursos_admin").append("<tr><td>Esta persona no está inscrita en ningún curso.</td></tr>");
          }
          $.each(data, function(index, value){
            $("#cursos_admin").append("<tr><td><i class='fas fa-angle-double-right'></i> "+ value['nombreCurso'] +" <button  class='btn btn-outline-danger' style='border-color:#ffffff00; padding:0px' onclick='deleteCurso("+ value['idCursos'] +","+ value['Personas_codPersona']+")'><i class='fas fa-times' style='color:red'></i></button></td></tr>");
          })
        })
        $('#cursosxadmin').modal();
      } 
    </script>

     <script>
        function cargarEditar(id)
        {
          console.log(id);
            $.ajax({
              url: '<?= URL;?>Personas/cargarEditar/'+id,
              type: 'POST',
              dataType: 'JSON'
              // data: { data para enviar los parametros al controlador  
              //   'id' : id
              // }
            }).done((data)=>{// el d  n hone es cuando el ajax se ejecuta correctamente y dentro de el utiiza el resultado 
              // $.each(i, data){  for each para recorrer todos los elementos del array que en este caso es data, 
              //el data es el resultado del controlador y es un array en formato json_encode
              //   $("#tablexample").append("<tr><th>"+data.nombrePersona+"</th><th>") para crear todos los elementos dentro de una tabla con el id
              // } 
              $('#txtnombrePersona').val(data.nombrePersona);
              $('#txtapellidoPersona').val(data.apellidoPersona);
              $('#txttelefonoPersona').val(data.telefonoPersona);
              $('#txtdireccionPersona').val(data.direccionPersona);
              $('#txtcorreoPersona').val(data.correoPersona);
              $('#txtcod_personas').val(data.cod_personas)

            $("#exampleModal1").modal();
            }).fail(()=>{// fail para verificar que el ajax si se ejecuta pero tiene algún error 
              console.log('Error');
            })
        }
    </script>

<script>
function consultar(id) {
$.ajax ({ 
  url:'<?php echo URL ?>Configuraciones/editar', 
  type: 'POST',
  datatype: 'JSON',
  data:
  {
    "id":id
  }
}).done((data)=>{
  objData=JSON.parse(data);
    $('#recipient_name').val(objData.id), //Trae el id del rol a consultar
    $('#message_text').val(objData.nombreRol),//Trae el nombre del rol a consultar
    $('#exampleModal').modal();// se abre el modal
}).fail(function (err){
console.log("error"+err)
}) 
}

</script>

<script>


function consultarTD(idtd){
$.ajax({
url:'<?php echo URL?>Configuraciones/consultar',
type: 'POST',
datatype: 'JSON',
data: 
{
  "idtipod":idtd
}
}).done((data)=>{
objData=JSON.parse(data);
$('#principalTD').val(objData.idtipoDocumento),
$('#nombreTipoDocumento').val(objData.nombreTipoDocumento),
$('#modalTD').modal()
}).fail(function (err){
  console.log("error"+err)
})
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

