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
                            <h4 class="page-title">Inserir Tipo</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/tipos">Tipos</a></li>
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

                                <h4 class="mt-0 header-title">Cadastrar Tipo</h4>
                                <p class="sub-title">Cadastre um novo tipo no sistema.</p>

                                <form id="formInserirTipo">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
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
                                        <!-- NOME E NIVEL -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Nome do tipo</label>
                                                    <input type="text" class="form-control" name="nome" value="" required />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Tipo Pai</label>
                                                    <select class="selectBusca" name="id_tipo_pai">
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

    });

</script>