<?php
// $fullheight = ['register', 'login', 'profile', 'optin', 'error'];
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?= (!empty($fullheight) ? 'web_fullheight' : '') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicação simples para avaliação de estágio na HGI Tecnologia">
    <title>Management - Melhor gerenciador</title>
    <link rel="shortcut icon" href="<?= shared('/imgs/favicon.ico') ?>">

    <!-- Bootstrap 4 Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome 5 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <!-- App Styles -->
    <link rel="stylesheet" href="<?= theme('/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= shared('/styles/styles.css') ?>">
</head>
<body>

    
    <header class="web_header">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand text-center text-md-right" href="./">
                <img src="<?= shared('/imgs/brand.png') ?>" alt="Management" class="web_header_brand">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#webNav" aria-controls="webNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars header_toggle_ico"></i>
            </button>
            <div class="collapse navbar-collapse" id="webNav">
                <ul class="navbar-nav ml-auto my-2 my-md-0">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="<?= url() ?>">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <? $logged = \Source\Models\Auth::user('first_name') ?>
                    <? if ($logged ): ?>
                        <li class="nav-item mt-2 mt-md-0 ml-md-2 active dropdown">
                            <a class="nav-item nav-link px-3 web_header_highlight dropdown-toggle" href="./?content=perfil" id="webNavUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?= $logged->first_name ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="webNavUser">
                                <a class="dropdown-item" href="<?= url('/perfil') ?>"><i class="fas fa-user"></i> Perfil</a>
                                <a class="dropdown-item" href="<?= url('/admin') ?>"><i class="fas fa-cogs"></i> Administrador</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= url('/sair') ?>"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </div>
                        </li>
                    <? else: ?>
                        <li class="nav-item mt-2 mt-md-0">
                            <a class="nav-link px-3" href="<?= url('/login') ?>"><i class="fas fa-sign-in-alt"></i>Login</a>
                        </li>
                        <li class="nav-item mt-2 mt-md-0 ml-md-3">
                            <a class="nav-link px-3 web_header_highlight" href="<?= url('/cadastro') ?>"><i class="fas fa-clipboard"></i>Cadastro</a>
                        </li>
                    <? endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main class="web_main">
        <?= $v->section('content'); ?>
    </main>

    <footer class="web_footer">
        <p class="px-2 py-3 m-0 text-center">Todos os direitos reservados a Marcelo Tomazelli ®</p>
    </footer>

    <!-- Bootstrap 4 and App Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- App Scripts -->
    <script src="<?= shared('/scripts/jquery.mask.js') ?>"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js') ?>"></script>
</body>
</html>
