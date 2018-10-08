<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-home"></i> Inicio</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo URL; ?>Publicaciones/indexListar">Listar Publicaciones</a></li>
        </ul>
      </div>
      <div class="row animated" >
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fas fa-graduation-cap"></i>
            <div class="info">
              <a href="<?php echo URL;?>cursos/index"><h4>Cursos</h4></a>
              <p><b><?php echo $cursos->Cantidad?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fas fa-bars"></i>
            <div class="info">
              <a href="<?php echo URL;?>categories/index"><h4>Categorías</h4></a>
              <p><b><?php echo $cat->Cantidad?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fas fa-users"></i>
            <div class="info">
              <a href="<?php echo URL; ?>personas/cargarlistar"><h4>Personas</h4></a>
              <p><b><?php echo $people->Cantidad?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3" >
          <div class="widget-small primary coloured-icon"><i class="icon fas fa-id-card"></i>
            <div class="info">
              <a href="<?php echo URL; ?>configuraciones/index"><h4>Tipo de Documento</h4></a>
              <p><b><?php echo $td->Cantidad?></b></p>
            </div>
          </div>
        </div>
      </div>

    <div class="col-md-12">
      <div class="tile">
        <h1 class="tile-title"><b>Anuncios</b><button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addPublication" title="Registrar publicación" style="border-radius:20px"><i class="fas fa-plus-circle"></i></button></h1><hr><br>
        <div id="items" class="row" style="display: flex; justify-content: center;">
          <?php foreach($publications as $value): ?>
          <!--  -->
          <div>
          <div class="card" style="width: 18rem; margin: 10px 10px;box-shadow: 1px 1px 9px #cecccc">
          <h4><a class="list-group-item list-group-item-action active" 
                style="color:#FFFFFF; 
                font-size:18px;
                border-radius:3px 3px 0px 0px;
                border: 1px solid #009688;
                width: 100.5%;
                display: block;
                margin: 0px -1px;">
            <?php echo $value->nombreCurso ?></a></h4>
            <?php 
              if ($value->img != NULL){ ?>
              <img class="card-img-top"  src="<?= URL?>public/imgcursos/<?=$value->img ?>">
              <?php                
              }
              ?>
              <div class="card-body">
                <h5 class="card-title"><?=$value->tituloPublicacion?></h5>
                <p class="card-text"><?= $value->distribucionHoraria ?></p>
                <p class="card-text"><?= $value->requisitosCurso ?></p>
                <p class="card-text"><?= $value->descripcionPublicacion ?></p>
              </div>
            <div style="background-color: #f9f9f9 !important;" class="card-footer bg-transparent border-success">
              <button style="border: 1px solid #009688;border-radius:20px;" class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#infoCurso" title="Ver más" onclick="openModal(<?=$value->idPublicacion?>)" class="col-md-6" ><i class="fas fa-eye"></i></button>
              <?php if($value->Estado == 'Activo') :?>      
              <a href="<?= URL ?>Publicaciones/deletePublication/<?= $value->idPublicacion ?>/<?= $estado = "Inactivo" ?>"><button style="border-radius:20px;" class="btn btn-danger float-right" type="button" title="Eliminar"><i class="fas fa-trash-alt"></i></button></a>
                          <?php endif;?>          
              <button style="margin: 0px 5px;background: #dedede;border-radius:20px;" class="btn btn-secundary float-right" type="button" title="Editar" rdata-toggle="modal" onclick="editarPublicacion(<?= $value->idPublicacion ?>)"><i class="fas fa-edit"></i></button>
              <button style="border: 1px solid #009688;border-radius:20px;" class="btn btn-info" type="button" data-toggle="modal" data-target="" onclick="openModalSearch(<?=$value->idCursos?>)" title="Inscripción"><i class="fas fa-user-plus"></i></button>
            </div>
          </div>
        </div> 
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div>
  </main>

  <!-- modal de inscripción adm-pers -->
  <div class="modal" tabindex="-1" role="dialog" id="inscripcion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preinscripción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border-radius:20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-6">
            <label><b>Seleccionar Tipo Identificación <label style="color:red">*<label></b></label>
            <select class="form-control" name="txttipoDocumento" id="txttipoDocumento" style="border-radius:20px" required>
              <option value="">Seleccionar Tipo de Identificación</option>
              <?php foreach($resultados as $key=>$value): ?>
              <option value= "<?=$value->idtipoDocumento?>"><?=$value->nombreTipoDocumento?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-6">
          <label><b>Número Identificación <label style="color:red">*<label></b></label>
            <input type="number" class="form-control" name="txtdocumentoPersona" id="txtdocumentoPersona" placeholder="N°. Identificación" style="border-radius:20px" style="border-radius:20px" required>
          </div>  
          <div class="col-md-12">
          <center>
            <input type="button" class="btn btn-primary" value="Buscar" onclick="getPersona()" style="border-radius:20px"/>
          </center>  
          </div>  
        <form action="<?= URL?>Publicaciones/inscripciomAdmPers" method="post">
          <div id="limpiarDiv" class="col-md-12"><hr><br>
            <p id="getxpersona"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
        <button id="btnAdmnxPersona" type="submit" class="btn btn-info" style="border-radius:20px">Registar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--  -->

  <!--registrar  -->
<div class="modal fade" id="addPublication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar publicación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border-radius:20px">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo URL?>publicaciones/addPublications" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <label class="control-label"><b>Curso <label style="color:red">*<label></b></label>
            <select class="form-control" name="allCursos" id="allCursos" style="border-radius:20px" required>
              <option value="">Seleccione un curso</option>
              <?php foreach($cursosSelect as $value=> $key): ?>
              <option value="<?php echo $key->idCursos?>"><?php echo $key->nombreCurso ?></option>
              <?php endforeach;?>
            </select>
            <br>   
            <div class="form-group">
              <label class="control-label"><b>Título <label style="color:red">*<label></b></label>
              <input class="form-control" id="txtTitle" maxlength="100" name="txtTitle" type="text" placeholder="Título de la publicación" style="border-radius:20px" required>
            </div>
            <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label"><b>Distribución Horaria <label style="color:red">*<label></b></label>
              <input class="form-control" id="txtdistribucionHoraria" maxlength="100" name="txtdistribucionHoraria" type="text" placeholder="Distribución Horaria" style="border-radius:20px" required>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label"><b>Imagen </b></label>
              <input class="form-control" id="imag" name="imag" type="file"  style="border-radius:20px">
            </div>
            </div>
            <div class="form-group">
              <label class="control-label"><b>Requisitos <label style="color:red">*<label></b></label>
              <input class="form-control" id="txtrequisitosCurso" maxlength="100" name="txtrequisitosCurso" type="text" placeholder="Requisitos" style="border-radius:20px" required>
            </div>
              <label class="control-label"><b>Descripción <label style="color:red">*<label></b></label>
              <textarea class="form-control" placeholder="¿Qué estás pensando?" maxlength="240" name="txtPublicacion" id="txtPublicacion" rows="5" style="border-radius:20px" required></textarea><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
              <button type="submit" class="btn btn-primary" style="border-radius:20px">Registrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  <!-- editar -->
 <div class="modal fade" id="editPublication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar publicación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border-radius:20px">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= URL?>publicaciones/updatePublication" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
          <input class="form-control" name="txtCodPublicacion" type="hidden" id="txtCodPublicacion" style="border-radius:20px" required>
          <div class="form-group">
          <label class="control-label"><b>Curso <label style="color:red">*<label></b></label>  
            <input class="form-control" name="allCursosModal" type="text" id="allCursosModal" style="border-radius:20px" readonly="readonly" required>
          </div>
            <div class="form-group">
                <label class="control-label"><b>Título <label style="color:red">*<label></b></label>
                <input class="form-control" id="txtTitleModal" maxlength="100"name="txtTitleModal" type="text" placeholder="Título de la publicación"  style="border-radius:20px"required>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                  <label class="control-label"><b>Distribución Horaria <label style="color:red">*<label></b></label>
                  <input class="form-control" id="txtdistribucionHorariaMD" maxlength="100" name="txtdistribucionHorariaMD" type="text" placeholder="Distribucion Horaria" style="border-radius:20px" required>
              </div>
            
              <div class="form-group col-md-6">
                <label class="control-label"><b>Imagen:  </b></label>
                <input class="form-control" id="imags" name="imag" type="file" style="border-radius:20px">
              </div>
           
            </div>
            <div class="form-group">
                <label class="control-label"><b>Requisitos <label style="color:red">*<label></b></label>
                <input class="form-control" id="txtrequisitosCursoMD" maxlength="100" name="txtrequisitosCursoMD" type="text" placeholder="Requisitos" style="border-radius:20px" required>
            </div>
              <label class="control-label"><b>Descripción <label style="color:red">*<label></b></label>
              <textarea class="form-control" placeholder="¿Qué estás pensando?" maxlength="240" name="txtPublicacionModal" id="txtPublicacionModal" rows="5" style="border-radius:20px" required></textarea><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="border-radius:20px">Actualizar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    
   <!-- ver más modal -->
<div class="modal fade animated zoomInUp" id="infoCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="<?= URL ?>Publicaciones/registrar" method="POST" >
      <div class="modal-body">
      
        <table class="table">
          <thead>
            <tr>
              <th>Curso</th>
              <th>Duración</th>
              <th>Encargado</th>
              <th>Cupos</th>
              <th>Fecha inicio</th>
              <th>Fecha fin</th>
            </tr>
          </thead>
          <tbody id="myBody">

          </tbody>
        </table>
        </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
  </form>
</div>
</div>
</div>

  
<script>
function openModal(id)
{
  $.ajax({
    url: '<?php echo URL ?>publicaciones/editPublication',
    type: 'POST',
    dataType: 'JSON',
    data:
    {
      "id":id
    }
  })
  .done((data)=>{
    $("#myBody").empty();
    $("#myBody").append("<tr><input type='hidden' name='idCurso' value="+data['idCursos']+"><td>"+data['nombreCurso']+"</td><td>"+data['cantidadHoras']+" horas"+"</td><td>"+data['encargadoCurso']+"</td><td>"+data['cupos']+"</td><td>"+data['fechaInicio']+"</td><td>"+data['fechaFin']+"</td></tr>");
  })
    $("#infoCurso").modal();
  }
</script>

<script>
function editarPublicacion(id)
{
  $.ajax({
    url: '<?php echo URL;?>publicaciones/editPublicationn',
    type: 'POST',
    dataType: 'JSON',
    data:
    {
      "id":id
    }
  }).done((data)=>{
    console.log(data);
      $("#allCursosModal").val(data.nombreCurso);
      $("#txtTitleModal").val(data.tituloPublicacion);
      $("#txtPublicacionModal").val(data.descripcionPublicacion);
      $("#txtdistribucionHorariaMD").val(data.distribucionHoraria);
      $("#txtrequisitosCursoMD").val(data.requisitosCurso);
      // $("#imags").val(data.img);
      $("#imags").text(data.img);
      $("#txtCodPublicacion").val(data.idPublicacion);

    $("#editPublication").modal('show')
  })
}
</script>

<script>

  function openModalSearch(idCurso, correoPersona)
  {
      $("#getxpersona").append("<input type='hidden' name='txtCod_Curso' value="+ idCurso +">");
      $('#inscripcion').modal();
      $.ajax({
        url:'<?php echo URL; ?>publicaciones/sendMailAdmnAjax',
        type: 'POST',
        dataType: 'JSON',
        data:
        {
          "idCurso":idCurso
        }
    }).done((data)=>{
      console.log(data);
      $('#btnAdmnxPersona').click(function (){
        $.ajax({
          url: '<?php echo URL ?>publicaciones/sendMailAdmn'
        })
      })
    })
  }

  function getPersona()
  {
    var id=$('#txtdocumentoPersona').val()
    var tipo=$('#txttipoDocumento').val()
    console.log(id);
    $.ajax({
      url:'<?php echo URL; ?>Publicaciones/buscarAdmPers/'+id+tipo,
      type: 'POST',
      dataType: 'JSON',
      data:
      {
        "id":id,
        "tipo":tipo,
      }
    }).done((data)=>{
      console.log(data);
        if(data.length  != 0 ){
        $.each(data, function(index, value){
            $("#getxpersona").append("<input type='hidden' name='txtCod_Persona' value="+ value["cod_personas"] +"> <input type='hidden' name='txtCorreoPersona' value="+ value["correoPersona"] +"> <input type='hidden' name='txtNombrePersonaj' value="+ value["nombrePersona"] +"> <input type='hidden' name='txtApellidoPersonaj' value="+ value["apellidoPersona"] +"> <p><i class='fas fa-angle-double-right'></i> "+ value['nombrePersona'] +" "+value['apellidoPersona']+"</p>");
        });
        }else{
          var x = $("#getxpersona").append("<div> <p><i class='fas fa-angle-double-right'></i>  No se encontro ningun resultado.</p></div>");
          }
      })
  }
</script>
// 
<script type="text/javascript">
    
    jQuery(function($){
        
        $('div#items').easyPaginate({
            step:8
        });
        
    });    
        
        </script>
<script>
(function($) {
          
          $.fn.easyPaginate = function(options){
      
              var defaults = {                
                  step: 4,
                  delay: 500,
                  numeric: true,
                  nextprev: true,
                  auto:false,
                  pause:4000,
                  clickstop:true,
                  controls: 'pagination',
                  current: 'current' 
              }; 
              
              var options = $.extend(defaults, options); 
              var step = options.step;
              var lower, upper;
              var children = $(this).children();
              var count = children.length;
              var obj, next, prev;        
              var page = 1;
              var timeout;
              var clicked = false;
              
              function show(){
                  clearTimeout(timeout);
                  lower = ((page-1) * step);
                  upper = lower+step;
                  $(children).each(function(i){
                      var child = $(this);
                      child.hide();
                      if(i>=lower && i<upper){ setTimeout(function(){ child.fadeIn('slow') }, ( i-( Math.floor(i/step) * step) )*options.delay ); }
                      if(options.nextprev){
                          if(upper >= count) { next.fadeOut('slow'); } else { next.fadeIn('slow'); };
                          if(lower >= 1) { prev.fadeIn('slow'); } else { prev.fadeOut('slow'); };
                      };
                  });    
                  $('li','#'+ options.controls).removeClass(options.current);
                  $('li[data-index="'+page+'"]','#'+ options.controls).addClass(options.current);
                  
                  if(options.auto){
                      if(options.clickstop && clicked){}else{ timeout = setTimeout(auto,options.pause); };
                  };
              };
              
              function auto(){
                  if(upper <= count){ page++; show(); }            
              };
              
              this.each(function(){ 
                  
                  obj = this;
                  
                  if(count>step){
                      
                      var pages = Math.floor(count/step);
                      if((count/step) > pages) pages++;
                      
                      var ol = $('<ol id="'+ options.controls +'"></ol>').insertAfter(obj);
                      
                      if(options.nextprev){
                          prev = $('<li class="prev">Anterior</li>')
                              .hide()
                              .appendTo(ol)
                              .click(function(){
                                  clicked = true;
                                  page--;
                                  show();
                              });
                      };
                      
                      if(options.numeric){
                          for(var i=1;i<=pages;i++){
                          $('<li data-index="'+ i +'">'+ i +'</li>')
                              .appendTo(ol)
                              .click(function(){    
                                  clicked = true;
                                  page = $(this).attr('data-index');
                                  show();
                              });                    
                          };                
                      };
                      
                      if(options.nextprev){
                          next = $('<li class="next">Siguiente</li>')
                              .hide()
                              .appendTo(ol)
                              .click(function(){
                                  clicked = true;            
                                  page++;
                                  show();
                              });
                      };
                  
                      show();
                  };
              });    
              
          };    
      
      })(jQuery);
</script>
<style>   
/* content */
        
    ol#pagination{overflow:hidden;}
    ol#pagination li{float:left;list-style:none;cursor:pointer;margin:0 0 0 .5em;}
    ol#pagination li.current{color:#f8f9fa;font-weight:bold;height: 30px;width: 30px;display: table-cell;text-align: center;font-size:19px;vertical-align: middle;border-radius: 100%;background: #009688;
    }
</style>