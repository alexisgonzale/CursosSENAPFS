<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-quote-right"></i><b> Respuestas</b></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="<?php echo URL ?>Preguntas/forAprendiz">Preguntas</a>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fas fa-angle-double-right"></i><b> Respuesta a mis preguntas</b></h3><hr>
                <div id="items">
                <?php foreach ($questions1 as $value): ?>
                    <div class="row">
                        <div class="form-group col-md-12">                                
                            <div class="card">
                                <div class="card-header">
                                  <i class="far fa-dot-circle" style="color:#20c997"></i><u style="font-size:20px;text-decoration: none;"> <?php echo $value->descripcionPregunta?></u>                                  
                                    <button class="btn btn-outline-danger float-right" onclick="deleteAnswers(<?php echo $value->idPregunta?>)" title="Eliminar pregunta"><i class="fa fa-lg fa-trash"></i></button>                                 
                                    </div>
                                <a onclick="return blmostrocult(this);" style="margin:5px; cursor: pointer;"><i class="fas fa-angle-down"></i></a><div style="display: none;padding: 10px;"><p style="font-size:15px;"> <?php echo $value->respuestaPregunta ?></p></div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>   
</main>
    
    <script>
      function deleteAnswers(id)
      {
      	swal({
      		title: "¡ADVERTENCIA!",
      		text: "¿Seguro desea eliminar la pregunta?",
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
            url: '<?php echo URL; ?>Preguntas/deleteMyAnswers/'+id,
            type: 'POST',
            dataType: 'JSON',
            }).done(function(data){
                swal("¡Eliminado!", "Se ha eliminado correctamente la pregunta", "success");
            setTimeout(function () { location.reload(1); }, 1000);
            })
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



            
         