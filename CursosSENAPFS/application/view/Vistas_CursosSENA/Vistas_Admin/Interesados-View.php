<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-fw fa-lg fa-check-circle"></i> <b>Formulario usuarios</b></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Modificar Datos</h3>
            <hr>
            <div class="tile-body"> 
                <div id="other">
                <form id="signupForm" action="<?=URL?>Interesados/mod_completar" method="POST">
                <div class="row">
                <input class="form-control" type="hidden" name="txtcod_personas" id="txtcod_personas" value="<?=$res->cod_personas?>" placeholder="Número de Identificación"  style="border-radius:20px" required>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Nombres <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" name="txtnombrePersona"  id="txtnombrePersona" placeholder="Nombres" value="<?=$res->nombrePersona?>" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Apellidos <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" id="txtapellidoPersona" name="txtapellidoPersona"  placeholder="Apellidos" value="<?=$res->apellidoPersona?>" style="border-radius:20px" required>
                    </div>
                </div>
              <div class="row">
              
                <div class="form-group col-md-6">
                      <label><b>Tipo de identificación <label style="color:red">*<label></b></label>
                      <select class="form-control"  name="txttipoDocumento" id="txttipoDocumento" style="border-radius:20px">
                          <option value="">Seleccione una opción</option>
                          <?php foreach($resultados as $key=>$value): ?>
                          <option value= "<?=$value->idtipoDocumento?>"><?=$value->nombreTipoDocumento?></option>
                          <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Número Identificación <label style="color:red">*<label></b></label>
                    <input class="form-control" type="number" min="5" name="txtdocumentoPersona" id="txtdocumentoPersona" value="<?=$res->documentoPersona?>" placeholder="Número de Identificación" style="border-radius:20px" required>
                    </div>
                </div>  
                <div class="row">
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Profesión <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" id="txtprofesionPersona" name="txtprofesionPersona" placeholder="Profesión" value="<?=$res->nombreProfesion?>" style="border-radius:20px" readonly="readonly" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Lugar Trabajo <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" id="txtLugarProfesion" name="txtLugarProfesion" placeholder="Lugar Trabajo" value="<?=$res->LugarProfesion?>" style="border-radius:20px" required>
                    </div>
                </div>           
                <div class="row">
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Teléfono <label style="color:red">*<label></b></label>
                    <input class="form-control" type="number" min="7" id="txttelefonoPersona" name="txttelefonoPersona" placeholder="Teléfono" value="<?=$res->telefonoPersona?>" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Dirección <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" id="txtdireccionPersona" name="txtdireccionPersona" placeholder="Dirección" value="<?=$res->direccionPersona?>" style="border-radius:20px" required>
                    </div>
                </div>
                </div>
                <div class="tile-footer">
                    <center><button class="btn btn-primary" type="submit" style="border-radius:20px"><i class="fa fa-fw fa-lg fa-check-circle" ></i> Actualizar</button></center>
                </div>
                </form>
              </div>
         </div>
        </div>
      </main>

      
