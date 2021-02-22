<? $v->layout('_theme') ?>

<article class="admin_users">
    <div class="container">
        <header class="mb-5">
            <h1 class="text-uppercase">Lista de usuários</h1>
        </header>
        <div class="admin_users_board">
            <form class="shared_form" action="<?= url('/admin/usuarios') ?>" method="POST"  enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-12 col-md-7 col-xl-8 mb-2 mb-md-0 ">
                        <label class="sr-only" for="inputNameEmail">Nome ou e-mail:</label>
                        <input type="text" data-search="true" name="nameEmail" value="<?= (!empty($search) ? $search->nameEmail : '') ?>" class="form-control" id="inputNameEmail" placeholder="Nome ou e-mail...">
                    </div>
                    <div class="col-9 col-md-4 col-xl-3">
                        <label class="sr-only" for="inputRegistered">Resgistro em:</label>
                        <input type="text" data-search="true" name="registeredAt" value="<?= (!empty($search) ? $search->registeredAt : '') ?>" class="form-control mask_month" id="inputRegistered" placeholder="Ano ou mês de registro..." minlength="4"  maxlength="6">
                    </div>
                    <div class="col-3 col-md-1 col-xl-1">
                        <button class="btn btn-outline-primary text-center h-100 w-100" type="submit"><i class="fas fa-search m-0"></i></button>
                    </div>
                </div>
            </form>

            <div class="ajax_page_message my-3">
                <? if (!empty($message)): ?>
                    <?= $message ?>
                <? endif; ?>
            </div>

            <div class="admin_users_list mt-3">
                <? if (!empty($users)): ?>
                    <? foreach ($users as $i => $user): ?>
                        <div class="admin_users_user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="<?= shared('/imgs/user.png') ?>" alt="<?= "{$user->first_name} {$user->last_name}" ?>" class="img_photo admin_users_user_photo">
                                <div class="d-flex flex-column justify-content-between mx-2">
                                    <p class="admin_users_user_name p-0 m-0"><?= "{$user->first_name} {$user->last_name}" ?></p>

                                    <div class="admin_users_user_infos mt-2">
                                        <p class="p-0 m-0" title="E-mail:"><i class="fas fa-envelope"></i><?= $user->email ?></p>
                                        <p class="p-0 m-0" title="Registro em:"><i class="far fa-calendar-alt"></i><?= $user->registered_at ?></p>
                                    </div>
                                </div>
                            </div>
                            <span class="admin_users_user_remove" data-rmvuser="<?= url('/admin/remove-user') ?>" data-user="<?= $user->id ?>"><i class="fas fa-times-circle"></i></span>
                        </div>

                        <? if ($i < (count($users) - 1)): ?>
                            <div class="admin_users_divisor"></div>
                        <? endif; ?>
                    <? endforeach; ?>
                <? else: ?>
                    <p class="text-center mt-3 admin_users_list_empty">Nenhum usuário encontrado.</p>
                <? endif; ?>
            </div>
        </div>
    </div>
</article>
