<?= $validation->listErrors() ?>
<div class="row d-flex justify-content-center">
    <!-- <form action='<= site_url("facilitadores/" . $facilitador['id_facilitador']) ?>' method="POST" enctype="multipart/form-data"> -->
    <form action='/cursos/update/<?= $curso['id_curso'] ?>' method="POST" enctype="multipart/form-data">
        <?= view('dashboard/cursos/_form', ['textButton' => 'Actualizar']) ?>
    </form>
</div>