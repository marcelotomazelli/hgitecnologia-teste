<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicação simples para avaliação de estágio na HGI Tecnologia">
    <title>Management - Administrador</title>
    <link rel="shortcut icon" href="<?= shared('/imgs/favicon.ico') ?>">

    <!-- Bootstrap 4 Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome 5 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <!-- App Styles -->
    <link rel="stylesheet" href="<?= theme('/assets/css/style.css', CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?= shared('/styles/styles.css') ?>">
</head>
<body>

    <header class="admin_header bg-dark">
        <nav class="
            navbar navbar-expand-lg navbar-dark
            d-lg-flex flex-lg-column px-lg-0
            ">
            <a class="navbar-brand text-lg-center m-lg-0" href="./">
                <img src="<?= shared('/imgs/brand.png') ?>" alt="Management">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars header_toggle_ico"></i>
            </button>
            <div class="collapse navbar-collapse flex-lg-column w-100" id="adminNav">
                <? $user = \Source\Models\Auth::user('first_name') ?>

                <div class="admin_header_admin w-100 px-lg-3 d-flex align-items-center flex-lg-column mt-2 my-lg-3">
                    <div class="d-lg-flex justify-content-lg-center mr-2 mr-lg-0 mb-lg-2">
                        <img src="<?= shared('/imgs/user.png') ?>" alt="Administrador <?= $user->first_name ?>" class="admin_header_admin_photo img-fluid img_photo">
                    </div>
                    <div class="p-0">
                        <p class="admin_header_admin_name m-0 text-lg-center"><?= $user->first_name ?></p>
                    </div>
                </div>

                <ul class="navbar-nav d-block w-100 my-2">
                    <li class="nav-item active">
                        <a class="nav-link px-4 active" href="<? url('/admin/usuarios') ?>"><i class="fas fa-users"></i>Usuários</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="admin_main py-5 px-3 px-lg-4">
        <?= $v->section('content'); ?>
    </main>

    <!-- Bootstrap 4 and App Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- App Scripts -->
    <script src="<?= shared('/scripts/jquery.mask.js') ?>"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_ADMIN) ?>"></script>
</body>
</html>

