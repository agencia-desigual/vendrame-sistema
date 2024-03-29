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
                            <h4 class="page-title">Alterar Serviço</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/servicos">Serviços</a></li>
                                <li class="breadcrumb-item active">Alterar</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- FIM BREADCUMP -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Alterar Serviço</h4>
                                <p class="sub-title">Altere um serviço já cadastrado.</p>

                                <form id="formAlterarServico" data-id="<?= $servico->id_servico; ?>">

                                    <!-- MARCA E TIPO -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marca</label>
                                                <select class="form-control selecionaMarca" name="id_marca">
                                                    <option value="" selected>Sem marcar</option>
                                                    <?php foreach ($marcas as $marca): ?>
                                                        <option <?= ($servico->id_marca == $marca->id_marca) ? "selected" : ""; ?> value="<?= $marca->id_marca; ?>">
                                                            <?= $marca->nome; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select class="form-control" name="tipo">
                                                    <option <?= ($servico->tipo == "servico") ? "selected" : ""; ?> value="servico">Serviços e tratamentos</option>
                                                    <option <?= ($servico->tipo == "padronizacao") ? "selected" : ""; ?> value="padronizacao">Padronizações Vendrame</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- NOME E VALOR -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" name="nome" value="<?= $servico->nome; ?>" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Valor</label>
                                                <input type="text" class="form-control maskValor" name="valor" value="<?= number_format($servico->valor, 2, '.',''); ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option <?= ($servico->status == true) ? "selected" : ""; ?> value="1">Ativo</option>
                                                    <option <?= ($servico->status == false) ? "selected" : ""; ?> value="0">Desativo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- DESCRICAO -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descrição do produto</label>
                                                <textarea id="textarea" name="descricao" class="form-control summernote" maxlength="200" rows="3" placeholder="Descrição da categoria aqui."><?= $servico->descricao; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
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