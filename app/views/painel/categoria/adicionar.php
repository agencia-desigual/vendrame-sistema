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
                            <h4 class="page-title">Inserir Categoria</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/categorias">Categorias</a></li>
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

                                <h4 class="mt-0 header-title">Cadastrar Categoria</h4>
                                <p class="sub-title">Cadastre uma nova categoria no sistema.</p>

                                <form id="formInserirCategoria">

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome da categoria</label>
                                                <input type="text" class="form-control" name="nome" value="" required />
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
                                                        <option value="<?= $cat->id_categoria; ?>">
                                                            <?php if($cat->id_marca == $get["marca"]): ?>
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

    });

</script>