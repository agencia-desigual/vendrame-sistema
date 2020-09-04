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
                            <h4 class="page-title">Reajuste</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/produtos">Produtos</a></li>
                                <li class="breadcrumb-item active">Rejuste de Desconto</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- FIM BREADCUMP -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Reajuste de Desconto (%)</h4>
                                <p class="sub-title">Altere multiplos produtos de uma unica vez.</p>

                                <form id="formReajusteProduto">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Filtre por Marca</label>
                                                <select class="form-control" onchange="location.href = '<?= BASE_URL; ?>painel/reajuste/desconto?id_marca=' + this.value;" required name="id_marca">
                                                    <option selected value="0">Selecione a marca</option>
                                                    <?php foreach ($marcas as $marca): ?>
                                                        <option <?= (!empty($get["id_marca"]) && $get["id_marca"] == $marca->id_marca) ? "selected" : ""; ?> value="<?= $marca->id_marca; ?>">
                                                            <?= $marca->nome; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(!empty($get["id_marca"])): ?>
                                        <!-- Categoria e Tipo -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Filtre por Categoria</label>
                                                    <select class="selectBusca" name="id_categoria">
                                                        <option selected value="0">Selecione</option>
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

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Filtre por   Tipo</label>
                                                    <select class="selectBusca" name="id_tipo" required>
                                                        <option selected value="0">Selecione</option>
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
                                        </div>
                                    <?php endif; ?>

                                    <!-- Valor Pago E Lucro-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Porcentagem de Desconto Máximo (%)</label>
                                                <input type="text" class="form-control maskValor" name="desconto" value="" required />
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Alterar Produtos</button>

                                    <a href="<?= BASE_URL; ?>painel/reajuste/desconto" class="btn btn-light float-right mr-3">
                                        Limpar Campos
                                    </a>
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

    });

</script>