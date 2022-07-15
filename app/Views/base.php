<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/icon.png" />
    <title>Seminarios</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>

<body>
    <?= $header ?>
    <div class="container mt-2 ">
        <!-- <div class="row vh-100 justify-content-center align-items-center"> -->
        <h1 class="text-center mt-1"><?= $title ?></h1>
        <?= $content ?>
        <!-- </div> -->
    </div>
    <?= $footer ?>
    <script src="<?= base_url('bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src=""></script>
</body>

</html>