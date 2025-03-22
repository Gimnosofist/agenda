<!-- Contenedor -->
    <div class="table-container">
        <div class="table-box">
            <h3 class="text-center mb-3">Listado de Programadores</h3>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fotografía</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Tecnologias</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($devs as $dev): ?>
                    <tr>
                        <td><?php echo $dev->id ?></td>
                        <td><?php echo $dev->path_foto ?></td>
                        <td><?php echo $dev->nombre ?></td>
                        <td><?php echo $dev->apellidos ?></td>
                        <td><?php echo $dev->email ?></td>
                        <td><?php echo $dev->tecnologias ?></td>

                        <td>
                            <a class="btn btn-success w-10 btn-sm" href="<?php echo base_url("programador/editar/".$dev->id); ?>">Editar</a>

                            <a class="btn btn-danger w-10 btn-sm" href="<?php echo base_url("programador/elimiar/".$dev->id); ?>">Eliminar</a>


                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

