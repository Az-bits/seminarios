<div class="d-flex justify-content-end">
    <a href="/capacitaciones/listado/new" class="btn btn-primary ws-100"><i class="fa-solid fa-plus"></i> Crear</a>
</div>
<table class="table table-bordered border-primary mt-1 <?= !$capacitaciones ? 'mb-0' : '' ?>">
    <thead>
        <tr class="tb-primary">
            <th scope="col">Nro</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha inicio</th>
            <th scope="col">Fecha fin</th>
            <th scope="col">Inscritos</th>

            <!-- <th scope="col">Modalidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Facilitador</th> -->
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($capacitaciones as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $value['id_mae_capacitacion'] ?></th>
                <td><?= $value['nombre_curso'] ?></td>
                <td><?= $value['fecha_ini'] ?></td>
                <td><?= $value['fecha_fin'] ?></td>
                <td><?= $value['cantidad'] ?></td>
                <td class="d-flex justify-content-center">
                    <a class="btn btn-primary btn-sm" href="/capacitaciones/listado/edit/<?= $value['id_mae_capacitacion'] ?>" data-bs-toggle="tooltip" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                    <form action="/capacitaciones/listado/delete/<?= $value['id_mae_capacitacion'] ?>" method="POST">
                        <?php if ($value['cantidad'] != 0) : ?>
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="El registro se encuentra referenciado.">
                                <button disabled tabindex="0" class="btn btn-danger btn-sm  ms-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash "></i></button>
                            </span>
                        <?php else : ?>
                            <button class="btn btn-danger btn-sm  ms-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash "></i></button>
                        <?php endif ?>
                    </form>
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