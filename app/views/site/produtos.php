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

                <?php if (!empty($marcas)) : ?>
                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">Marcas</h3>

                        <ul class="product-categories">
                            <?php foreach ($marcas as $marca) : ?>

                                <!-- MARCAS -->
                                <li>
                                    <a href="<?= BASE_URL ?>produtos?c=true&marca=<?= $marca->id_marca ?>" title="<?= $marca->nome ?>"><?= $marca->nome ?></a>
                                </li>
                                <!-- FIM >> MARCAS -->

                            <?php endforeach; ?>
                        </ul>

                    </aside>
                <?php endif; ?>

                <?php if (!empty($_GET['marca'])) : ?>
                    <?php if (!empty($categorias)) : ?>
                        <aside class="widget widget_product_categories">
                            <h3 class="widget-title">CATEGORIAS</h3>

                            <ul class="product-categories">
                                <?php foreach ($categorias as $categoria) : ?>

                                    <!-- CATEGORIA NIVEL 1 -->
                                    <li>

                                        <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] ?>&categoria=<?= $categoria->id_categoria; ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a>

                                        <!-- CATEGORIA NIVEL 2 -->
                                        <?php if (!empty($categoria->filhos)) : ?>

                                            <ul class="children">

                                                <?php foreach ($categoria->filhos as $cat) : ?>

                                                    <li><a href="<?= BASE_URL; ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] ?>&categoria=<?= $cat->id_categoria; ?>" title="<?= $cat->nome ?>"><?= $cat->nome ?></a></li>

                                                <?php endforeach; ?>

                                            </ul>

                                        <?php endif; ?>

                                    </li>

                                <?php endforeach; ?>
                                <li><a href="<?= BASE_URL ?>produtos" title="kids">Todas categorias</a></li>
                            </ul>
                        </aside>
                    <?php endif; ?>
                <?php endif; ?>

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
                        <div class="float-right">
                            <select onchange="location.href = this.value">
                                <option <?= ($filtro["order"] == "&order=menor-preco") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] ?>&order=menor-preco">Menor Preço</option>
                                <option <?= ($filtro["order"] == "&order=maior-preco") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] ?>&order=maior-preco">Maior Preço</option>
                                <option <?= ($filtro["order"] == "&order=recente") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] ?>&order=recente">Os mais recentes</option>
                                <option <?= ($filtro["order"] == "&order=antigo") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] ?>&order=antigo">Os mais antigos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- FIM >> QUANTIDADE -->

                <!-- PRODUTOS -->
                <div class="products ver2 grid_full grid_sidebar hover-shadow furniture">
                    <?php foreach ($produtos as $produto) : ?>
                        <a href="<?= BASE_URL ?>produto-detalhes/<?= $produto->id_produto ?>">
                            <div class="item-inner">
                                <div class="product">

                                    <!-- THUMB -->
                                    <div class="product-images">
                                        <a href="<?= BASE_URL ?>produto-detalhes/<?= $produto->id_produto ?>" title="">
                                            <div class="thumb-produto" style="background-image: url('<?= $produto->imagem ?>')"></div>
                                        </a>
                                    </div>
                                    <!-- FIM >> THUMB -->

                                    <!-- NOME -->
                                    <a href="<?= BASE_URL ?>produto-detalhes/<?= $produto->id_produto ?>">
                                        <p class="product-title"><?= mb_strimwidth($produto->nome, 0, 35, "...");  ?></p>
                                    </a>
                                    <!-- FIM >> NOME -->

                                    <!-- PREÇO -->
                                    <p class="product-price">
                                        R$ <?= number_format($produto->valorVenda, 2, ",", ".") ?>
                                    </p>
                                    <!-- FIM >> PREÇO -->

                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!-- FIM >> PRODUTOS -->

                <?php $this->view("site/include/paginacao", $paginacao); ?>

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
