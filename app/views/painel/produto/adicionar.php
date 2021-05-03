<?php $this->view("painel/include/header"); ?>

    <!-- ============================================================== -->
    <!-- INICIO adicionar usuario -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- BREADCUMP -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h4 class="page-title">Inserir Produto</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/produtos">Produtos</a></li>
                                <li class="breadcrumb-item active">Adicionar</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- FIM BREADCUMP -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Cadastrar Produto</h4>
                                <p class="sub-title">Cadastre um novo produto no sistema.</p>

                                <form id="formInserirProduto">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Marca</label>
                                                <select class="form-control selecionaMarca" required name="id_marca">
                                                    <option selected disabled>Selecione a marca</option>
                                                    <?php foreach ($marcas as $marca): ?>
                                                        <option <?= (!empty($get["marca"]) && $get["marca"] == $marca->id_marca) ? "selected" : ""; ?> value="<?= $marca->id_marca; ?>">
                                                            <?= $marca->nome; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(!empty($get["marca"])): ?>

                                        <!-- Categoria e Tipo -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Linha</label>
                                                    <select class="selectBusca" name="id_tipo" required>
                                                        <option selected value="">Selecione</option>
                                                        <?php foreach ($tipos as $tipo): ?>
                                                            <option value="<?= $tipo->id_tipo; ?>">
                                                                <?php if(!empty($tipo->sub)): ?>
                                                                    <?= $tipo->sub; ?>
                                                                <?php else: ?>
                                                                    <?= $tipo->nome; ?>
                                                                <?php endif; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Categoria</label>
                                                    <select class="selectBusca" name="id_categoria" required>
                                                        <option selected value="">Selecione</option>
                                                        <?php foreach ($categorias as $categoria): ?>
                                                            <option value="<?= $categoria->id_categoria; ?>">
                                                                <?php if(!empty($categoria->sub)): ?>
                                                                    <?= $categoria->sub; ?>
                                                                <?php else: ?>
                                                                    <?= $categoria->nome; ?>
                                                                <?php endif; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- INDICE E TRATAMENTO -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Índice</label>
                                                    <select class="selectBusca" name="id_indice" required>
                                                        <option selected value="">Selecione</option>
                                                        <?php foreach ($indices as $indice): ?>
                                                            <option value="<?= $indice->id_indice; ?>">
                                                                <?= $indice->nome; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tratamento</label>
                                                    <select class="selectBusca" name="id_tratamento" required>
                                                        <option selected value="">Selecione</option>
                                                        <?php foreach ($tratamentos as $tratamento): ?>
                                                            <option value="<?= $tratamento->id_tratamento; ?>">
                                                                <?= $tratamento->nome; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SKU E NOME-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" name="nome" value="" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Prazo de entrega médio</label>
                                                    <input type="text" class="form-control" name="prazoEntrega" value="" required />
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Valor Pago E Lucro-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Valor de Custo</label>
                                                    <input type="text" id="valorPago" class="form-control maskValor" name="valorPago" value="" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Porcentagem de Margem (%)</label>
                                                    <input type="text" id="lucro" class="form-control maskValor" name="lucro" value="" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Desconto do fornecedor (%)</label>
                                                    <input type="text" id="descontoFornecedor" class="form-control maskValor" name="descontoFornecedor" value="" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Valor de Venda</label>
                                                    <span style="display: block;" id="valorVenda">-</span>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Desconto E Status-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Desconto máximo (%)</label>
                                                    <input type="text" class="form-control maskValor" name="desconto" value="" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1">Ativo</option>
                                                        <option value="0">Desativo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Descrição do produto</label>
                                                    <textarea id="textarea" name="descricao" class="form-control summernote" maxlength="200" rows="3" placeholder="Descrição da categoria aqui."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                                    <?php endif; ?>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- FIM adicionar usuario -->
    <!-- ============================================================== -->

<?php $this->view("painel/include/footer"); ?>


<script>

    $(document).ready(function(){

        // Basic
        $('.dropify').dropify();

        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                 // set focus to editable area after initializing summernote
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }

        });
    });

</script>