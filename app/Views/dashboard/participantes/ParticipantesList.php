<div class="d-flex justify-content-end">
    <a href="/participantes/new" class="btn btn-primary ws-100"><i class="fa-solid fa-plus"></i> Crear</a>
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
        <?php foreach ($participantes as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $value['id_participante'] ?></th>
                <td><?= $value['ci'] ?></td>
                <td><?= $value['nombres'] ?></td>
                <td><?= $value['paterno'] ?></td>
                <td><?= $value['materno'] ?></td>
                <td><?= $value['celular'] ?></td>
                <td><?= $value['correo'] ?></td>
                <td>
                    <form action="/participantes/delete/<?= $value['id_participante'] ?>" method="POST">
                        <button class="btn btn-danger btn-sm float-end ms-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash "></i></button>
                    </form>
                    <a class="btn btn-primary btn-sm float-end " href="/participantes/edit/<?= $value['id_participante'] ?>" data-bs-toggle="tooltip" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<?= $pager->Links() ?>