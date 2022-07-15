    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="ci" class="form-label">Cedula de Identidad</label>
            <input type="text" name="ci" class="form-control" id="ci" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Cedula de identidad sin extención</div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control" id="nombres" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Nombre</div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="paterno" class="form-label">Paterno</label>
            <input type="text" name="paterno" class="form-control" id="paterno" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Apellido paterno</div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="materno" class="form-label">Materno</label>
            <input type="text" name="materno" class="form-control" id="materno" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Apellido materno</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="genero" class="form-label">Genero</label>
            <select class="form-select" aria-label="Default select example" name="genero" id="genero">
                <option selected hidden>Seleccione...</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" name="celular" class="form-control" id="celular" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Número de Celular</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="text" name="correo" class="form-control" id="correo" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Correo electronico</div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="/facilitadores" class="btn btn-warning">Cancelar</a>
        <button type="submit" class="btn btn-primary ws-100 ms-2"><?= $textButton ?></button>
    </div>