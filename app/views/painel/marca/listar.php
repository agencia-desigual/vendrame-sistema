<?php $this->view("painel/include/header"); ?>

    <!-- ============================================================== -->
    <!-- INICIO da listagem de administradores -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                <!-- BREADCUMP -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h4 class="page-title">Marcas</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item active">Marcas</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- FIM BREADCUMP -->

                <!-- ADMINISTRADORES -->
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">TODAS AS MARCAS</h4>
                                <p class="sub-title../plugins">Gerencie as marcas, você também pode exportar todas.</p>

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col">IMG</th>
                                        <th scope="col">NOME</th>
                                        <th scope="col">PRODUTOS</th>
                                        <th class="text-center" scope="col">AÇÕES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <tr id="tb_<?= $marca->id_marca ?>">
                                            <td>
                                                <?php if(!empty($marca->logo)): ?>
                                                    <img src="<?= BASE_STORAGE; ?>marca/<?= $marca->logo; ?>" style="max-width: 80px;" />
                                                <?php else: ?>
                                                    <img src="<?= BASE_URL; ?>assets/custom/img/oculos.svg" style="max-width: 50px;" />
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $marca->nome ?></td>
                                            <td><?= $marca->produtos; ?></td>

                                            <td class="text-center">
                                                <button data-id="<?= $marca->id_marca; ?>"
                                                        class="deletarMarca btn btn-danger btn-icon btn-sm mr-2"
                                                        data-toggle="tooltip" data-original-title="Deletar">
                                                    <i class="fas fa-window-close"></i>
                                                </button>

                                                <a href="<?= BASE_URL; ?>painel/marca/alterar/<?= $marca->id_marca; ?>"
                                                   class="btn btn-primary btn-icon btn-sm"
                                                   data-toggle="tooltip"
                                                   data-original-title="Alterar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CLIENTES -->

            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->


    </div>
    <!-- ============================================================== -->
    <!-- FIM da listagem -->
    <!-- ============================================================== -->

<?php $this->view("painel/include/footer"); ?>
