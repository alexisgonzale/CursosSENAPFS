<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="icon fas fa-list-ul"></i> Categorías </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item" href="<?php echo URL; ?>"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="<?php echo URL; ?>categories/create">Consultar categorías</a>

        </ul>
      </div>

  <div class="row">
    <div class="col-md-6 " >
      <div class="tile">
        <center><h2 class="tile-title"><b>Lista de categorías</b></h2></center><br>
        <div class="tile-body">
        <div class="table-responsive">
        <table class="table table-hover table-bordered" id="myTable">
            <thead>
              <tr>
                <th>Categoría</th>
                <th>Acciones</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php foreach ($categories as $value): ?>
                <tr>
                  <td><a title="Profesiones" onclick="getProfessions(<?=$value->idCategoria_Cursos?>)"><?php echo $value->nombreCategoria ?></a></td>
                  <td>
                    <button class="btn btn-info" onclick="editCategory(<?php echo $value->idCategoria_Cursos ?>)" title="Editar" type="button" style="border-radius:20px"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
                <?php endforeach;?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
          <div class="tile">
            <center><h3 class="tile-title">Profesiones</h3></center>
            <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre</th>
                </tr>
              </thead>
              <tbody>
                <tr id="profesiones_categorias">
                </tr>               
              </tbody>
            </table>
          </div>
          </div>
        </div>


    <div class="col-md-6 " >
      <div class="tile">
        <center><h2 class="tile-title"><b> Lista de profesiones</b>&nbsp;<button type="button" title="Añadir profesión" class="btn btn-primary float-right" onclick="modalAdd()" style="border-radius:50%;"><i class="fas fa-plus"></i></button></h2></center><br>
        <div class="tile-body">
        <div class="table-responsive">
        <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Profesión</th>
                <th>Acciones</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php foreach ($profesiones as $value): ?>
                <tr>
                  <td><?php echo $value->nombreProfesion ?></td>
                  <td>
                    <button class="btn btn-info"  title="Editar" type="button" onclick="editProfesion(<?=$value->idProfesion?>)" style="border-radius:20px"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
                <?php endforeach;?>
            </tbody>
          </table>
          </div>
            </div>
          </div>
        </div>
        <!--  -->
    </main>

  <div class="modal fade" id="editCategories" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar categorías</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?php echo URL; ?>categories/updateCategory" method="POST">
          <input readOnly class="form-control" name="txtCodCategory" type="hidden" id="txtCodCategory" value="">
          <div class="row">
          <div class="col-md-12">
            <label class="control-label"><b>Nombre <label style="color:red">*<label></b></label>
            <input class="form-control" name="txtNameCategory" maxlength="45" id="txtNameCategory" type="text" placeholder="Nombre de la categoría" style="border-radius:20px" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
        <button type="submit" class="btn btn-primary" style="border-radius:20px">Modificar</button>
      </div>
      </form>
    </div>
  </div>
  </div>


  <div class="modal fade" id="añadirProfesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir profesiones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?php echo URL; ?>Profesiones/add" method="POST">
        <div class="row">
        <div class="col-md-12">
          <label class="control-label"><b>Nombre <label style="color:red">*<label></b></label>
          <input class="form-control" name="txtProfesionMD" maxlength="45" id="txtProfesionMD" type="text" placeholder="Nombre de la profesión" style="border-radius:20px" required>
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
        <button class="btn btn-primary" type="submit" style="border-radius:20px">Agregar</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="editarProfesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar profesiones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo URL; ?>Profesiones/update" method="POST">
          <input readOnly class="form-control" name="idEditProfesion" type="hidden" id="idEditProfesion" value="">
          <div class="row">
          <div class="col-md-12">
            <label class="control-label"><b>Nombre <label style="color:red">*<label></b></label>
            <input class="form-control" name="txtEditProfesion" maxlength="45" id="txtEditProfesion" style="border-radius:20px" type="text" placeholder="Nombre de la profesión" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:20px">Cerrar</button>
        <button class="btn btn-primary" type="submit" style="border-radius:20px">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>


</div>

<script>
  function getProfessions(id)
  {
    $.ajax({
      url: '<?=URL?>categories/profesionXcategoria',
      type: 'POST',
      dataType: 'JSON',
      data:
      {
        "id":id
      }
    }).done((data)=>{
      $('#profesiones_categorias').empty();
      if(data<=0){
        $("#profesiones_categorias").append("<tr><td>Esta categoría no tiene asociada ninguna profesión.</td></tr>");
      }
      $.each(data, function(index,value){
        console.log(value);

        $("#profesiones_categorias").append("<tr><td><i class='fas fa-angle-double-right'></i> "+ value['nombreProfesion'] +"</td></tr>");
      })
    })
    $('#profesionesxcategoria').modal();
  }
</script>

<script>
  function modalAdd()
  {
    $("#añadirProfesion").modal()
  }
</script>

    <script>
      function editProfesion(id)
      {
        $.ajax({
          url: '<?php echo URL; ?>profesiones/get',
          type: 'POST',
          dataType: 'JSON',
          data:
          {
            "id":id
          }
        }).done((data)=>{
          console.log(data);
          $('#txtEditProfesion').val(data.nombreProfesion),
          $('#idEditProfesion').val(data.idProfesion)
          $("#editarProfesion").modal();
        })
      }
    </script>

    <script>
    function editCategory(id)
    {
      $.ajax({
        url: '<?php echo URL; ?>categories/editCategory',
        type: 'POST',
        dataType: 'JSON',
        data:
        {
          "id":id
        }
      }).done((data)=>{
        $('#txtNameCategory').val(data.nombreCategoria),
        $('#txtCodCategory').val(data.idCategoria_Cursos),
        $("#editCategories").modal();
      })
    }
    </script>


    