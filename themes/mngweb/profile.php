<? $v->layout('_theme', ['fullheight' => true]) ?>

<article class="py-5">
    <div class="container">
        <header class="row mb-5">
            <div class="col-12 col-md-2 mb-3 mb-md-0 d-flex align-items-center justify-content-center">
                <img src="<?= shared('imgs/user.png') ?>" alt="<?= "{$user->first_name} {$user->last_name}" ?>" class="img-fluid img_photo web_profile_image">
            </div>
            <div class="col-12 col-md-8 d-flex flex-column align-items-center align-items-md-start justify-content-md-center">
                <h1 class="text-center text-md-right"><?= "{$user->first_name} {$user->last_name}" ?></h1>
                <p class="text-center text-md-right">Registrado(a) em: <?= $user->registered_at ?></p>
            </div>
        </header>

        <form class="shared_form" action="<?= url('/perfil') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_input() ?>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputFirstName">Primeiro nome:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basicFirstName"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="firstName" value="<?= $user->first_name ?>"  id="inputFirstName" class="form-control" aria-label="inputFirstName" aria-describedby="basicFirstName" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputLastName">Último nome:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basicLastName"><i class="fas fa-user-plus"></i></span>
                        </div>
                        <input type="text" name="lastName" value="<?= $user->last_name ?>" id="inputLastName" class="form-control" aria-label="inputLastName" aria-describedby="basicLastName" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">E-mail:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basicEmail"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" value="<?= $user->email ?>" id="inputEmail" class="form-control" aria-label="inputEmail" aria-describedby="basicEmail" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputBirthdate">Data de nascimento:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basicBirthdate"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" name="birthdate" value="<?= $user->birthdate ?>" id="inputBirthdate" class="form-control mask_date" aria-label="inputBirthdate" aria-describedby="basicBirthdate" maxlength="10" required>
                    </div>
                </div>
            </div>

            <? if (!empty($message)): ?>
                <?= $message ?>
            <? endif; ?>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-lg btn-outline-primary px-5"><i class="fas fa-edit"></i>Atualizar</button>
            </div>
        </form>
    </div>
</article>
