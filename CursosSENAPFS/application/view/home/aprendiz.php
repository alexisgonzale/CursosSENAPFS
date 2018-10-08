<main class="app-content"> 
  <div class="app-title">
    <div>
      <h1><i class="fas fa-user-graduate"></i><b> Publicaciones</b></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?php echo URL; ?>CursosPersona/index">Mis cursos</a></li>
    </ul>
  </div>
  <div class="row">
      <div class="col-lg-8">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-info">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Nota: </strong>Para nosotros es importante contar con toda la información requerida. ¿Ya completó su registro?</strong><a class="alert-link" href="<?php echo URL?>Interesados/index"> Da clic aquí.</a><br>
          </div>
        </div>
      </div>
      <div class="col-md-12">
      <div class="tile">
        <h1 class="tile-title"><b>Anuncios</b><a href="<?php echo URL; ?>CursosPersona/index"><button type="button" class="btn btn-secundary float-right" title="Mis cursos" style="border-radius:20px"><i class="far fa-eye"></i> Mis cursos</button></a></h1><hr><br>
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
              <img class="card-img-top" src="<?= URL?>public/imgcursos/<?=$value->img ?>">
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
              <center>
                <button class="btn btn-info" style="padding: 0.375rem 2.75rem !important;border-radius:20px;" type="button" data-toggle="modal" data-target="#infoCurso" title="Inscripción" onclick="openModal(<?=$value->idPublicacion?>)">Ver más &nbsp;
              </center>
              </div>
          </div>
        </div> 
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div>
  </main>

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
  <div class="modal-footer">
  <input type="hidden" id="cod_p" value="<?php echo $_SESSION['cod_personas']?>">
  <button id="btnInscrip" class="btn btn-info" type="submit" style="border-radius:20px" >Inscribirme</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
  </form>
</div>
</div>
</div>

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
<script>
  function openModal(id, idCourse) {
    // alert(idCourse);
    $.ajax({
        url: '<?php echo URL ?>publicaciones/editPublication',
        type: 'POST',
        dataType: 'JSON',
        data: {
          "id": id
        }
      })
      .done((data) => {
        console.log(data);
        $("#myBody").empty();
        $("#myBody").append("<tr><input type='hidden' name='idCurso' value=" + data['idCursos'] + "><td>" + data[
            'nombreCurso'] + "</td><td>" + data['cantidadHoras'] + " horas" + "</td><td>" + data['encargadoCurso'] +
          "</td><td>" + data['cupos'] + "</td><td>" + data['fechaInicio'] + "</td><td>" + data['fechaFin'] +
          "</td></tr>");
          $("#btnInscrip").click(function(){
            $.ajax({
              url: '<?php echo URL ?>publicaciones/sendMail',
              type: 'POST',
              dataType: 'JSON',
              data: {
                "id":id
              }
              
            })
          })
          $("#infoCurso").modal();
      })

  }
</script>

