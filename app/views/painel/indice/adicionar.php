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
                            <h4 class="page-title">Inserir Índice</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/indices">Índices</a></li>
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

                                <h4 class="mt-0 header-title">Cadastrar Índice</h4>
                                <p class="sub-title">Cadastre um novo índice no sistema.</p>

                                <form id="formInserirIndice">

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome da índice</label>
                                                <input type="text" class="form-control" name="nome" value="" required />
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

    });

</script>