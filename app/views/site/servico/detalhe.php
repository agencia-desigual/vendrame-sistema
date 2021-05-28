<?php $this->view("site/include/header"); ?>

<!-- Tema ===================================================== -->
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/vendor/owl-slider.css"/>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/vendor/slick.css"/>
<link rel="shortcut icon" href="<?= BASE_URL; ?>assets/theme/site/assets/images/favicon.png" />
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/vendor/settings.css"/>

<!-- CABEÇALHO -->
<div class="cabecalho">
    <div class="container">
        <div class="row">
            <a style="cursor: pointer; font-size: 2em; position: absolute; color: #204f93; z-index: 999999;" onclick="window.history.back();">
                <i class="fa fa-arrow-left"></i>
            </a>

            <?php if($usuario->nivel == "admin"): ?>
                <a href="<?= BASE_URL; ?>painel" style="right: 40px; position: absolute; color: #204f93; z-index: 999999;">
                    Painel Administrativo
                </a>
            <?php endif; ?>

            <div class="col-md-12 text-center">
                <a href="<?= BASE_URL ?>">
                    <img class="logo" src="<?= BASE_URL ?>assets/theme/site/img/logo-azul.png">
                </a>


                <!-- FORMULARIO -->
                <form id="pesquisaProduto" class="index" style="background-color: #fff;">
                    <div class="form-group" style="margin-top: 33px;">
                        <div class="busca" style="width: 450px; display: block; margin: 0 auto;">
                            <input type="text" name="busca" class="form-control input-busca" id="pesquisa" aria-describedby="busca" placeholder="Encontre os produtos" style="width: 300px;">

                            <button type="submit" class="btn btn-primary btn-busca" style="width: 93px; margin: 0px;">
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
                    </div>
                </form>
                <!-- FIM >> FORMULARIO -->
            </div>
        </div>
    </div>
</div>
<!-- FIM >> CABEÇALHO -->

    <!-- CONTEUDO -->
    <div class="wrappage">

        <div class="main-content">
            <div class="container">

                <div class="row">
                    <!-- PRODUTO -->
                    <div class="product-details-content">

                        <!-- DETALES -->
                        <div class="col-md-12">

                            <!-- DETALHES -->
                            <div class="box-details-info">

                                <div class="product-name">
                                    <h1 style="padding-bottom: 33px;"><?= $servico->nome ?></h1>
                                </div>

                                <div class="wrap-price">
                                    <p class="price" style="display: block;">
                                        <span style="font-size: 1.2em; font-weight: bold;">R$ <?= number_format($servico->valor, 2, ',', '.'); ?></span>
                                    </p>
                                </div>

                            </div>
                            <!-- FIM >> DETALHES -->

                        </div>
                        <!-- FIM >> DETALHES -->

                    </div>
                    <!-- FIM >> PRODUTO -->
                </div>


                <div class="row">
                    <div class="product-details-content">
                        <div class="col-md-12">
                            <!-- DESCRIÇÃO E ATRIBUTOS -->
                            <div class="options">

                                <h5>Tipo:</h5>
                                <p><?= ($servico->tipo == "servico" ? "Serviços e tratamentos" : "Padronizações Vendrame") ?></p>

                                <?php if(!empty($marca)): ?>
                                    <h5>Marca:</h5>
                                    <p><?= $marca->nome; ?></p>
                                <?php endif; ?>

                                <!-- DESCRIÇÃO -->
                                <h5>Descrição:</h5>
                                <p><?= $servico->descricao ?></p>
                                <!-- FIM >> DESCRIÇÃO -->


                            </div>
                            <!-- FIM >> DESCRIÇÃO E ATRIBUTOS -->
                        </div>
                    </div>
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
