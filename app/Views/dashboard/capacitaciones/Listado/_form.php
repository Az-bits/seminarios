    <div class="row">
        <!-- <input hidden type="text" name="id" value="<= $curso['id_facilitador'] ?>"> -->

        <div class="col-md-4 mb-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select class="form-select" aria-label="Default select example" name="id_curso" id="id_curso">
                <option value="" disabled selected hidden>Seleccione...</option>
                <?php foreach ($cursos as $key => $value) : ?>
                    <!-- <option <= old('id_facilitador') ===  $value['id_facilitador'] ? "selected" : '' ?> value="<= $value['id_facilitador'] ?>"><= $value['nombre_facilitador'] ?> <= $value['ci'] ?></option> -->
                    <option <?= old('id_curso', $capacitaciones['id_curso']) ===  $value['id_curso'] ? "selected" : '' ?> value="<?= $value['id_curso'] ?>"><?= $value['nombre_curso'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="fecha_ini" class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_ini" class="form-control" id="fecha_ini" aria-describedby="emailHelp" value="<?= old('fecha_ini', $capacitaciones['fecha_ini']) ?>">
            <div id="emailHelp" class="form-text">Fecha Inicio</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" aria-describedby="emailHelp" value="<?= old('fecha_fin', $capacitaciones['fecha_fin']) ?>">
            <div id="emailHelp" class="form-text">Fecha Fin</div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="/capacitaciones/listado" class="btn btn-warning"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary ws-120 ms-2"><i class="fa-solid fa-floppy-disk"></i> <?= $textButton ?></button>
    </div>