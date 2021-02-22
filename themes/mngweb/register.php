<? $v->layout('_theme', ['fullheight' => true]) ?>

<article class="py-5">
    <div class="container">
        <header class="text-center mb-5">
            <h1 class="text-uppercase">Cadastre-se e aproveite nossa plataforma</h1>
            <p class="m-0">Já está cadastrado? <a href="#">Fazer login</a></p>
        </header>

        <div class="row">
            <div class="col-12 offset-sm-1 col-sm-10 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6">

                <form class="shared_form" action="<?= url('/cadastro') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_input() ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputFirstName"><i class="fas fa-user"></i>Primeiro nome:</label>
                            <input type="text" name="firstName" value="<?= (!empty($data) ? $data->firstName : '') ?>" class="form-control" id="inputFirstName" placeholder="Ex. Marcelo" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastName"><i class="fas fa-user-plus"></i>Último nome:</label>
                            <input type="text" name="lastName" value="<?= (!empty($data) ? $data->lastName : '') ?>" class="form-control" id="inputLastName" placeholder="Ex. Tomazelli" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBirthdate"><i class="far fa-calendar-alt"></i>Data de nascimento:</label>
                        <input type="text" name="birthdate" value="<?= (!empty($data) ? $data->birthdate : '') ?>" class="form-control mask_date" id="inputBirthdate" placeholder="Ex. 11/11/1111" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail"><i class="fas fa-envelope"></i>E-mail:</label>
                        <input type="email" name="email" value="<?= (!empty($data) ? $data->email : '') ?>" class="form-control" id="inputEmail" placeholder="Ex. seuemail@dominio.com" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword"><i class="fas fa-key"></i>Senha:</label>
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Digite uma senha" minlength="<?= CONF_PASSWORD_MIN_LEN ?>" maxlength="<?= CONF_PASSWORD_MAX_LEN ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPasswordRe"><i class="fas fa-key"></i>Confirme a senha:</label>
                            <input type="password" name="passwordRe" class="form-control" id="inputPasswordRe" placeholder="Digite a senha novamente" minlength="<?= CONF_PASSWORD_MIN_LEN ?>" maxlength="<?= CONF_PASSWORD_MAX_LEN ?>" required>
                        </div>
                    </div>

                    <? if (!empty($message)): ?>
                        <?= $message ?>
                    <? endif; ?>

                    <button type="submit" class="btn btn-lg btn-primary w-100">Cadastrar</button>
                </form>

                <p class="px-5 mt-3 text-center">Ao se cadastrar estará aceitando nossos <a href="#">Termos de Uso</a>. Leia também o <a href="#">Aviso Legal</a>.</p>
            </div>
        </div>
    </div>
</article>
