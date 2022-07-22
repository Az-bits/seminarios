    <div class="row justify-content-center d-flex">
        <div class="col-md-4 mb-3">
            <label for="id_mae_capacitacion" class="form-label">Cursos Disponibles</label>
            <select class="form-select" aria-label="Default select example" name="id_mae_capacitacion" id="id_mae_capacitacion">
                <option value="" disabled selected hidden>Seleccione...</option>
                <?php foreach ($capacitaciones as $key => $value) : ?>
                    <option <?= old('id_mae_capacitacion', $detCapacitaciones['id_det_capacitacion']) ===  $value['id_mae_capacitacion'] ? "selected" : '' ?> value="<?= $value['id_mae_capacitacion'] ?>"><?= $value['nombre_curso'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="id_participante" class="form-label">Participantes</label>
            <select class="form-select" aria-label="Default select example" name="id_participante" id="id_participante">
                <option value="" disabled selected hidden>Seleccione...</option>
                <?php foreach ($participantes as $key => $value) : ?>
                    <option <?= old('id_participante', $detCapacitaciones['id_participante']) ===  $value['id_participante'] ? "selected" : '' ?> value="<?= $value['id_participante'] ?>"><?= $value['nombre_participante'] ?> <?= $value['ci'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="/capacitaciones/inscripciones" class="btn btn-warning"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary ws-120 ms-2"><i class="fa-solid fa-floppy-disk"></i> <?= $textButton ?></button>
    </div>