<?php $this->view("site/include/header"); ?>

<style>
    .btnAux
    {
        border: none;
        background: #204f93;
        color: #fff;
        padding: 6px;
        width: 45px;
    }

    .inpAux
    {
        padding: 9px !important;
        height: 32px !important;
        width: 100px !important;
        float: left !important;
        margin-right: 7px !important;
        margin-bottom: 19px !important;
    }
</style>

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
                        <svg fill="#204f93" width="300px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 417.83 42.44"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M417.83,12.37a3.73,3.73,0,1,1-3.74-3.7A3.69,3.69,0,0,1,417.83,12.37Zm-.45,0a3.29,3.29,0,1,0-3.29,3.25A3.22,3.22,0,0,0,417.38,12.37Zm-3-2.07c1.1,0,1.65.6,1.65,1.33a1.33,1.33,0,0,1-1.3,1.31l1.25,1.5v0h-.62L414.15,13h-.87v1.48h-.57V10.3Zm-1.12,2.16h1.08c.77,0,1.12-.34,1.12-.83s-.35-.83-1.12-.83h-1.08Z"/><path d="M292,31.5c5.7-1.18,9.65-5.27,9.65-11,0-6.85-4.8-11.85-13.55-11.85H272.27V42.44h6.26a2.06,2.06,0,0,0,2.06-2.06V32.65H281a2.78,2.78,0,0,1,2.18,1.05l6.09,7.78a2.49,2.49,0,0,0,2,1h9.22l-8.81-9.7A.77.77,0,0,1,292,31.5Zm-5.19-6.18h-3.5a2.86,2.86,0,0,1-2.87-2.87V16.28h6.37c4.66,0,6.56,1.76,6.56,4.48S291.48,25.32,286.82,25.32Z"/><path d="M147.79,42.44a3.32,3.32,0,0,1-3.12-2.18L133.18,8.74h0v0h7.59a2.28,2.28,0,0,1,2.14,1.49L149.46,28a1,1,0,0,0,1.89,0L158,10.21a2.27,2.27,0,0,1,2.13-1.49h7.59v0h0L156.25,40.25a3.3,3.3,0,0,1-3.12,2.19Z"/><path d="M208.22,25.2V42.44H200V8.67h6.17a3.58,3.58,0,0,1,2.93,1.54l11.32,16.3a1,1,0,0,0,1.88-.59V8.67h8.23V42.44h-6.22a3.57,3.57,0,0,1-2.93-1.53L210.1,24.61A1,1,0,0,0,208.22,25.2Z"/><path d="M250.16,8.67c10.18,0,17.6,7.47,17.6,16.89s-7.42,16.88-17.6,16.88H238.88a2.56,2.56,0,0,1-2.56-2.56V8.67Zm-5.52,8V31.94a2.56,2.56,0,0,0,2.56,2.56h2.67c5.38,0,9.42-3.66,9.42-8.94s-4-8.94-9.42-8.94Z"/><path d="M350.59,23.82V40.51a1.93,1.93,0,0,1-1.93,1.93h-6.35V8.67h6.48A3,3,0,0,1,351.26,10l7.09,9.87a1.44,1.44,0,0,0,2.35,0l7-9.86a3,3,0,0,1,2.49-1.29h6.46V42.44h-6.39a1.92,1.92,0,0,1-1.93-1.93V23.86a1,1,0,0,0-1.72-.59l-7.15,9.28-7.15-9.31A1,1,0,0,0,350.59,23.82Z"/><path d="M180.9,34.93a1.41,1.41,0,0,1-1.4-1.41V28.89h13.55V22H180.9a1.41,1.41,0,0,1-1.4-1.41V16.09h13.63a1.92,1.92,0,0,0,1.92-1.92V8.67h-22a1.92,1.92,0,0,0-1.93,1.93V39.47a3,3,0,0,0,3,3h21.09V34.93Z"/><path d="M392.18,34.93a1.41,1.41,0,0,1-1.41-1.41V28.89h13.55V22H392.18a1.41,1.41,0,0,1-1.41-1.41V16.09H404.4a1.92,1.92,0,0,0,1.92-1.92V8.67H384.37a1.92,1.92,0,0,0-1.92,1.93V39.47a3,3,0,0,0,3,3h21.09V34.93Z"/><path d="M327,10.3a2.48,2.48,0,0,0-2.32-1.63H316.4L304,42.35v.09h7.13a2.47,2.47,0,0,0,2.36-1.72l1.68-5.17h12.55l1.23,3.83.45,1.36a2.5,2.5,0,0,0,2.36,1.7h7.14v-.09Zm-9.5,17.87,3.81-11.89h.19l2.93,9.12.88,2.77Z"/><path d="M17.18,8.72a16.86,16.86,0,1,0,0,33.71,16.86,16.86,0,1,0,0-33.71Zm14.2,16.85a14.08,14.08,0,0,1-14.2,13.92A14.08,14.08,0,0,1,3,25.57a14.07,14.07,0,0,1,14.2-13.91A14.07,14.07,0,0,1,31.38,25.57Z"/><path d="M19.47,6.19,23.77,1l.78-1H22.17A2.79,2.79,0,0,0,20,1.1L16.07,6.25l-.68,1h1.94A2.77,2.77,0,0,0,19.47,6.19Z"/><path d="M35.64,11.6h10a1.25,1.25,0,0,1,1.25,1.26V42.43h3V12.86a1.25,1.25,0,0,1,1.26-1.26h10V8.72H35.64Z"/><path d="M66,10.75V42.43H67a2,2,0,0,0,2-2V8.72H68A2,2,0,0,0,66,10.75Z"/><path d="M98.53,38.48a16.66,16.66,0,0,1-5.75,1c-8.39,0-14.71-6-14.71-13.92s6.3-13.91,14.66-13.91a17,17,0,0,1,5.76,1l.78.31v-1.8a1.73,1.73,0,0,0-1.18-1.63,17.48,17.48,0,0,0-5.5-.82c-10,0-17.5,7.24-17.5,16.85s7.55,16.86,17.55,16.86A16.77,16.77,0,0,0,99,41.3l.36-.14v-3l-.76.26Z"/><path d="M119.17,8.72H116L102.37,41.64l-.34.8h1.81A2.33,2.33,0,0,0,106,41l3.26-8.09h16.62L129.14,41a2.33,2.33,0,0,0,2.16,1.45h1.87l-.33-.74Zm4.93,20.84a1,1,0,0,1-.83.44h-11.4a1,1,0,0,1-.84-.44,1,1,0,0,1-.1-.94l6.62-16.19,6.65,16.19A1,1,0,0,1,124.1,29.56Z"/></g></g></svg>
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
                            <span class="badge-primary"  onclick="removeFiltro('busca','<?= BASE_URL . "produtos?c=true" . $filtro['categoria'] . $filtro['tipo'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura']; ?>')">
                                <?= $filtroNome['busca'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['marca'])) : ?>
                            <span onclick="removeFiltro('marca','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['order'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>')" class="badge-primary">
                                <?= "Marca: ". $filtroNome['marca'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['categoria'])) : ?>
                            <span onclick="removeFiltro('categoria','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['tipo'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>')" class="badge-primary">
                                <?= "Categoria: ". $filtroNome['categoria'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['tipo'])) : ?>
                            <span onclick="removeFiltro('tipo','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>')" class="badge-primary">
                                <?= "Linha: ". $filtroNome['tipo'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['indice'])) : ?>
                            <span onclick="removeFiltro('indice','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['tipo'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>')" class="badge-primary">
                                <?= "Índice: ". $filtroNome['indice'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['tratamento'])) : ?>
                            <span onclick="removeFiltro('tipo','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tipo'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>')" class="badge-primary">
                                <?= "Tratamento: ". $filtroNome['tratamento'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($filtroNome['preco'])) : ?>
                            <span onclick="removeFiltro('tipo','<?= BASE_URL . "produtos?c=true" . $filtro['busca'] . $filtro['categoria'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tipo'] . $filtro['tratamento'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>')" class="badge-primary">
                                <?= "Preço: ". $filtroNome['preco'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if(!empty($filtroNome["promocao"])): ?>
                            <span onclick="removeFiltro('promocao', '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura']; ?>')" class="badge-primary">
                                Produtos Promocionais
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if(!empty($filtroNome["esf"])): ?>
                            <span onclick="removeFiltro('esf', '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura']; ?>')" class="badge-primary">
                                <?= "Esférico: ". $filtroNome['esf'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>


                        <?php if(!empty($filtroNome["cil"])): ?>
                            <span onclick="removeFiltro('cil', '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['adicao'] . $filtro['altura']; ?>')" class="badge-primary">
                                <?= "Cilíndro: ". $filtroNome['cil'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if(!empty($filtroNome["adicao"])): ?>
                            <span onclick="removeFiltro('adicao', '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['altura']; ?>')" class="badge-primary">
                                <?= "Adição: ". $filtroNome['adicao'] ?>
                                <p>x</p>
                            </span>
                        <?php endif; ?>

                        <?php if(!empty($filtroNome["altura"])): ?>
                            <span onclick="removeFiltro('altura', '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao']; ?>')" class="badge-primary">
                                <?= "Altura: ". $filtroNome['altura'] ?>
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
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&marca=<?= $marca->id_marca ?>" title="<?= $marca->nome ?>"><?= $marca->nome ?></a>
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

                                        <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['categoria'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&tipo=<?= $tipo->id_tipo; ?>" title="<?= $tipo->nome ?>"><?= $tipo->nome ?></a>

                                        <?php if (!empty($tipo->filhos)) : ?>
                                            <!-- CATEGORIA NIVEL 2 -->
                                            <ul class="children">

                                                <?php foreach ($tipo->filhos as $tip) : ?>

                                                    <li><a href="<?= BASE_URL; ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['categoria'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&tipo=<?= $tip->id_tipo; ?>" title="<?= $tip->nome ?>"><?= $tip->nome ?></a></li>

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

                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&categoria=<?= $categoria->id_categoria; ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a>

                                    <!-- CATEGORIA NIVEL 2 -->
                                    <?php if (!empty($categoria->filhos)) : ?>

                                        <ul class="children">

                                            <?php foreach ($categoria->filhos as $cat) : ?>

                                                <li><a href="<?= BASE_URL; ?>produtos?c=true<?= $filtro['busca'] . $filtro['marca'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&categoria=<?= $cat->id_categoria; ?>" title="<?= $cat->nome ?>"><?= $cat->nome ?></a></li>

                                            <?php endforeach; ?>

                                        </ul>

                                    <?php endif; ?>

                                </li>

                            <?php endforeach; ?>
                            <li><a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['tipo'] . $filtro['order']  . $filtro['marca'] . $filtro['indice'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'];  ?>" title="kids">Todas categorias</a></li>
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
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['marca'] . $filtro['tratamento'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&indice=<?= $indice->id_indice ?>" title="<?= $indice->nome ?>"><?= $indice->nome ?></a>
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
                                    <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['tratamento'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura'] ?>&preco=<?= $key ?>" title="<?= $val["nome"]; ?>"><?= $val["nome"]; ?></a>
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

                <!-- ESFÉRICO -->
                <aside class="widget widget_product_categories">
                    <h3 class="widget-title">Esférico</h3>
                    <input placeholder="ex: 1,50" class="form-control inpAux maskValor" id="inpEsf" <?= (!empty($filtro['esf']) ? 'value="'. number_format($get['esf'], 2,',','') .'"' : ''); ?> />
                    <button class="btnAux" onclick="location.href = '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura']  . '&esf='; ?>' + $('#inpEsf').val()">
                        OK
                    </button>
                </aside>
                <!-- FIM >> ESFÉRICO -->


                <!-- CILÍNDRO -->
                <aside class="widget widget_product_categories">
                    <h3 class="widget-title">Cilíndro</h3>
                    <input placeholder="ex: 1,50" class="form-control inpAux maskValor" id="inpCil" <?= (!empty($filtro['cil']) ? 'value="'. number_format($get['cil'], 2,',','') .'"' : ''); ?> />
                    <button class="btnAux" onclick="location.href = '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['adicao'] . $filtro['altura'] . '&cil='; ?>' + $('#inpCil').val()">
                        OK
                    </button>
                </aside>
                <!-- FIM >> CILÍNDRO -->


                <!-- ADIÇÃO -->
                <aside class="widget widget_product_categories">
                    <h3 class="widget-title">Adição</h3>
                    <input placeholder="ex: 1,50" class="form-control inpAux maskValor" id="inpAdicao" <?= (!empty($filtro['adicao']) ? 'value="'. number_format($get['adicao'], 2,',','') .'"' : ''); ?> />
                    <button class="btnAux" onclick="location.href = '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['altura'] . '&adicao='; ?>' + $('#inpAdicao').val()">
                        OK
                    </button>
                </aside>
                <!-- FIM >> ADIÇÃO -->


                <!-- ADIÇÃO -->
                <aside class="widget widget_product_categories">
                    <h3 class="widget-title">Altura</h3>
                    <input placeholder="ex: 1,50" class="form-control inpAux maskValor" id="inpAltura" <?= (!empty($filtro['altura']) ? 'value="'. number_format($get['altura'], 2,',','') .'"' : ''); ?> />
                    <button class="btnAux" onclick="location.href = '<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['promocao'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . '&altura='; ?>' + $('#inpAltura').val()">
                        OK
                    </button>
                </aside>
                <!-- FIM >> ADIÇÃO -->

            </div>
            <!-- FIM >> FILTROS -->

            <!-- PRODUTOS -->
            <div id="primary" class="col-xs-12 col-md-8">

                <!-- QUANTIDADE -->
                <div class="wrap-breadcrumb">
                    <div class="ordering">
                        <div class="float-left">
                            <?php if(empty($filtro['promocao'])): ?>
                                <a href="<?= BASE_URL ?>produtos?c=true<?= $filtro['busca'] . $filtro['categoria'] . $filtro['order'] . $filtro['tipo'] . $filtro['indice'] . $filtro['marca'] . $filtro['preco'] . $filtro['preco'] . $filtro['esf'] . $filtro['cil'] . $filtro['adicao'] . $filtro['altura']; ?>&promocao=1" style="background: transparent; letter-spacing: 2px; text-transform: uppercase; text-decoration: underline;">
                                    Ver produtos promocionais
                                </a>
                            <?php endif; ?>
                        </div>
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

                                    <?php if(!empty($produto->valorPromocao)): ?>
                                        <p class="product-price" style="color: red; height: auto; margin-bottom: 0px; padding-bottom: 0px; padding-left: 10px; padding-top: 13px;">
                                            R$ <?= number_format($produto->valorPromocao, 2, ",", ".") ?>
                                            <span style="font-size: 9px;">á vista</span>
                                        </p>
                                    <?php endif; ?>
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
