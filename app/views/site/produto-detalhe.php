<?php $this->view("site/include/header"); ?>

<!-- Tema ===================================================== -->
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/vendor/owl-slider.css"/>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/vendor/slick.css"/>
<link rel="shortcut icon" href="<?= BASE_URL; ?>assets/theme/site/assets/images/favicon.png" />
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/vendor/settings.css"/>

    <!-- CABEÇALHO -->
    <div style="margin-bottom: 100px" class="cabecalho">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img class="logo" src="<?= BASE_URL ?>assets/theme/site/img/logo-azul.png">
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> CABEÇALHO -->

    <!-- CONTEUDO -->
    <div class="wrappage">

        <div class="main-content">
            <div class="row">
                <div class="container">

                    <!-- PRODUTO -->
                    <div class="product-details-content">

                        <!-- IMAGENS -->
                        <div class="col-md-6 col-sm-12 slide-vertical">
                            <div class="slider-for">
                                <?php if (!empty($produto->imagem)) : ?>
                                    <?php if (is_array($produto->imagem)) : ?>
                                        <?php foreach ($produto->imagem as $imagem) : ?>
                                            <div>
                                              <span class="zoom">
                                                <img class="zoom-images" src="<?= $imagem->imagem ?>" alt="<?= $produto->nome ?>">
                                              </span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div>
                                              <span class="zoom">
                                                <img class="zoom-images" src="<?= $produto->imagem ?>" alt="<?= $produto->nome ?>">
                                              </span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="slider-nav">
                                <?php if (!empty($produto->imagem)) : ?>
                                    <?php if (is_array($produto->imagem)) : ?>
                                        <?php foreach ($produto->imagem as $imagem) : ?>
                                            <div>
                                                <img src="<?= $imagem->imagem ?>" alt="<?= $produto->nome ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- FIM >> IMAGENS -->

                        <!-- DETALHES -->
                        <div class="col-md-6 col-sm-12">

                            <!-- DETALHES -->
                            <div class="box-details-info">

                                <div class="product-name">
                                    <h1><?= $produto->nome ?></h1>
                                </div>

                                <div class="wrap-price">
                                     <p class="price-old" style="display: none" >R$ <?= number_format($produto->valorVenda, 2, ',', '.'); ?></p>
                                    <p class="price validarDesconto" id="valorProduto" data-id-produto = "<?= $produto->id_produto ?>" data-id-usuario = "<?= $usuario->id_usuario ?>" >
                                        R$ <?= number_format($produto->valorVenda, 2, ',', '.'); ?>
                                    </p>
                                </div>

                            </div>
                            <!-- FIM >> DETALHES -->

                            <!-- DESCRIÇÃO E ATRIBUTOS -->
                            <div class="options">

                                <!-- DESCRIÇÃO -->
                                <p><?= $produto->descricao ?></p>
                                <!-- FIM >> DESCRIÇÃO -->

                                <hr>

                                <?php if ($atributos) : ?>
                                    <?php foreach ($atributos as $atributo) : ?>
                                        <div>
                                            <span>
                                                <img style="display: inline" src="<?= $atributo->detalhes->imagem ?>">
                                                <p style="display: inline; margin-left: 15px"><?= $atributo->detalhes->nome ?></p>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                            <!-- FIM >> DESCRIÇÃO E ATRIBUTOS -->

                        </div>
                        <!-- FIM >> DETALHES -->

                    </div>
                    <!-- FIM >> PRODUTO -->

                    <!-- FICHA TECNICA -->
                    <?php if (!empty($fichaTecnica)) : ?>
                        <div class="hoz-tab-container space-padding-tb-30">
                            <ul class="tabs">
                                <li class="item" rel="description">Ficha técnica</li>
                            </ul>
                            <div class="tab-container">
                                <div id="description" class="tab-content">
                                    <div class="text">

                                        <?php foreach ($fichaTecnica as $ficha) : ?>
                                            <h3><?= $ficha->campo ?></h3>
                                            <p><?= $ficha->descricao ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- FIM >> FICHA TECNICA -->

                </div>
            </div>
        </div>

    </div>
    <!-- FIM >> CONTEUDO -->


<?php $this->view("site/include/footer") ?>
<script type="text/javascript">

    $(document).ready(function(){

        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items:6,
            loop:true,
            margin:10,
            autoplay:false,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items:3,
                },
                // breakpoint from 480 up
                480 : {
                    items:5,
                },
                // breakpoint from 768 up
                768 : {
                    items:6,
                }
            }
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            // centerMode: true,
            dots: false,
            focusOnSelect: true
        });
        $('.zoom').zoom();

    });

    // Função para o filtro
    function AbreModalFiltro(tipo)
    {
        if (tipo === "abre")
        {
            $(".modal-filtro").css("left","0px");
            $(".modal-filtro").css("opacity","1");
        }
        else
        {
            $(".modal-filtro").css("left","-100%");
            $(".modal-filtro").css("opacity","0");
        }
    }

</script>
