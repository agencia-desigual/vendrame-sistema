<?php $this->view("site/include/header"); ?>

<!-- Tema ===================================================== -->
<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/site/assets/css/style.css"/>

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


    <div class="wrappage" style="margin-top: 50px">


        <div class="container">

            <!-- FILTROS -->
            <div id="secondary" class="widget-area col-xs-12 col-md-4" style="overflow-y: auto;">

                <?php if (!empty($filtroNome)) : ?>

                <aside class="widget widget_product_categories">
                    <h3 class="widget-title">FILTRO</h3>

                    <div class="selecionados">

                        <?php if (!empty($filtroNome['busca'])) : ?>
                            <span class="badge-primary"  onclick="removeFiltro('busca','<?= BASE_URL . "produtos?c=true" . $filtro['categoria'] . $filtro['tipo'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco']; ?>')">
                                <?= $filtroNome['busca'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['marca'])) : ?>
                            <span onclick="removeFiltro('marca','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['order'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'];  ?>')" class="badge-primary">
                                <?= "Marca: ". $filtroNome['marca'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['categoria'])) : ?>
                            <span onclick="removeFiltro('categoria','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['tipo'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'];  ?>')" class="badge-primary">
                                <?= "Categoria: ". $filtroNome['categoria'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['tipo'])) : ?>
                            <span onclick="removeFiltro('tipo','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'];  ?>')" class="badge-primary">
                                <?= "Linha: ". $filtroNome['tipo'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['indice'])) : ?>
                            <span onclick="removeFiltro('indice','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['tipo'] . $filtro['tratamento'] . $filtro['preco'];  ?>')" class="badge-primary">
                                <?= "Índice: ". $filtroNome['indice'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['tratamento'])) : ?>
                            <span onclick="removeFiltro('tipo','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tipo'] . $filtro['preco'];  ?>')" class="badge-primary">
                                <?= "Tratamento: ". $filtroNome['tratamento'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['preco'])) : ?>
                            <span onclick="removeFiltro('tipo','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tipo'] . $filtro['tratamento'];  ?>')" class="badge-primary">
                                <?= "Preço: ". $filtroNome['preco'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                    </div>

                </aside>
                <?php endif; ?>

                <!-- MARCAS -->
                <?php if (!empty($marcas)) : ?>
                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">Marcas</h3>
                        <ul class="product-categories">
                            <?php foreach ($marcas as $marca) : ?>

                                <!-- MARCAS -->
                                <li>
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] ?>&marca=<?= $marca->id_marca ?>" title="<?= $marca->nome ?>"><?= $marca->nome ?></a>
                                </li>
                                <!-- FIM >> MARCAS -->

                            <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>
                <!-- FIM >> MARCAS -->

                <!-- TIPOS -->
                <?php if (!empty($_GET['marca'])) : ?>
                    <?php if (!empty($tipos)) : ?>
                        <aside class="widget widget_product_categories">
                            <h3 class="widget-title">LINHAS</h3>

                            <ul class="product-categories">
                                <?php foreach ($tipos as $tipo) : ?>

                                    <!-- CATEGORIA NIVEL 1 -->
                                    <li>

                                        <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['categoria'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] ?>&tipo=<?= $tipo->id_tipo; ?>" title="<?= $tipo->nome ?>"><?= $tipo->nome ?></a>

                                        <?php if (!empty($tipo->filhos)) : ?>
                                            <!-- CATEGORIA NIVEL 2 -->
                                            <ul class="children">

                                                <?php foreach ($tipo->filhos as $tip) : ?>

                                                    <li><a href="<?= BASE_URL; ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['categoria'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] ?>&tipo=<?= $tip->id_tipo; ?>" title="<?= $tip->nome ?>"><?= $tip->nome ?></a></li>

                                                <?php endforeach; ?>

                                            </ul>
                                        <?php endif; ?>

                                    </li>

                                <?php endforeach; ?>
                                <li><a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'];  ?>" title="kids">Todos os tipos</a></li>
                            </ul>
                        </aside>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- FIM >> TIPOS -->


                <!-- CATEGORIAS -->
                <?php if (!empty($categorias)) : ?>
                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">CATEGORIAS</h3>

                        <ul class="product-categories">
                            <?php foreach ($categorias as $categoria) : ?>

                                <!-- CATEGORIA NIVEL 1 -->
                                <li>

                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] ?>&categoria=<?= $categoria->id_categoria; ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a>

                                    <!-- CATEGORIA NIVEL 2 -->
                                    <?php if (!empty($categoria->filhos)) : ?>

                                        <ul class="children">

                                            <?php foreach ($categoria->filhos as $cat) : ?>

                                                <li><a href="<?= BASE_URL; ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] ?>&categoria=<?= $cat->id_categoria; ?>" title="<?= $cat->nome ?>"><?= $cat->nome ?></a></li>

                                            <?php endforeach; ?>

                                        </ul>

                                    <?php endif; ?>

                                </li>

                            <?php endforeach; ?>
                            <li><a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['tipo'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'];  ?>" title="kids">Todas categorias</a></li>
                        </ul>
                    </aside>
                <?php endif; ?>
                <!-- FIM >> CATEGORIAS -->


                <!-- INDICES -->
                <?php if (!empty($indices) && is_array($indices)) : ?>
                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">Índices</h3>
                        <ul class="product-categories">

                            <?php foreach ($indices as $indice) : ?>

                                <!-- MARCAS -->
                                <li>
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['marca'] . $filtro['tratamento'] . $filtro['preco'] ?>&indice=<?= $indice->id_indice ?>" title="<?= $indice->nome ?>"><?= $indice->nome ?></a>
                                </li>
                                <!-- FIM >> MARCAS -->

                            <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>
                <!-- FIM >> INDICES -->


                <!-- PREÇOS -->
                <?php if (!empty($precos)) : ?>
                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">Preços</h3>
                        <ul class="product-categories">
                            <?php foreach ($precos as $key => $val) : ?>

                                <!-- MARCAS -->
                                <li>
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['tratamento'] ?>&preco=<?= $key ?>" title="<?= $val["nome"]; ?>"><?= $val["nome"]; ?></a>
                                </li>
                                <!-- FIM >> MARCAS -->

                            <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>
                <!-- FIM >> INDICES -->


                <!-- TRATAMENTOS -->
                <?php if (!empty($tratamentos) && is_array($tratamentos)) : ?>
                    <aside class="widget widget_product_categories">
                        <h3 class="widget-title">Tratamentos</h3>
                        <ul class="product-categories">
                            <?php foreach ($tratamentos as $tratamento) : ?>

                                <!-- MARCAS -->
                                <li>
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] ?>&tratamento=<?= $tratamento->id_tratamento ?>" title="<?= $tratamento->nome ?>"><?= $tratamento->nome ?></a>
                                </li>
                                <!-- FIM >> MARCAS -->

                            <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>
                <!-- FIM >> INDICES -->

            </div>
            <!-- FIM >> FILTROS -->

            <!-- PRODUTOS -->
            <div id="primary" class="col-xs-12 col-md-8">

                <!-- QUANTIDADE -->
                <div class="wrap-breadcrumb">
                    <div class="ordering">
                        <div class="float-left">
                            <p class="result-count">Mostrando <?= $qtdeProdutos ?> produtos</p>
                        </div>


                        <!--
                        <div class="float-right">
                            <select onchange="location.href = this.value">
                                <option <?= ($filtro["order"] == "&order=menor-preco") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] .$filtro['tipo'] ?>&order=menor-preco">Menor Preço</option>
                                <option <?= ($filtro["order"] == "&order=maior-preco") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] . $filtro['marca'] ?>&order=maior-preco">Maior Preço</option>
                                <option <?= ($filtro["order"] == "&order=recente") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] . $filtro['marca'] ?>&order=recente">Os mais recentes</option>
                                <option <?= ($filtro["order"] == "&order=antigo") ? "selected" : ""; ?> value="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['marca'] . $filtro['marca'] ?>&order=antigo">Os mais antigos</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <!-- FIM >> QUANTIDADE -->

                <!-- PRODUTOS -->
                <div class="products ver2 grid_full grid_sidebar hover-shadow furniture">
                    <?php $linha = ""; ?>
                    <?php foreach ($produtos as $produto) : ?>
                        <?php if($produto->id_tipo != $linha): ?>

                            <h4 style="font-size: 1.5em; font-weight: bold; padding-left: 19px; padding-bottom: 20px;
                                <?= ($linha != "") ? "margin-top: 30px; border-top: 2px solid #000; padding-top: 25px;" : ""; ?>
                                ">Linha: <?= $produto->linha->nome; ?></h4>

                            <?php $linha = $produto->id_tipo; ?>
                        <?php endif; ?>

                        <a href="<?= BASE_URL ?>produto-detalhes/<?= $produto->id_produto ?>">
                            <div class="item-inner"  style="width: 100% !important; display: block; float: initial;">
                                <div class="product" style="box-shadow: -2px 2px 10px 0px #ccc; padding: 15px; margin: 5px; margin-bottom: 20px;">

                                    <!-- NOME -->
                                    <a href="<?= BASE_URL ?>produto-detalhes/<?= $produto->id_produto ?>">
                                        <p class="product-title"  style="height: auto;">
                                            <?= $produto->nome;  ?>
                                        </p>
                                    </a>
                                    <!-- FIM >> NOME -->

                                    <!-- PREÇO -->
                                    <p class="product-price" style="height: auto; margin-bottom: 0px; padding-bottom: 0px; padding-top: 13px;">
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

        var a = $("#primary").height() - 130;
        $("#secondary").css("height", a + "px");


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

    function removeFiltro(tipo,url)
    {

        $('.body').addClass("bloqueiaBody");
        setTimeout(function () {
            location.href = url;
        },500)
    }

</script>
