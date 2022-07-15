
<?= $validation->listErrors(); ?>
 <div class="row d-flex justify-content-center">
     <form action="<?=site_url('facilitadores')?>" method="post" enctype="multipart/form-data">
         <?= view('dashboard/facilitador/_form', ['textButton' => 'Crear']) ?>
     </form>
 </div>