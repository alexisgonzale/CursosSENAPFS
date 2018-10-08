<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= URL ?>/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL ?>Public/img/favicon-16x16.png">
    <title>Login - SENA</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <div>
          <center><img src="<?php echo URL; ?>public/img/logo1.png" style= "width: 25%; heigth: 25%"></img>
          <h1>Cursos</h1>
          <h1> complementarios</h1>
          </center>
        </div>
      </div>
      <div class="login-box" style="border-radius:20px">
        <form id="reUsers" class="login-form" action="<?=URL?>Login/validarSesion" method= "POST">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input class="form-control" type="text"  name="txtcorreoPersona" maxlength="50" placeholder="Introducir email" style="border-radius:20px" required>
          </div>
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input class="form-control" type="password" name="txtpassword" maxlength= "15" placeholder="Introducir contraseña" style="border-radius:20px" required>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" style="border-radius:20px"><i class="fa fa-sign-in fa-lg fa-fw"></i> INICIAR</button>
          </div><br>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                <span ><h6><b><a href="<?=URL?>view/Login/Registrase.php" data-toggle="flip">REGÍSTRESE</b></h6></span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip2">¿OLVIDÓ CONTRASEÑA?</a></p>
            </div>
          </div>
        </form>


        
        <form class="forget-form2">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿HA OLVIDADO SU CONTRASEÑA?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" id="txtEmailRecover" name="txtEmailRecover" maxlength="50" type="text" placeholder="Introducir email" style="border-radius:20px" required>
          </div>
          <div class="form-group btn-container">
            <button type="button" class="btn btn-primary btn-block" style="border-radius:20px" onclick="recoverPass()"><i class="fa fa-unlock fa-lg fa-fw"></i>RECUPERAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="<?=URL?>Login/validarSesion" data-toggle="flip2"><i class="fa fa-angle-left fa-fw"></i> VOLVER</a></p>
          </div>
        </form>

        <form id="reUser" class="forget-form" action="<?=URL?>Login/registrarUsuario" method= "POST">
          <h3 class="login-head"><i class="fa fa-user-plus" aria-hidden="true"></i> NUEVO USUARIO</h3>
          <div class="row">
            <div class="form-group col-md-6">
            <input class="form-control" type="hidden" id="txtrol" name="txtrol" value="2" placeholder=" Introducir " style="border-radius:20px" required>
              <label class="control-label"><b>NOMBRE <label style="color:red">*<label></b></label>
              <input class="form-control" type="text" id="txtnombrePersona" name="txtnombrePersona" placeholder=" Introducir nombre" style="border-radius:20px" required>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label"><b>APELLIDO <label style="color:red">*<label></b></label>
              <input class="form-control" type="text" id="txtapellidoPersona" name="txtapellidoPersona" placeholder=" Introducir apellido" style="border-radius:20px" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label><b>TIPO IDENTIFICACIÓN <label style="color:red">*<label></b></label>
              <select class="form-control" name="txttipoDocumento" id="" style="border-radius:20px" required>
                  <option value="">Seleccionar tipo identificación</option>
                  <?php foreach($resultados as $key=>$value): ?>
                  <option value= "<?=$value->idtipoDocumento?>"><?=$value->nombreTipoDocumento?></option>
                  <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label"><b>N° IDENTIFICACIÓN <label style="color:red">*<label></b></label>
              <input class="form-control" type="number" id="txtdocumentoPersona" name="txtdocumentoPersona" placeholder=" Introducir n°" style="border-radius:20px" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
            <label class="control-label"><b>PROFESIÓN <label style="color:red">*<label></b></label>
            <select class="form-control" name="allProfessions" id="allProfessions" style="border-radius:20px" required>
              <option value="">Seleccione una profesión</option>
              <?php foreach ($lgn as $value): ?>
              <option value="<?php echo $value->idProfesion ?>"><?php echo $value->nombreProfesion ?></option>
              <?php endforeach;?>
            </select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label"><b>LUGAR TRABAJO <label style="color:red">*<label></b></label>
              <input class="form-control" type="text" id="txtLugarProfesion" name="txtLugarProfesion" placeholder="Lugar trabajo" style="border-radius:20px" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label"><b>EMAIL <label style="color:red">*<label></b></label>
            <input class="form-control" type="email" id="txtcorreoPersona" name="txtcorreoPersona" placeholder=" Introducir email" style="border-radius:20px" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label"><b>CONTRASEÑA <label style="color:red">*<label></b></label>
              <input class="form-control" type="password" id="txtpassword" name="txtpassword" placeholder=" Introducir contraseña" style="border-radius:20px" required>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label"><b>CONFIRMAR CONTRASEÑA <label style="color:red">*<label></b></label>
              <input class="form-control" type="password" id="txtconfirm_password" name="txtconfirm_password" placeholder=" Confirmar contraseña" style="border-radius:20px" required>
            </div>
          </div><br>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" style="border-radius:20px"><i class="fa fa-sign-out" aria-hidden="true"></i> REGISTRARSE</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="<?=URL?>Login/validarSesion" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> VOLVER</a></p>
          </div>
        </form>
      </div>
      <br>
      <center><label class="h5" style="margin-top:80px">&copy; FÁBRICA DE SOFTWARE - SENA 2018 </label>
      <div class="fixed"  onclick="myFunction()"><button class="btn btn-secundary btn-lg"><i class="fa fa-question"></i></button></div></center>
    
<div class="container" id="myDIV">
<div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-angle-double-right"></i><b> Preguntas Frecuentes</b>                                    
                </h3><hr>
                <div id="items">
                <?php foreach ($questions as $value): ?>
                    <div class="row">
                        <div class="form-group col-md-12">                                
                            <div class="card">
                                <div class="card-header">
                                <i class="fa fa-circle" style="color:#20c997"></i><u style="font-size:20px;text-decoration: none;"> <?php echo $value->descripcionPregunta?></u>
                                </div>
                                <a onclick="return blmostrocult(this);" style="margin:5px; cursor: pointer;"><i class="fa fa-angle-down"></i></a><div style="display: none;padding: 10px;"> <p style="font-size:15px;"> <?php echo $value->respuestaPregunta ?></p></i> </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
              </div>
            </div>
        </div>
      </div>
     
</main>
</div>
    </section>

       <script>
      function recoverPass()
      {
        $.ajax({
          url: '<?php echo URL ?>login/recoverPassword',
          type: 'POST',
          dataType: 'JSON',
          data:
          {
            "email":$('#txtEmailRecover').val()
          }
        }).done((data)=>{
          console.log(data);
        })
        location.reload();
      } 
    </script>

    <script>
var click = true;
function myFunction() {
    var x = $('#myDIV');
    if (click){
      x.animate({
        right : '0%'
      },1000);
      click = false
    }
   else if(click == false) {
    x.animate({
      right : '-100%'
      },1000);
      click = true
    }
}
</script>
    <style>
    body{
      width:100vw;
      height:100vh;
      overflow:hidden;
    }
    #myDIV{
      background: white;
      width:100%;
      height:100vh;
      position: absolute;
      top:0px;
      right:-100%;
    }

    .container{
     position:fixed;
    }

    .fixed {
    position: fixed;
    top:2%;
    right: 0;
    z-index:999;
    background-color: rgba(0, 150, 136, 0.5);
    }
    </style>


  <!-- Essential javascripts for application to work-->
  <script src="<?=URL?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?=URL?>/js/popper.min.js"></script>
    <script src="<?=URL?>/js/bootstrap.min.js"></script>
    <script src="<?=URL?>/js/main.js"></script>
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=URL?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/validaciones.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
      //
      $('.login-content [data-toggle="flip2"]').click(function() {
      	$('.login-box').toggleClass('flipped2');
      	return false;
      });
    </script>
  </body>
  <?php 
    if(isset($_SESSION['mensaje'])){
      echo $_SESSION['mensaje'];
      $_SESSION['mensaje']=null;
    }
  ?>
</html>
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
            step:7
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
