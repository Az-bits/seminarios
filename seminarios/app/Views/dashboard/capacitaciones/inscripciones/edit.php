<?= $validation->listErrors() ?>
<div class="row d-flex justify-content-center">
    <!-- <form action='<= site_url("facilitadores/" . $facilitador['id_facilitador']) ?>' method="POST" enctype="multipart/form-data"> -->
    <form action='/capacitaciones/inscripciones/update/<?= $detCapacitaciones['id_det_capacitacion'] ?>' method="POST" enctype="multipart/form-data">
        <?= view('dashboard/capacitaciones/inscripciones/_form', ['textButton' => 'Actualizar']) ?>
    </form>
</div>