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
                                <li class="breadcrumb-item active">Rejuste de Valor Pago</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- FIM BREADCUMP -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Reajuste de valor de custo</h4>
                                <p class="sub-title">Altere multiplos produtos de uma unica vez.</p>

                                <form id="formReajusteProduto">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Filtre por Marca</label>
                                                <select class="form-control" onchange="location.href = '<?= BASE_URL; ?>painel/reajuste/valor-pago?id_marca=' + this.value;" required name="id_marca">
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
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Filtre por linha</label>
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
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ação</label>
                                                    <select class="form-control" name="acao">
                                                        <option value="aumentar">Aumentar</option>
                                                        <option value="diminuir">Diminuir</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Valor (%)</label>
                                                    <input type="text" class="form-control maskValor" name="valorPago" value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Alterar Produtos</button>

                                    <a href="<?= BASE_URL; ?>painel/reajuste/valor-pago" class="btn btn-light float-right mr-3">
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