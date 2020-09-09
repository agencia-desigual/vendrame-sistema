<?php $this->view("painel/include/header"); ?>

    <!-- ============================================================== -->
    <!-- Inicio Dashboard -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- BREADCRUMB -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="javascript:void(0);"><?= SITE_NOME; ?></a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- FIM >> BREADCRUMB -->

                <!-- CONTADORES -->
                <div class="row">

                    <!-- USUARIOS -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="fas fa-user-shield bg-primary  text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Usuários</h5>
                                </div>
                                <h3 class="mt-4"><?= $numUsuario; ?></h3>
                            </div>
                        </div>
                    </div>
                    <!-- FIM >> USUARIOS -->

                    <!-- PRODUTOS -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="fas fa-boxes bg-warning text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Produtos</h5>
                                </div>
                                <h3 class="mt-4"><?= $numProduto ?></h3>
                            </div>
                        </div>
                    </div>
                    <!-- FIM >> PRODUTOS -->

                    <!-- MARCAS -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="ti-star bg-success text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Marcas</h5>
                                </div>
                                <h3 class="mt-4"><?= $numMarca; ?></h3>
                            </div>
                        </div>
                    </div>
                    <!-- FIM >> MARCAS -->

                    <!-- CATEGORIAS -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="fas fa-medal bg-danger text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Categorias</h5>
                                </div>
                                <h3 class="mt-4"><?= $numCategoria; ?></h3>
                            </div>
                        </div>
                    </div>
                    <!-- FIM >> CATEGORIAS -->

                </div>
                <!-- FIM >> CONTADORES -->



                <!-- CARDS -->
                <div class="row">

                    <!-- ULTIMAS EMPRESAS -->
                    <div class="col-xl-8">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">
                                    Últimos Produtos

                                    <a href="<?= BASE_URL; ?>painel/produtos" class="float-right btn btn-primary btn-sm">
                                        VER TODOS
                                    </a>
                                </h4>
                                <?php if(!empty($produtos)) : ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">SKU</th>
                                                <th scope="col">NOME</th>
                                                <th scope="col">STATUS</th>
                                                <th scope="col" colspan="2">VALOR VENDA</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($produtos as $prod) : ?>
                                                    <tr>
                                                        <td>#<?= $prod->referencia; ?></td>
                                                        <td><?= $prod->nome; ?></td>
                                                        <td>
                                                            <?php if($prod->status == true): ?>
                                                                <span class="badge badge-success">Ativo</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Inativo</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>R$<?= number_format($prod->valorVenda, 2, ",", "."); ?></td>
                                                        <td>
                                                            <div>
                                                                <a href="<?= BASE_URL; ?>painel/produto/alterar/<?= $prod->id_produto; ?>" class="btn btn-primary btn-sm"
                                                                   data-toggle="tooltip"
                                                                   data-original-title="Detalhes do produtos">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p>Sem produtos</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- FIM >> ULTIMAS EMPRESAS -->

                    <!-- LOJAS POR MÊS -->
                    <div class="col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">
                                    Últimas Marcas

                                    <a href="<?= BASE_URL; ?>painel/marcas" class="float-right btn btn-primary btn-sm">
                                        VER TODAS
                                    </a>
                                </h4>

                                <?php if(!empty($marcas)) : ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col" colspan="2">MARCA</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($marcas as $marca) : ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($marca->logo)): ?>
                                                            <img src="<?= BASE_STORAGE; ?>marca/<?= $marca->logo; ?>" style="max-width: 60px;" />
                                                        <?php else: ?>
                                                            <img src="<?= BASE_URL; ?>assets/custom/img/oculos.svg" style="max-width: 30px;" />
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $marca->nome; ?></td>
                                                    <td>
                                                        <div>
                                                            <a href="<?= BASE_URL; ?>painel/marca/alterar/<?= $marca->id_marca; ?>" class="btn btn-primary btn-sm"
                                                               data-toggle="tooltip"
                                                               data-original-title="Detalhes da marca">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p>Sem marcas</p>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <!-- FIM >> LOJAS POR MÊS -->


                </div>
                <!-- FIM >> CARDS -->

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Fim Dashboard -->
    <!-- ============================================================== -->

<?php $this->view("painel/include/footer"); ?>