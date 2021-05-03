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
                            <h4 class="page-title">Alterar Categoria</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/categorias">Categorias</a></li>
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

                                <h4 class="mt-0 header-title">Alterar Categoria</h4>
                                <p class="sub-title">Alterar informações da categoria.</p>

                                <form id="formAlterarCategoria" data-id="<?= $categoria->id_categoria; ?>">

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome da categoria</label>
                                                <input type="text" class="form-control" name="nome" value="<?= $categoria->nome; ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_categoria_pai" value="" />

                                    <!--
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Categoria Pai</label>
                                                <select class="selectBusca" name="id_categoria_pai">
                                                    <option selected value="">Selecione</option>
                                                    <?php foreach ($categorias as $cat): ?>
                                                        <option value="<?= $cat->id_categoria; ?>" <?= ($cat->id_categoria == $categoria->id_categoria_pai) ? "selected" : ""; ?>>
                                                            <?php if($cat->id_marca == $categoria->id_marca && $cat->id_categoria != $categoria->id_categoria): ?>

                                                                <?php if(!empty($cat->sub)): ?>
                                                                    <?= $cat->sub; ?>
                                                                <?php else: ?>
                                                                    <?= $cat->nome; ?>
                                                                <?php endif; ?>

                                                            <?php endif; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    -->


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
