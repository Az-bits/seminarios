<?= $validation->listErrors() ?>
<div class="row d-flex justify-content-center">
    <form action='/participantes/update/<?= $participante['id_participante'] ?>' method="POST" enctype="multipart/form-data">
        <?= view('dashboard/participantes/_form', ['f' => $participante, 'textButton' => 'Actualizar']) ?>
    </form>
</div>