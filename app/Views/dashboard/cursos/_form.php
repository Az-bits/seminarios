    <div class="row">
        <!-- <input hidden type="text" name="id" value="<= $curso['id_facilitador'] ?>"> -->
        <div class="col-md-4 mb-3">
            <label for="nombre_curso" class="form-label">Nombre del curso</label>
            <input type="text" name="nombre_curso" class="form-control" id="nombre_curso" aria-describedby="emailHelp" value="<?= old('nombre_curso', $curso['nombre_curso']) ?>">
            <div id="emailHelp" class="form-text">Cedula de identidad sin extención</div>
        </div>
        <div class="col-md-2 mb-3">
            <label for="modalidad" class="form-label">Modalidad</label>
            <select class="form-select" aria-label="Default select example" name="modalidad" id="modalidad">
                <option value="" disabled selected hidden>Seleccione...</option>
                <option <?= old('modalidad', $curso['modalidad']) === 'VIRTUAL' ? "selected" : '' ?> value="VIRTUAL">Virtual</option>
                <option <?= old('modalidad', $curso['modalidad']) === 'PRESENCIAL' ? "selected" : '' ?> value="PRESENCIAL">Presencial</option>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input min=0 type="number" name="precio" class="form-control" id="precio" aria-describedby="emailHelp" value="<?= round(intval(old('precio', $curso['precio']))) ?>">
            <div id="emailHelp" class="form-text">Para cedulas duplicadas</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="id_facilitador" class="form-label">Facilitadores</label>
            <select class="form-select" aria-label="Default select example" name="id_facilitador" id="id_facilitador">
                <option value="" disabled selected hidden>Seleccione...</option>
                <?php foreach ($facilitadores as $key => $value) : ?>
                    <!-- <option <= old('id_facilitador') ===  $value['id_facilitador'] ? "selected" : '' ?> value="<= $value['id_facilitador'] ?>"><= $value['nombre_facilitador'] ?> <= $value['ci'] ?></option> -->
                    <option <?= old('id_facilitador', $curso['id_facilitador']) ===  $value['id_facilitador'] ? "selected" : '' ?> value="<?= $value['id_facilitador'] ?>"><?= $value['nombre_facilitador'] ?> <?= $value['ci'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="/cursos" class="btn btn-warning"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary ws-120 ms-2"><i class="fa-solid fa-floppy-disk"></i> <?= $textButton ?></button>
    </div>