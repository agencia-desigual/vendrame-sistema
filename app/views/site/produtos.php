<?php $this->view("site/include/header"); ?>


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


    <!-- FILTROS DE PRODUTOS -->
    <div class="filtros">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>Foram encontrados 989 produtos no catálogo</p>
                    <button onclick="AbreModalFiltro('abre')">FILTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> FILTROS DE PRODUTOS -->


    <!-- PRODUTOS -->
    <div class="produtos">
        <div class="row">
            <div class="col-4 card-produto">
                <div class="thumb" style="background-image: url('<?= BASE_URL ?>assets/theme/site/img/padrao/produto.png')"></div>
                <div class="referencia">
                    <p>TESTE-123</p>
                </div>
                <div class="nome">
                    <p>
                        <?= mb_strimwidth("Mussum Ipsum, cacilds vidis litro abertis. Aenean aliquam molestie leo, vitae iaculis nisl. Casamentiss faiz malandris se pirulitá. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Detraxit consequat et quo num tendi nada.", 0, 40, "...");  ?>
                    </p>
                </div>
                <div class="valor">
                    <p>R$ <?= number_format('27.5',2,",",".") ?></p>
                </div>
            </div>
            <div class="col-4 card-produto">
                <div class="thumb" style="background-image: url('<?= BASE_URL ?>assets/theme/site/img/padrao/produto.png')"></div>
                <div class="referencia">
                    <p>TESTE-123</p>
                </div>
                <div class="nome">
                    <p>
                        <?= mb_strimwidth("Mussum Ipsum, cacilds vidis litro abertis. Aenean aliquam molestie leo, vitae iaculis nisl. Casamentiss faiz malandris se pirulitá. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Detraxit consequat et quo num tendi nada.", 0, 40, "...");  ?>
                    </p>
                </div>
                <div class="valor">
                    <p>R$ <?= number_format('27.5',2,",",".") ?></p>
                </div>
            </div>
            <div class="col-4 card-produto">
                <div class="thumb" style="background-image: url('<?= BASE_URL ?>assets/theme/site/img/padrao/produto.png')"></div>
                <div class="referencia">
                    <p>TESTE-123</p>
                </div>
                <div class="nome">
                    <p>
                        <?= mb_strimwidth("Mussum Ipsum, cacilds vidis litro abertis. Aenean aliquam molestie leo, vitae iaculis nisl. Casamentiss faiz malandris se pirulitá. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Detraxit consequat et quo num tendi nada.", 0, 40, "...");  ?>
                    </p>
                </div>
                <div class="valor">
                    <p>R$ <?= number_format('27.5',2,",",".") ?></p>
                </div>
            </div>
            <div class="col-4 card-produto">
                <div class="thumb" style="background-image: url('<?= BASE_URL ?>assets/theme/site/img/padrao/produto.png')"></div>
                <div class="referencia">
                    <p>TESTE-123</p>
                </div>
                <div class="nome">
                    <p>
                        <?= mb_strimwidth("Mussum Ipsum, cacilds vidis litro abertis. Aenean aliquam molestie leo, vitae iaculis nisl. Casamentiss faiz malandris se pirulitá. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Detraxit consequat et quo num tendi nada.", 0, 40, "...");  ?>
                    </p>
                </div>
                <div class="valor">
                    <p>R$ <?= number_format('27.5',2,",",".") ?></p>
                </div>
            </div>
            <div class="col-4 card-produto">
                <div class="thumb" style="background-image: url('<?= BASE_URL ?>assets/theme/site/img/padrao/produto.png')"></div>
                <div class="referencia">
                    <p>TESTE-123</p>
                </div>
                <div class="nome">
                    <p>
                        <?= mb_strimwidth("Mussum Ipsum, cacilds vidis litro abertis. Aenean aliquam molestie leo, vitae iaculis nisl. Casamentiss faiz malandris se pirulitá. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Detraxit consequat et quo num tendi nada.", 0, 40, "...");  ?>
                    </p>
                </div>
                <div class="valor">
                    <p>R$ <?= number_format('27.5',2,",",".") ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> PRODUTOS -->

    <!-- MODAL FILTRO -->
    <div class="modal-filtro animate__fadeInLeft">

        <div class="conteudo">
            <div class="container">
                <div class="row">
                    <div class="col-12 item centraliza-itens-sem-text">
                        <div>
                            <img class="icone" src="<?= BASE_URL ?>assets/theme/site/img/icones/categorias.svg">
                            <h1>Categorias</h1>
                            <div class="itens">
                                <?php foreach ($categoriasPAI as $categoria) : ?>
                                    <a href="#"><?= $categoria->nome ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 item centraliza-itens-sem-text">
                        <div>
                            <img class="icone" src="<?= BASE_URL ?>assets/theme/site/img/icones/marca.svg">
                            <h1>Marcas</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 item centraliza-itens-sem-text">
                        <div>
                            <img class="icone" src="<?= BASE_URL ?>assets/theme/site/img/icones/preco.svg">
                            <h1>Preço</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <button class="btn-cancelar" onclick="AbreModalFiltro('fecha')">CANCELAR</button>
                    </div>
                    <div class="col-6">
                        <button class="btn-filtrar">FILTRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> MODAL FILTRO -->


<?php $this->view("site/include/footer") ?>
<script>

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