<?= $validation->listErrors() ?>
<div class="row d-flex justify-content-center">
    <!-- <form action='<= site_url("facilitadores/" . $facilitador['id_facilitador']) ?>' method="POST" enctype="multipart/form-data"> -->
    <form action='/facilitadores/update/<?= $facilitador['id_facilitador'] ?>' method="POST" enctype="multipart/form-data">
        <?= view('dashboard/facilitador/_form', ['f' => $facilitador, 'textButton' => 'Actualizar']) ?>
    </form>
</div>