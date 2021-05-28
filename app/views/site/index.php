<?php $this->view("site/include/header"); ?>

    <div class="index">
        <div class="container">
            <div class="row">
                <?php if($usuario->nivel == "admin"): ?>
                    <a href="<?= BASE_URL; ?>painel" style="padding-top: 31px;">
                        Painel Administrativo
                    </a>
                <?php endif; ?>

                <?php if(!empty($banners)): ?>
                    <div class="col-md-12 mt-3">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $cont = 1; ?>
                                <?php foreach ($banners as $banner): ?>
                                    <div class="carousel-item <?= ($cont == 1) ? 'active' : ''; ?>">
                                        <img class="d-block w-100" src="<?= BASE_URL; ?>storage/banner/<?= $banner->imagem; ?>" alt="First slide">
                                    </div>
                                    <?php $cont++; ?>
                                <?php endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col"></div>
                <div class="col-md-7">
                    <div class="margin-form centraliza-itens-sem-text" <?= (!empty($banners) ? 'style="margin-top: 59px;"' : ''); ?>>

                        <!-- FORMULARIO -->
                        <form id="pesquisaProduto">
                            <div class="form-group">
                                <div class="text-center mb-4">
                                    <a href="<?= BASE_URL ?>">
                                        <img class="logo" src="<?= BASE_URL ?>assets/theme/site/img/logo-azul.png">
                                    </a>
                                </div>
                                <div class="busca">
                                    <input type="text" name="busca" class="form-control input-busca" id="pesquisa" aria-describedby="busca" placeholder="Encontre os produtos">
                                    <button type="submit" class="btn btn-primary btn-busca">
                                        <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">

                                            <g>
                                                <title>background</title>
                                                <rect fill="none" id="canvas_background" height="402" width="582" y="-1" x="-1"/>
                                            </g>
                                            <g>
                                                <title>Layer 1</title>
                                                <path fill="#ffffff" id="svg_2" d="m31.12,26.879l-7.342,-7.342c-1.095,1.701 -2.541,3.148 -4.242,4.242l7.343,7.342c1.172,1.172 3.071,1.172 4.241,0c1.173,-1.169 1.173,-3.068 0,-4.242z"/>
                                                <path fill="#ffffff" id="svg_3" d="m24,12c0,-6.627 -5.373,-12 -12,-12s-12,5.373 -12,12s5.373,12 12,12s12,-5.373 12,-12zm-12,9c-4.964,0 -9,-4.036 -9,-9c0,-4.963 4.036,-9 9,-9c4.963,0 9,4.037 9,9c0,4.964 -4.037,9 -9,9z"/>
                                                <path fill="#ffffff" id="svg_4" d="m5,12l2,0c0,-2.757 2.242,-5 5,-5l0,-2c-3.86,0 -7,3.142 -7,7z"/>
                                            </g>
                                        </svg>
                                    </button>
                                    <div style="clear: both"></div>
                                </div>
                                <div style="position: relative">
                                    <div class="resultado"></div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted"><a style="color: #204f93; text-decoration: none" href="<?= BASE_URL ?>produtos">Ver todos os produtos</a></small>
                                <a href="<?= BASE_URL ?>servicos" class="btn btn-primary" style="border: none;margin-top: 40px; background: #204f93 !important">
                                   Ver Serviços
                                </a>
                            </div>
                        </form>
                        <!-- FIM >> FORMULARIO -->

                        <!-- MARCAS -->
                        <div class="row mt-5 animate__animated animate__fadeInUp">

                            <?php foreach ($marcas as $marca) : ?>
                                <div class="col-md-4 col-6 centraliza-itens">
                                    <a href="<?= BASE_URL; ?>produtos?c=true&marca=<?= $marca->id_marca ?>">
                                        <img width="100%" src="<?= $marca->logo ?>"  style="margin: 15px 0px;">
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <!-- FIM >> MARCAS -->

                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>

<?php $this->view("site/include/footer") ?>