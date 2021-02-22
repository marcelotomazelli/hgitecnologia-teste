<? $v->layout('_theme') ?>

<section class="web_home_cta py-5" style="background-image: url(<?= theme('/assets/img/home-cta.jpg') ?>)">
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide web_home_cta_carousel" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <article class="web_home_cta_item d-flex flex-column justify-content-center px-3 mx-5">
                        <header class="text-center mb-5">
                            <h2 class="text-light">Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Omnis, hic.</h2>
                        </header>
                        <p class="text-center mt-5">
                            <a href="<?= url('/cadastro') ?>" class="btn btn-lg btn-primary text-uppercase px-5">Cadastre-se</a>
                        </p>
                    </article>
                </div>
                <div class="carousel-item">
                    <article class="web_home_cta_item d-flex flex-column justify-content-center px-3 mx-5">
                        <header class="text-center">
                            <h2 class="text-light">Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Omnis, hic. Voluptate in exercitationem illo modi.</h2>
                        </header>
                    </article>
                </div>
                <div class="carousel-item">
                    <article class="web_home_cta_item d-flex flex-column justify-content-center px-3 mx-5">
                        <header class="text-center">
                            <h2 class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aperiam pariatur reiciendis.</h2>
                        </header>
                    </article>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
    </div>
</section>

<section class="web_home_about py-5">
    <div class="container">
        <header class="mb-5">
            <h1>Conheça a plataforma</h1>
        </header>
        
        <div class="row d-flex justify-content-center">
            <div class="col-sm-3">
                <article class="web_home_about_card d-flex flex-column">
                    <div class="web_home_card_icon mx-auto mb-2">
                        <img src="<?= theme('/assets/img/easy.png') ?>" alt="" class="img-fluid">
                    </div>
                    <header class="text-center">
                        <h2 class="web_home_card_title">Lorem ipsum dolor</h2>
                    </header>
                    <p class="web_home_cart_desc text-center text-secondary">Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Illum possimus optio autem.</p>
                </article>
            </div>
            <div class="offset-sm-1 col-sm-3">
                <article class="web_home_about_card d-flex flex-column">
                    <div class="web_home_card_icon mx-auto mb-2">
                        <img src="<?= theme('/assets/img/fast.png') ?>" alt="" class="img-fluid">
                    </div>
                    <header class="text-center">
                        <h2 class="web_home_card_title">Lorem ipsum dolor</h2>
                    </header>
                    <p class="web_home_cart_desc text-center text-secondary">Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Illum possimus optio autem.</p>
                </article>
            </div>
            <div class="offset-sm-1 col-sm-3">
                <article class="web_home_about_card d-flex flex-column">
                    <div class="web_home_card_icon mx-auto mb-2">
                        <img src="<?= theme('/assets/img/genius.png') ?>" alt="" class="img-fluid">
                    </div>
                    <header class="text-center">
                        <h2 class="web_home_card_title">Lorem ipsum dolor</h2>
                    </header>
                    <p class="web_home_cart_desc text-center text-secondary">Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Illum possimus optio autem.</p>
                </article>
            </div>
        </div>
    </div>
</section>
