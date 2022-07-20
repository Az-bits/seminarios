<div class="d-flex justify-content-end">
    <a href="/facilitadores/new" class="btn btn-primary ws-100"><i class="fa-solid fa-plus"></i> Crear</a>
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
                <td>
                    <form action="/facilitadores/delete/<?= $value['id_facilitador'] ?>" method="POST">
                        <button <?= $value['cantidad'] == 0 ?: "disabled"  ?> class="btn btn-danger btn-sm float-end ms-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $value['cantidad'] == 0 ? 'Eliminar' : 'Facilitador referenciado' ?>"><i class="fa-solid fa-trash "></i></button>
                    </form>
                    <a class="btn btn-primary btn-sm float-end " href="/facilitadores/edit/<?= $value['id_facilitador'] ?>" data-bs-toggle="tooltip" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<?= $pager->Links() ?>