<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-question"></i><b> Preguntas</b></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="<?php echo URL ?>Preguntas/fromAprendiz">Preguntas Aprendiz</a>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><i class="fas fa-plus-square"></i><b> Añadir preguntas</b></h3><hr>
            <div class="tile-body">
            <form action="<?php echo URL ?>Preguntas/addQuestion" method="POST">
              <div class="row">
                <div class="form-group col-md-12">
                  <label class="control-label"><b>Pregunta *</b></label>
                  <input class="form-control" name="txtquestion" id="txtquestion" type="text" maxlength="200" m placeholder="Escriba aquí su pregunta" style="border-radius:20px" required>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label"><b>Respuesta * </b></label>
                    <textarea class="form-control" maxlength="500" placeholder="Ingrese aquí la respuesta correcta." name="txtanswer" id="txtanswer" rows="5" style="border-radius:20px" required></textarea><br>
                    <button class="btn btn-info" style="border-radius:20px">Publicar</button>
                </div>
             </div>
            </form>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fas fa-question"></i><b> Preguntas frecuentes</b></h3><hr>
                <div id="items">
                <?php foreach ($questions as $value): ?>
                    <div class="row">
                        <div class="form-group col-md-12">                                
                            <div class="card">
                                <div class="card-header">
                                <i class="far fa-dot-circle" style="color:#20c997"></i><u style="font-size:20px;text-decoration: none;"> <?php echo $value->descripcionPregunta?></u>
                                    <button class="btn btn-danger float-right" title="Eliminar pregunta" onclick="deleteQuestion(<?= $value->idPregunta ?>)" style="border-radius:20px"><i class="fa fa-lg fa-trash"></i></button>
                                    <button class="btn btn-info float-right" data-toggle="modal" data-target="" title="Editar pregunta" onclick="editQuestions(<?= $value->idPregunta ?>)" style="border-radius:20px"><i class="fa fa-lg fa-edit"></i></button>
                                </div>
                                <a onclick="return blmostrocult(this);" style="margin:5px; cursor: pointer;"><i class="fas fa-angle-down"></i></a><div style="display: none;padding: 10px;"> <p style="font-size:15px;"> <?php echo $value->respuestaPregunta ?></p></i> </div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>   
</main>

<div class="modal fade" id="editQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar pregunta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form  id="editQuestions" action="<?=URL?>Preguntas/updateQuestion" method="POST">
          <input class="form-control" name="txtCodigoPregunta" type="hidden" id="txtCodigoPregunta" style="border-radius:20px">
            <div class="form-group">
                <label class="control-label"><b>Pregunta <label style="color:red">*</label> </b></label>
                <input class="form-control" id="txtQuestionModal" name="txtQuestionModal" maxlength="200" type="text" placeholder="Escriba aquí su pregunta" style="border-radius:20px" required>
            </div>
              <label class="control-label"><b>Respuesta <label style="color:red">*</label> </b></label>
              <textarea class="form-control" maxlength="500" placeholder="Ingrese aquí la respuesta correcta." name="txtPublicacionModal" id="txtPublicacionModal" rows="5" style="border-radius:20px" required></textarea><br>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
            <button type="submit" class="btn btn-primary"  style="border-radius:20px">Actualizar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

  <script>
    function editQuestions(id)
    {
      $.ajax({
        url: '<?php echo URL;?>preguntas/editQuestion',
        type: 'POST',
        dataType: 'JSON',
        data:
        {
          "id":id
        }
      }).done((data)=>{
        console.log(data);
        $("#txtQuestionModal").val(data.descripcionPregunta);
        $("#txtPublicacionModal").val(data.respuestaPregunta);
        $("#txtCodigoPregunta").val(data.idPregunta);
      })
      $("#editQuestion").modal();
    }
  </script>
    
    <script>
      function deleteQuestion(id)
      {
        swal({
          title: "¡ADVERTENCIA!",
          text: "¿Está seguro que desea eliminar este registro?",
          type: "warning",
          timer: 3000,
          showCancelButton: true,
          confirmButtonText: "Sí",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function(isConfirm) {
          if (isConfirm) {
          $.ajax({
            url: '<?php echo URL; ?>preguntas/deleteQuestion',
            type: 'POST',
            dataType: 'JSON',
            data:
              {
                "id":id
              }
            })
            swal("¡Eliminado!", "El registro se ha eliminado correctamente.", "success");
            setTimeout(function () { location.reload(1); }, 1000);
          }else {
            swal("¡Cancelado!", "El registro no ha sido eliminado.", "error");
          }
        });
      }
    </script>

<script type='text/JavaScript'>
    function blmostrocult(blconted) {
    var c=blconted.nextSibling;
    if(c.style.display=='none') {
    c.style.display='block';
    } else {
    c.style.display='none';
    }
    return false;
    }
</script>

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