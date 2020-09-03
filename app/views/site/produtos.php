<?php $this->view("site/include/header"); ?>

<!-- Tema ===================================================== -->
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/css/style.css"/>

    <!-- CABEÇALHO -->
    <div class="cabecalho">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img class="logo" src="<?= BASE_URL ?>assets/theme/site/img/logo-azul.png">
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> CABEÇALHO -->


    <div class="wrappage" style="margin-top: 50px">


        <div class="container">

            <!-- FILTROS -->
            <div id="secondary" class="widget-area col-xs-12 col-md-3">

                <?php if (!empty($categorias)) : ?>

                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">CATEGORIAS</h3>

                        <ul class="product-categories">
                            <?php foreach ($categorias as $categoria) : ?>

                                <!-- CATEGORIA NIVEL 1 -->
                                <li>

                                    <a href="<?= BASE_URL ?>produtos/<?= $categoria->id_categoria ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a>

                                    <!-- CATEGORIA NIVEL 2 -->
                                    <?php if (!empty($categoria->filhos)) : ?>

                                        <ul class="children">

                                            <?php foreach ($categoria->filhos as $cat) : ?>

                                                <li><a href="<?= BASE_URL; ?>produtos/<?= $cat->id_categoria ?>" title="<?= $cat->nome ?>"><?= $cat->nome ?></a></li>

                                            <?php endforeach; ?>

                                        </ul>

                                    <?php endif; ?>

                                </li>

                            <?php endforeach; ?>
                            <li><a href="<?= BASE_URL ?>produtos" title="kids">Todas categorias</a></li>
                        </ul>
                    </aside>
                <?php endif; ?>

                <aside class="widget widget_link">
                    <h3 class="widget-title">OUTRAS MARCAS</h3>
                    <ul>
                        <li><a href="#" title="Aeccaft">Aeccaft</a><span class="count">(15)</span></li>
                        <li><a href="#" title="Artek">Artek</a><span class="count">(09)</span></li>
                        <li><a href="#" title="Bower">Bower</a><span class="count">(12)</span></li>
                        <li><a href="#" title="Culinarium">Culinarium</a><span class="count">(16)</span></li>
                        <li><a href="#" title="Desu">Desu</a><span class="count">(16)</span></li>
                    </ul>
                </aside>

            </div>
            <!-- FIM >> FILTROS -->

            <!-- PRODUTOS -->
            <div id="primary" class="col-xs-12 col-md-9">

                <!-- QUANTIDADE -->
                <div class="wrap-breadcrumb">
                    <div class="ordering">
                        <div class="float-left">
                            <p class="result-count">Mostrando <?= $qtdeProdutos ?> produtos</p>
                        </div>
                        <div class="float-right"></div>
                    </div>
                </div>
                <!-- FIM >> QUANTIDADE -->

                <!-- PRODUTOS -->
                <div class="products ver2 grid_full grid_sidebar hover-shadow furniture">
                    <?php foreach ($produtos as $produto) : ?>
                        <div class="item-inner">
                            <div class="product">
                                <div class="product-images">
                                    <a href="#" title="product-images">
                                        <div class="thumb-produto" style="background-image: url('<?= $produto->imagem ?>')">

                                        </div>
                                        <img style="display: none" class="primary_image" src="<?= $produto->imagem ?>" alt=""/>
                                    </a>
                                </div>
                                <a href="#"><p class="product-title"><?= mb_strimwidth($produto->nome, 0, 35, "...");  ?></p></a>
                                <p class="product-price">R$ <?= number_format($produto->valorVenda, 2, ",", ".") ?></p>
                                <p class="description">Dramatically transition excellent information rather than mission-critical results. Competently communicate fully tested core competencies through holistic resources. Professionally maintain high-payoff best practices whereas user-centric alignments. Intrinsicly engage future-proof best practices whereas economically sound resources. Holisticly maximize multidisciplinary synergy before magnetice-tailers.</p>

                                <div class="social box">
                                    <h3>Share this :</h3>
                                    <a class="twitter" href="#" title="social"><i class="fa fa-twitter-square"></i></a>
                                    <a class="dribbble" href="#" title="social"><i class="fa fa-dribbble"></i></a>
                                    <a class="skype" href="#" title="social"><i class="fa fa-skype"></i></a>
                                    <a class="pinterest" href="#" title="social"><i class="fa fa-pinterest"></i></a>
                                    <a class="facebook" href="#" title="social"><i class="fa fa-facebook-square"></i></a>
                                </div>
                            </div>
                            <!-- End product -->
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- FIM >> PRODUTOS -->

                <!-- PAGINAÇÃO -->
                <div class="pagination-container">
                    <nav class="pagination align-right">
                        <a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a>
                        <span class="page-numbers current">1</span>
                        <a class="page-numbers" href="#">2</a>
                        <a class="page-numbers" href="#">3</a>
                        <a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a>
                    </nav>
                </div>
                <!-- FIM >> PAGINAÇÃO -->

            </div>
            <!-- FIM >> PRODUTOS -->


        </div>

    </div>


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
