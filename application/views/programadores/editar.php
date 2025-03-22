<div class="edit-container">
    <div class="edit-box">
        <h5 class="text-center mb-3">Editar Programador</h5>
            
            <?php if (!empty($dev->foto)): ?>
            <div align="center">
            <img src="<?php echo base_url('assets/fotos_perfil/'.$dev->foto); ?>" alt="Sin Fotografia" class="img-thumbnail mt-2" width="70">
            </div>
            <?php endif; ?>
   
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger" style="font-size:12px">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>

        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('programador/actualizar/'.$dev->id); ?>">

            <div class="mb-3">
                <label for="foto" class="form-label">Fotografía</label>
                <input type="file" class="form-control" name="foto" id="foto" accept=".jpg,.jpeg,.png,.gif">


            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value('nombre', $dev->nombre); ?>" required>
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= set_value('apellidos', $dev->apellidos); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email', $dev->email); ?>" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?= set_value('telefono', $dev->telefono); ?>" required>
            </div>

            <div class="mb-3">
                <label for="tecnologias" class="form-label">Seleccione una o varias Tecnologías</label>
                <select class="form-multi-select" id="tecnologias" name="tecnologias[]" multiple data-coreui-search="global">
                    <?php foreach ($tecnologias as $tecno): 
                        $selected = (in_array($tecno->id, $tecnologias_asignadas)) ? 'selected' : ''; 
                    ?>
                        <option value="<?= $tecno->id; ?>" <?= $selected; ?>><?= $tecno->tecnologia; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
            <a href="<?php echo base_url("programador"); ?>" class="btn btn-secondary w-100 mt-2">Cancelar</a>
        </form>
    </div>
</div>
