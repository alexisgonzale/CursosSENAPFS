<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="far fa-calendar-alt"></i> Publicaciones</h1>
        </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo URL; ?>Publicaciones/indexListar">Listar Publicaciones</a></li>
          <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index">Inicio</a></li>
          </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            <center><h1>Mis Publicaciones</h1></center><br>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>Curso</th>
                    <th>Titulo publicación</th>
                    <th>Distribución horaria</th>
                    <th>Requisitos curso</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                <?php foreach($publications as $value): ?>
                    <tr>
                        <td><?= $value->nombreCurso ?></td>
                        <td><?= $value->tituloPublicacion ?></td>
                        <td><?= $value->distribucionHoraria ?></td>                        
                        <td><?= $value->requisitosCurso ?></td>   
                        <td><?= $value->descripcionPublicacion ?></td> 
                        <td>
                          <?php if($value->img !=null):?>
                            <img width="40%;"" src="<?= URL?>public/imgcursos/<?=$value->img ?>"></td>
                          <?php endif;?>
                          <?php if($value->img == null):?>
                            <p>Esta publicación no contiene ninguna imagen.</p>
                          <?php endif;?>
                          </td>
                        <td>
                          <?php if($value->Estado == 'Inactivo') :?>      
                          <a title="Publicar" href="<?= URL ?>Publicaciones/publicarAnuncio/<?= $value->idPublicacion ?>/<?= $estado = "Activo" ?>"><button class="btn btn-info" type="button" style="border-radius:20px">Publicar</i></button></a>
                          <?php endif;?>
                          <?php if($value->Estado == 'Activo') :?>
                          <span class="badge badge-dark" style="border-radius:20px">Esta publicado</span>
                          <?php endif;?>
                      </td>
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