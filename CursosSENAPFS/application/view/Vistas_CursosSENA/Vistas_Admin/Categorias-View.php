<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-home"></i> Categorías </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo URL ?>categories/index">Consultar categorías</a>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><b>Registrar categorías</b></h3><hr>
            <div class="tile-body">
              <form action="<?php echo URL ?>categories/addCategory" method="POST">
              <div class="row">
                <div class="form-group col-md-3">
                  <label class="control-label"><b>Nombre <label style="color:red">*<label></b></label>
                  <input class="form-control" name="txtNameCategoria" style="border-radius:20px" type="text" placeholder="Nombre de la categoría" required>
                </div>
                <div class="form-group col-md-3">
                <label class="control-label"><b>Profesión <label style="color:red">*<label></b></label>
                <select class="form-control" id="profesiones" style="border-radius:20px">
                              <option id="selectProf" value="0">Seleccione una profesión</option>
                              <?php foreach ($prof as $value): ?>
                                  <option value="<?php echo $value->idProfesion ?>"><?php echo $value->nombreProfesion ?></option>
                              <?php endforeach;?>
                </select>

                </div>
                <div class="col-md-12">
                <center>

                <button type="button" style="margin-right: -82px;margin-top: -95px; border-radius:20px;" class="btn btn-primary" onclick="add_professions()">Añadir&nbsp;<i class="fas fa-plus-circle"></i></button>
                </center>
                <!-- <button type="submit"  class="btn btn-primary">Registrar&nbsp;<i class="fas fa-check-circle"></i></button> -->
                </div>
                <!-- <br><br><br><br> -->
                <div class="col-md-8">
                 <table class="table table-bordered table-hover" style="width:50%" id="tbl_profesiones">
                    <thead>
                      <tr>
                        <th>Profesión</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody id="bodyTable">

                    </tbody>
                  </table>
                  <br>
                  <button type="submit" style="border-radius: 20px;" class="btn btn-primary">Registrar&nbsp;<i class="fas fa-check-circle"></i></button>
                </div>
                <br><hr><br>

                </div>
              </form>
            </div>
          </div>
        </div>
    </main>

    <script>
    function add_professions()
    {
      let id_profesion = $("#profesiones").val();
      let texto_profesion = $("#profesiones option:selected").text();
      let selecc = $("#selectProf").val();
      if($("#profesiones").val()==0)
      {
        swal("¡Error!","No puede agregar esta opción.","error");
      }
      else if(!document.getElementById("idMyProfesion" + id_profesion )){
      $("#tbl_profesiones").append(
        // "<tr id='tr"+id_profesion+"'> <input type='hidden' name='profesiones_id[]' value='"+id_profesion+"'> <td>"+texto_profesion+"</td><td><button type='button' class='btn btn-danger' onclick='$("+'"'+"#tr"+id_profesion+'"'+").remove()'> <i class='fas fa-times-circle' title='Eliminar'></i></button> </td></tr>"
        "<tr id='idMyProfesion" + id_profesion + "'> <input type='hidden' name='profesiones_id[]' value='"+id_profesion+"'> <td>"+texto_profesion+"</td><td><button type='button' class='btn btn-danger' onclick='$("+'"'+"#idMyProfesion"+id_profesion+'"'+").remove()'> <i class='fas fa-times-circle' title='Eliminar'></i></button> </td></tr>"
      )
      }else{
      swal("¡Información duplicada!", "Esta profesión ya fue añadida.", "error");
      }
    }
    </script>