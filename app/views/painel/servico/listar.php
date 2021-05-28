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
                            <h4 class="page-title">Serviços</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item active">Serviços</li>
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

                                <h4 class="mt-0 header-title">TODOS OS SERVIÇOS</h4>
                                <p class="sub-title../plugins">Gerencie os serviços, você também pode exportar todos.</p>

                                <div class="dt-ext table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th scope="col">NOME</th>
                                            <th scope="col">MARCA</th>
                                            <th scope="col">TIPO</th>
                                            <th scope="col">VALOR</th>
                                            <th scope="col">STATUS</th>
                                            <th class="text-center" scope="col">AÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($servicos as $servico) : ?>
                                            <tr id="tb_<?= $servico->id_servico; ?>">
                                                <td><?= $servico->nome; ?></td>
                                                <td><?= $servico->marca; ?></td>
                                                <td><?= ($servico->tipo == "servico" ? "Serviços e tratamentos" : "Padronizações Vendrame"); ?></td>
                                                <td>R$<?= number_format($servico->valor, 2, ",","."); ?></td>

                                                <td>
                                                    <?php if($servico->status == true): ?>
                                                        <span class="badge badge-success">ATIVO</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">DESATIVADO</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-center">
                                                    <button data-id="<?= $servico->id_servico; ?>"
                                                            class="deletarServico btn btn-danger btn-icon btn-sm mr-2"
                                                            data-toggle="tooltip" data-original-title="Deletar">
                                                        <i class="fas fa-window-close"></i>
                                                    </button>

                                                    <a href="<?= BASE_URL; ?>painel/servico/alterar/<?= $servico->id_servico; ?>"
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
