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
                            <h4 class="page-title">Alterar Tipo</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/tipos">Tipos</a></li>
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

                                <h4 class="mt-0 header-title">Alterar Tipo</h4>
                                <p class="sub-title">Alterar informações do tipo.</p>

                                <form id="formAlterarTipo" data-id="<?= $tipo->id_tipo; ?>">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Marca</label> <br>
                                                <span><?= $marca->nome; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome do tipo</label>
                                                <input type="text" class="form-control" name="nome" value="<?= $tipo->nome; ?>" required />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Tipo Pai</label>
                                                <select class="selectBusca" name="id_tipo_pai">
                                                    <option selected value="">Selecione</option>
                                                    <?php foreach ($tipos as $tip): ?>
                                                        <option value="<?= $tip->id_tipo; ?>" <?= ($tip->id_tipo == $tipo->id_tipo_pai) ? "selected" : ""; ?>>
                                                            <?php if($tip->id_marca == $tipo->id_marca && $tip->id_tipo != $tipo->id_tipo): ?>

                                                                <?php if(!empty($tip->sub)): ?>
                                                                    <?= $tip->sub; ?>
                                                                <?php else: ?>
                                                                    <?= $tip->nome; ?>
                                                                <?php endif; ?>

                                                            <?php endif; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary float-right">Alterar</button>
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
