<main class="app-content">
      <div class="app-title">
        <div>
          <h1 class="h1"><strong>Sancionados</strong></h1>
        </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            <center><h1>Personas sancionadas</h1></center><br>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>Tipo documento</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Profesión</th>
                    <th>Lugar de trabajo</th>
                    <th>Inicio sanción</th> 
                    <th>Fin sanción</th>                    
                  </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach($traer as $value): ?>
                    <tr>
                        <td><?= $value->nombreTipoDocumento ?></td>
                        <td><?= $value->documentoPersona ?></td>
                        <td><?= $value->nombrePersona ?> <?= $value->apellidoPersona ?></td>                                       
                        <td><?= $value->correoPersona ?></td>
                        <td><?= $value->nombreProfesion?></td>
                        <td><?= $value->lugarProfesion ?></td>
                        <td><?= $value->fechaInicio ?></td>   
                        <td><?= $value->fechaFin ?></td>                     
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
</main>
