
    <div class="edit-container">
        <div class="edit-box">
            <h5 class="text-center mb-3">Agregar Programador</h5>
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" style="font-size:12px">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('programador/guardar'); ?>">

                <div class="mb-3">
                    <label for="foto" class="form-label">Fotografía</label>
                    <input type="file" class="form-control" name="foto" id="foto">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value("nombre"); ?>" >
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= set_value("apellidos"); ?>" >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= set_value("email"); ?>" >
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="<?= set_value("telefono"); ?>" >
                </div>
                <div class="mb-3">
                    <label for="tech" class="form-label">Seleccione una o varias Tecnologías</label>

                <select class="form-multi-select" id="tecnologias" name="tecnologias[]" multiple data-coreui-search="global">
                    <?php 
                    $tecnologias_seleccionadas = set_value('tecnologias', []); // Aseguramos que sea un array
                    
                    foreach ($tecnologias as $tecno): 
                        $selected = (in_array($tecno->id, $tecnologias_seleccionadas)) ? 'selected' : ''; 
                    ?>
                        <option value="<?= $tecno->id; ?>" <?= $selected; ?>><?= $tecno->tecnologia; ?></option>
                    <?php endforeach; ?>    
                </select>



                </div>
                <button type="submit" class="btn btn-success w-100">Guardar Programador</button>
                <a href="<?php echo base_url("programador");?>" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            </form>
        </div>
    </div>

