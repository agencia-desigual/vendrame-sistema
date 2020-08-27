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
                            <h4 class="page-title">Alterar Atributo</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/atributos">Atributos</a></li>
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

                                <h4 class="mt-0 header-title">Alterar Atributo</h4>
                                <p class="sub-title">Alterar as informações um atributo.</p>

                                <form id="formAlterarAtributo" data-id="<?= $atributo->id_atributo; ?>">

                                    <!-- NOME -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" name="nome" value="<?= $atributo->nome; ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DESCRICAO -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Descrição</label>
                                                <input type="text" class="form-control" name="descricao" value="<?= $atributo->descricao; ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ARQUIVO -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Imagem Ilustrativa</label>
                                                <input type="file" name="arquivo" class="dropify" />
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


<script>

    $(document).ready(function(){

        // Basic
        $('.dropify').dropify();

    });

</script>