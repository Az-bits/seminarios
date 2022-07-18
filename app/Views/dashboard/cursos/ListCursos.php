<div class="d-flex justify-content-end">
    <a href="/cursos/new" class="btn btn-primary ws-100"><i class="fa-solid fa-plus"></i> Crear</a>
</div>
<table class="table table-bordered border-primary mt-1 <?= !$cursos ? 'mb-0' : '' ?>">
    <thead>
        <tr class="tb-primary">
            <th scope="col">Nro</th>
            <th scope="col">Nombre</th>
            <th scope="col">Modalidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Facilitador</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cursos as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $value['id_curso'] ?></th>
                <td><?= $value['nombre_curso'] ?></td>
                <td><?= $value['modalidad'] ?></td>
                <td><?= round($value['precio']) ?></td>
                <td><?= $value['nombre_facilitador'] ?></td>
                <td>
                    <form action="/cursos/delete/<?= $value['id_curso'] ?>" method="POST">
                        <button class="btn btn-danger btn-sm float-end ms-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash "></i></button>
                    </form>
                    <a class="btn btn-primary btn-sm float-end " href="/cursos/edit/<?= $value['id_curso'] ?>" data-bs-toggle="tooltip" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php if (!$cursos) : ?>
    <div class="border border-solid" style="border-color: rgb(13 110 253)!important;">
        <h5 class="text-center">Sin datos</h5>
    </div>
<?php endif ?>

<?= $pager->Links() ?>