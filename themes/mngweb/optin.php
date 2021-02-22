<? $v->layout('_theme', ['fullheight' => true]) ?>

<article class="h-100 py-5">
    <div class="container h-100">
        <div class="h-100 d-flex flex-column justify-content-center">
            <header class="text-center">
                <h1 class="<?= (!empty($titleClass) ? $titleClass : '') ?>"><?= $title ?></h1>
            </header>

            <? if (!empty($image) || !empty($description)): ?>
                <div class="row mt-4">
                    <? if (!empty($image)): ?>
                        <div class="offset-md-3 col-md-6 text-center mb-3">
                            <img src="<?= $image ?>" alt="<?= $title ?>" class="img-fluid">
                        </div>
                    <? endif; ?>
                    <? if (!empty($description)): ?>
                        <p class="offset-md-2 col-md-8 text-center"><?= $description ?></p>
                    <? endif; ?>
                </div>
            <? endif; ?>

            <? if (!empty($actionLink)): ?>
                <div class="mt-4 text-center">
                    <a href="<?= $actionLink ?>" class="btn btn-lg btn-outline-primary px-5"><?= $actionDesc ?></a>
                </div>
            <? endif; ?>            
        </div>
    </div>
</article>
