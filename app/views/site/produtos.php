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
                <?php foreach ($categorias as $categoria) : ?>
                    <div class="col-4">
                        <?= $categoria->nome ?>

                        <?php foreach ($categoria->filhas as $filhas) : ?>

                            <div class="row">
                                <div class="col-12">
                                    <a href="<?= BASE_URL; ?>produtos/<?= $filhas->id_categoria ?>">
                                        <?= $filhas->nome ?>
                                    </a>
                                </div>
                            </div>

                        <?php endforeach; ?>


                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <p>Foram encontrados 989 produtos no catálogo</p>
                    <button style="display: none" onclick="AbreModalFiltro('abre')">FILTRAR</button>
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
    <div style="display: none" class="modal-filtro animate__fadeInLeft">

        <div class="conteudo">
            <div class="container">
                <div class="row">
                    <div class="col-12 item centraliza-itens-sem-text">
                        <div style="width: 100%;">
                            <img class="icone" src="<?= BASE_URL ?>assets/theme/site/img/icones/categorias.svg">
                            <h1>Categorias</h1>

                            <div style="margin-top: 30px" class="accordion" id="categoriaPAI">
                                <?php foreach ($categorias as $categoria) : ?>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input class="categoria" data-id="<?= $categoria->id_categoria ?>" name="categoria" type="radio">
                                                <span><?= $categoria->nome ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div style="margin-top: 30px" class="accordion" id="categoriaFILHAS">
                                <div class="categoriasFilhas"></div>
                            </div>

                            <div class="itens">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 item centraliza-itens-sem-text">
                        <div style="width: 100%;">
                            <img class="icone" src="<?= BASE_URL ?>assets/theme/site/img/icones/marca.svg">
                            <h1>Marcas</h1>
                            <form style="margin-top: 15px">
                                <select class="form-control input-busca">
                                    <option selected>Todas</option>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?= $marca->id_marca ?>"><?= $marca->nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
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
