<div class="d-flex justify-content-end">
    <a href="/facilitadores/new" class="btn btn-primary ws-100">Crear</a>
</div>
<table class="table table-bordered border-primary mt-1">
    <thead>
        <tr class="tb-primary">
            <th scope="col">Nro</th>
            <th scope="col">Cedula Identidad</th>
            <th scope="col">Nombre</th>
            <th scope="col">Paterno</th>
            <th scope="col">Materno</th>
            <th scope="col">Celular</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($facilitador as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $value['id_facilitador'] ?></th>
                <td><?= $value['ci'] ?></td>
                <td><?= $value['nombres'] ?></td>
                <td><?= $value['paterno'] ?></td>
                <td><?= $value['materno'] ?></td>
                <td><?= $value['celular'] ?></td>
                <td><?= $value['correo'] ?></td>
                <td>editar/eliminar</td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<?= $pager->Links() ?>