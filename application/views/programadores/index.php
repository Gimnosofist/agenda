<?php  $username = $this->session->userdata('username');?>
<style type="text/css">
    .api-box {
        display: flex;           
        justify-content: center; 
        align-items: center;     
        max-width: 100%;         
        max-height: 100%;        
        overflow: hidden;        
    }

    .api-box img {
        max-width: 100%;       
        height: auto;          
        object-fit: contain;   
    }
</style>
<!-- Contenedor -->
<div class="table-container">
    <div class="table-box">
        <h3 class="text-center mb-3">Listado de Programadores</h3>
        <h5 class="text-center mb-3">Bienvenido! <?php echo $username;?></h5>

<a  href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportes-modal" title="Reportes" onclick="getData()">Reportes</a>


<a  href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#api-modal" title="Reportes" onclick="api()">API ?</a>

<a  href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#erd-modal" title="Reportes" onclick="api()">ERD</a>


                <?php if($this->session->flashdata("error")):?>
              <div class="alert alert-danger">
                <p><?php echo $this->session->flashdata("error")?></p>
              </div>
            <?php endif; ?>

        
        <div class="table-responsive">
            <table id="programadores" class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fotografía</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Tecnologías</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($devs as $dev): ?>
                    <tr>
                        <td><?php echo $dev->id ?></td>
                        <td><img src="<?php echo base_url("assets/fotos_perfil/").$dev->foto ?>" alt="Foto"></td>
                        <td><?php echo $dev->nombre ?></td>
                        <td><?php echo $dev->apellidos ?></td>
                        <td><?php echo $dev->email ?></td>
                        <td><?php echo $dev->tecnologias ?></td>

                        <td>
                            <a class="btn btn-success w-10 btn-sm" href="<?php echo base_url("programador/editar/".$dev->id); ?>">Editar</a>
                            <a class="btn btn-danger w-10 btn-sm" href="<?php echo base_url("programador/eliminar/".$dev->id); ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="reportes-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filtrar Resultados</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="api-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Metodos API</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            
            <div>            
            <p>Metodo GET <code>/agenda </code> Regresa Todo el Listado de los programadores.</p>
            <p>
                <ul>
                    <li>En Local http://localhost/app/api/agenda</li>

                </ul>
            </p>
            </div>


            <div class="col-md-12 api-box">
                <img style="max-width: 1000px; height: auto;" src="<?php echo base_url('apiGET01.png'); ?>" alt="Imagen de Request Api">
            </div>
            <hr>
            <div>            
            <p>Metodo GET <code>/agenda_tech/PHP</code> Regresa los programadores que tienen determinada tecnologia.</p>
            <p>
                <ul>
                    <li>En Local http://localhost/app/api/agenda_tech/JAVA</li>

                </ul>
            </p>
            </div>


            <div class="col-md-12 api-box">
                <img style="max-width: 1000px; height: auto;"  src="<?php echo base_url('apiGET02.png'); ?>" alt="Imagen de Request Api">
            </div>






        </div>
    </div>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="erd-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ERD</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row">
        <div class="row">
        <div class="col-md-12">
            
            <div>            
            <p>Diagrama Base de Datos en MySql.</p>
            </div>


            <div class="col-md-12 api-box">
                <img style="max-width: 1000px; height: auto;" src="<?php echo base_url('er.png'); ?>" alt="Imagen de Request Api">
            </div>
            <hr>






        </div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
