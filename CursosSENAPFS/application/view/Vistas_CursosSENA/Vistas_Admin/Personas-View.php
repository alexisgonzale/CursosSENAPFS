<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-fw fa-lg fa-check-circle"></i> Formulario Administradores</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= URL?>Configuraciones/index">configuraciones</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Registrar Administradores</h3>
            <hr>
            <div class="tile-body">
              <form id="signupForm" action="<?=URL?>Personas/registrarPersonas" method="POST">
              <div class="row">
                <div class="form-group col-md-6">
                        <label><b>Seleccionar Tipo Identificación <label style="color:red">*<label></b></label>
                        <select class="form-control" name="txttipoDocumento" id="" style="border-radius:20px"required>
                            <option value="">Seleccionar Tipo de Identificación</option>
                            <?php foreach($resultados as $key=>$value): ?>

                            <option value= "<?=$value->idtipoDocumento?>"><?=$value->nombreTipoDocumento?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Número Identificación <label style="color:red">*<label></b></label>
                    <input class="form-control" type="number" min="5" id="txtdocumentoPersona" name="txtdocumentoPersona" placeholder="Número de Identificación" style="border-radius:20px" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Nombres <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" name="txtnombrePersona" id="txtnombrePersona" placeholder="Nombres" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Apellidos <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" name="txtapellidoPersona" placeholder="Apellidos" style="border-radius:20px" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Teléfono <label style="color:red">*<label></b></label>
                    <input class="form-control" type="number" min="7" name="txttelefonoPersona" placeholder="Teléfono" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Dirección <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" name="txtdireccionPersona" placeholder="Dirección" style="border-radius:20px" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                    <label class="control-label" for="email"><b>Correo (Usuario) <label style="color:red">*<label></b></label>
                    <input class="form-control"  id="txtcorreoPersona" type="email" name="txtcorreoPersona"  placeholder="Correo" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-3">
                    <label class="control-label" for="confirm_email"><b>Confirmar Correo (Usuario) <label style="color:red">*<label></b></label>
                    <input class="form-control"  id="confirm_email"type="email" name="txtconfirm_email"  placeholder="Correo" style="border-radius:20px" required>
                    </div>
                    <input class="form-control" type="hidden" name= "txtrol"  value="1" placeholder="Rol Persona" required>
                    <div class="form-group col-md-3">
                    <label class="control-label" for="password"><b>Nueva Contraseña <label style="color:red">*<label></b></label>
                    <input class="form-control"  id="txtpassword" type="password" name="txtpassword"   placeholder="Contraseña" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-3">
                    <label class="control-label" for="confirm_password"><b>Confirmar Contraseña <label style="color:red">*<label></b></label>
                    <input class="form-control"  id="txtconfirm_password" type="password" name= "txtconfirm_password"   placeholder="Contraseña" style="border-radius:20px" required>
                    </div>
                </div>
                <div class="tile-footer">
              <center><button class="btn btn-info" type="submit" style="border-radius:20px"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button></center>
            </div>
          </form>              
          </div>
         </div>
        </div>
      </main>