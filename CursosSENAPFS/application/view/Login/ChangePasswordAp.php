<main class="app-content">
      <div class="app-title">
        <div>
        <h1><i class="fas fa-key"></i><b>  Cambiar contraseña</b></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
      </div>
      <div class="row" style="position:center;margin-left:35%; margin-top: 150px;">
        <div class="col-md-4">
          <div class="tile" style="border-radius:20px;">
            <h3 class="tile-title">Nueva contraseña</h3>
            <hr>
            <div class="tile-body">
            <form id="changePassword" Action="<?=URL?>Login/changepasswordAP" method="POST">
                <div class="form-group">
                    <label class="control-label"><b>Actual contraseña <label style="color:red">*<label></b></label>
                    <input class="form-control" style="border-radius:20px;" type="password" name="txtpassword2"  id="txtpassword2" placeholder="Actual contraseña"  required>
                </div>
                <div class="form-group">
                    <label class="control-label"><b>Nueva contraseña <label style="color:red">*<label></b></label>
                    <input class="form-control" style="border-radius:20px;" type="password" id="txtNewpasswor" name="txtNewpasswor"  placeholder="Nueva contraseña"  required>
                </div>
                <div class="form-group">
                    <label class="control-label"><b>Confirmar contraseña <label style="color:red">*<label></b></label>
                    <input class="form-control" style="border-radius:20px;" type="password" id="txtConfirmNewpasswor" name="txtConfirmNewpasswor"  placeholder="Confirmar contraseña" required>
                </div>
            <div class="tile-footer">
              <center><button class="btn btn-primary" style="border-radius:20px;" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Actualizar</button></center>
            </div>
            </form>
            </div>
         </div>
        </div>
