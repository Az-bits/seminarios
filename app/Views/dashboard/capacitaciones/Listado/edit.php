<?= $validation->listErrors() ?>
<div class="row d-flex justify-content-center">
    <form action='/capacitaciones/listado/update/<?= $capacitaciones['id_mae_capacitacion'] ?>' method="POST" enctype="multipart/form-data">
        <?= view('dashboard/capacitaciones/listado/_form', ['textButton' => 'Actualizar']) ?>
    </form>
</div>