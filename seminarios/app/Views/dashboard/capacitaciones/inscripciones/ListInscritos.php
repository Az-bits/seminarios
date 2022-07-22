<div class="d-flex justify-content-end">
    <a href="/capacitaciones/inscripciones/new" class="btn btn-primary ws-100"><i class="fa-solid fa-plus"></i> Crear</a>
</div>
<table class="table table-bordered border-primary mt-1 <?= !$capacitaciones ? 'mb-0' : '' ?>">
    <thead>
        <tr class="tb-primary">
            <th scope="col">Nro</th>
            <th scope="col">Curso</th>
            <th scope="col">Participante</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($capacitaciones as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $value['id_det_capacitacion'] ?></th>
                <td><?= $value['nombre_curso'] ?></td>
                <td><?= $value['nombre_participante'] ?></td>
                <td>
                    <form action="/capacitaciones/inscripciones/delete/<?= $value['id_det_capacitacion'] ?>" method="POST">
                        <button class="btn btn-danger btn-sm float-end ms-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash "></i></button>
                    </form>
                    <a class="btn btn-primary btn-sm float-end " href="/capacitaciones/inscripciones/edit/<?= $value['id_det_capacitacion'] ?>" data-bs-toggle="tooltip" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php if (!$capacitaciones) : ?>
    <div class="border border-solid" style="border-color: rgb(13 110 253)!important;">
        <h5 class="text-center">Sin datos</h5>
    </div>
<?php endif ?>

<?= $pager->Links() ?>