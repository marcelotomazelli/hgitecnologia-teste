<? $v->layout('_theme', ['fullheight' => true]) ?>

<article class="py-5">
    <div class="container">
        <header class="text-center mb-5">
            <h1 class="text-uppercase">Acesse e utilize nossa plataforma</h1>
            <p class="m-0">Não está cadastrado? <a href="#">Fazer cadastro</a></p>
        </header>

        <div class="row">
            <div class="col-12 offset-sm-1 col-sm-10 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6">
                <?= flash_message() ?>

                <form class="shared_form" action="<?= url('/login') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_input() ?>
                    <div class="form-group">
                        <label for="inputEmail"><i class="fas fa-envelope"></i>E-mail:</label>
                        <input type="email" name="email" value="<?= (!empty($data) ? $data->email : '') ?>" class="form-control" id="inputEmail" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword"><i class="fas fa-key"></i>Senha:</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Digite uma senha"  minlength="<?= CONF_PASSWORD_MIN_LEN ?>" maxlength="<?= CONF_PASSWORD_MAX_LEN ?>" required>
                    </div>

                    <? if (!empty($message)): ?>
                        <?= $message ?>
                    <? endif; ?>

                    <button type="submit" class="btn btn-lg btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</article>
