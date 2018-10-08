<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-fw fa-lg fa-check-circle"></i> Formulario usuarios</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= URL?>Personas/cargarlistar">Consultar usuarios</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Registrar usuarios</h3>
            <hr>
            <div class="tile-body">
              <form id="signupForme" action="<?=URL?>Interesados/registrarInteresado" method="POST">
              <div class="row">
                <div class="form-group col-md-6">
                        <label><b>Seleccionar Tipo Identificación <label style="color:red">*<label></b></label>
                        <select class="form-control" name="txttipoDocumento" id="" style="border-radius:20px" required>
                            <option value="">Seleccionar Tipo de Identificación</option>
                            <?php foreach($resultados as $key=>$value): ?>

                            <option value= "<?=$value->idtipoDocumento?>"><?=$value->nombreTipoDocumento?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Número Identificación <label style="color:red">*<label></b></label>
                    <input class="form-control" type="number" min="5" name="txtdocumentoPersona" placeholder="Número de Identificación" style="border-radius:20px" required>
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
                    <input class="form-control" type="number" name="txttelefonoPersona" placeholder="Teléfono" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="control-label"><b>Dirección <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" name="txtdireccionPersona" placeholder="Dirección" style="border-radius:20px" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                      <label class="control-label" for="email"><b>Correo</b> (Usuario)</label>
                      <input class="form-control" id="txtcorreoPersona" type="email" name="txtcorreoPersona"  placeholder="Correo" style="border-radius:20px" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label class="control-label"><b>Profesión <label style="color:red">*<label></b></label>
                      <select class="form-control" name="allProfessions" id="allProfessions" style="border-radius:20px" required>
                        <option value="">Seleccione una profesión</option>
                        <?php foreach ($lgn as $value): ?>
                        <option value="<?php echo $value->idProfesion ?>"><?php echo $value->nombreProfesion ?></option>
                        <?php endforeach;?>
                      </select>
                      </div>
                    <div class="form-group col-md-3">
                    <label class="control-label"><b>Lugar Trabajo <label style="color:red">*<label></b></label>
                    <input class="form-control" type="text" name="txtLugarProfesion" placeholder="Lugar Trabajo" style="border-radius:20px" required>
                    </div>
                    <input class="form-control" type="hidden" name= "txtrol"  value="2" placeholder="Rol Persona" required>
                </div>
                <div class="tile-footer">
              <center><button class="btn btn-primary" type="submit" style="border-radius:20px"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button></center>
            </div>
                </form>
              
            </div>
         </div>
        </div>
      </main>

