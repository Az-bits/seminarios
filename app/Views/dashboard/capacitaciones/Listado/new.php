    <?= $validation->listErrors() ?>
    <div class="row d-flex justify-content-center">
        <form class="form" action="create" method="POST" enctype="multipart/form-data">
            <?= view('dashboard/capacitaciones/listado/_form', ['textButton' => 'Crear']) ?>
        </form>
    </div>