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
                            <h4 class="page-title">Alterar Produto</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/produtos">Produtos</a></li>
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

                                <!-- ABAS -->
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link <?= ($pag == 'produto') ? 'active' : ''; ?>" data-toggle="tab" href="#tab-produto" role="tab" aria-selected="false">
                                            <span class="d-none d-md-block">PRODUTO</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>

                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link <?= ($pag == 'atributo') ? 'active' : ''; ?>" data-toggle="tab" href="#tab-atributo" role="tab" aria-selected="true">
                                            <span class="d-none d-md-block">ATRIBUTOS</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>

                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link <?= ($pag == 'ficha') ? 'active' : ''; ?>" data-toggle="tab" href="#tab-ficha" role="tab" aria-selected="false">
                                            <span class="d-none d-md-block">FICHA TÉCNICA</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>

                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link <?= ($pag == 'galeria') ? 'active' : ''; ?>" data-toggle="tab" href="#tab-galeria" role="tab" aria-selected="true">
                                            <span class="d-none d-md-block">GALERIA</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>
                                </ul>


                                <!-- ABAS DAS PAGINAS -->
                                <div class="tab-content">

                                    <!-- PRODUTO -->
                                    <div class="tab-pane p-3 <?= ($pag == 'produto') ? 'active' : ''; ?>" id="tab-produto" role="tabpanel">
                                        <h4 class="mt-0 header-title">Alterar Produto</h4>
                                        <p class="sub-title">Altere o produto, revise todos os dados.</p>

                                        <div class="mb-0">
                                            <form id="formAlterarProduto" data-id="<?= $produto->id_produto; ?>">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Marca</label>
                                                            <span style="display: block"><?= $produto->marca->nome; ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Categoria e Tipo -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Categoria</label>
                                                            <select class="selectBusca" name="id_categoria" required>
                                                                <?php foreach ($categorias as $categoria): ?>
                                                                    <option <?= ($categoria->id_categoria == $produto->id_categoria) ? "selected" : ""; ?> value="<?= $categoria->id_categoria; ?>">
                                                                        <?php if(!empty($categoria->sub)): ?>
                                                                            <?= $categoria->sub; ?>
                                                                        <?php else: ?>
                                                                            <?= $categoria->nome; ?>
                                                                        <?php endif; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tipo</label>
                                                            <select class="selectBusca" name="id_tipo" required>
                                                                <?php foreach ($tipos as $tipo): ?>
                                                                    <option <?= ($tipo->id_tipo == $produto->id_tipo) ? "selected" : ""; ?> value="<?= $tipo->id_tipo; ?>">
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


                                                <!-- SKU E NOME-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Referência (SKU)</label>
                                                            <input type="text" class="form-control" name="referencia" value="<?= $produto->referencia; ?>" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nome</label>
                                                            <input type="text" class="form-control" name="nome" value="<?= $produto->nome; ?>" required />
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Valor Pago E Lucro-->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Valor Pago</label>
                                                            <input type="text" id="valorPago" class="form-control maskValor" name="valorPago" value="<?= number_format($produto->valorPago, 2, "",""); ?>" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Porcentagem de lucro</label>
                                                            <input type="text" id="lucro" class="form-control maskValor" name="lucro" value="<?= number_format($produto->lucro, 2, "",""); ?>" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Valor de Venda</label>
                                                            <span style="display: block;" id="valorVenda">R$<?= number_format($produto->valorVenda, 2, ",","."); ?></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Desconto E Status-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Desconto máximo (%)</label>
                                                            <input type="text" class="form-control maskValor" name="desconto" value="<?= number_format($produto->desconto, 2, "",""); ?>" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" name="status">
                                                                <option <?= ($produto->status == true) ? "selected" : ""; ?> value="1">Ativo</option>
                                                                <option <?= ($produto->status == false) ? "selected" : ""; ?> value="0">Desativo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <button type="submit" class="btn btn-primary float-right">Alterar</button>
                                            </form>
                                        </div>
                                    </div>


                                    <!-- GALERIA -->
                                    <div class="tab-pane p-3 <?= ($pag == 'galeria') ? 'active' : ''; ?>" id="tab-galeria" role="tabpanel">
                                        <p class="mb-0">
                                        <form id="formInserirImagemProduto" data-id="<?= $produto->id_produto; ?>">

                                            <!-- IMAGEM -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Imagem</label>
                                                        <input name="arquivo" type="file" class="dropify">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- STATUS -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Essa imagem é a principal?</label>
                                                        <div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" value="1" name="principal">
                                                                <label class="custom-control-label" for="customCheck1">SIM</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <div style="margin-top: 50px; margin-bottom: 50px" >
                                            <hr>
                                        </div>

                                        <?php if (!empty($produto->galeria)) : ?>
                                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">IMAGEM</th>
                                                    <th class="text-center" scope="col">PRINCIPAL</th>
                                                    <th class="text-center" scope="col">AÇÕES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($produto->galeria as $galeria) :?>
                                                    <tr id="tb_img_<?= $galeria->id_imagem; ?>">
                                                        <td class="text-center">
                                                            <img width="50px" src="<?= $galeria->thumb; ?>">
                                                        </td>

                                                        <td class="text-center">
                                                            <?php if ($galeria->principal == 1) : ?>
                                                                <span class="badge badge-success">SIM</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-warning">NÃO</span>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php if ($galeria->principal != true) : ?>
                                                                <button data-id="<?= $galeria->id_imagem; ?>"
                                                                        data-produto="<?= $produto->id_produto; ?>"
                                                                        class="imagemPrincipal btn btn-primary btn-icon btn-sm mr-2">
                                                                    <i class="fas fa-star"></i>
                                                                </button>

                                                                <button data-id="<?= $galeria->id_imagem; ?>"
                                                                        class="deletarImagemProduto btn btn-danger btn-icon btn-sm mr-2">
                                                                    <i class="fas fa-window-close"></i>
                                                                </button>
                                                            <?php else: ?>
                                                                -
                                                            <?php endif; ?>


                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        </p>
                                    </div>


                                    <!-- FICHA TÉCNICA -->
                                    <div class="tab-pane p-3 <?= ($pag == 'ficha') ? 'active' : ''; ?>" id="tab-ficha" role="tabpanel">
                                        <p class="mb-0">
                                            <form id="formInserirFichaTecnica" data-id="<?= $produto->id_produto; ?>">
                                                <h4 class="mt-0 header-title">Ficha Técnica</h4>
                                        <p class="sub-title">Cadastre informações sobre o produto.</p>

                                        <!-- IMAGEM -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Campo</label>
                                                    <input name="campo" type="text" class="form-control" placeholder="Ex: Altura" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Descrição</label>
                                                    <input name="descricao" type="text" class="form-control" placeholder="Ex: 1,2 metros" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- STATUS -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

                                        <div style="margin-top: 50px; margin-bottom: 50px" >
                                            <hr>
                                        </div>

                                        <?php if (!empty($produto->ficha)) : ?>
                                            <table id="datatable" class="datatable-ficha table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">CAMPO</th>
                                                    <th class="text-center" scope="col">DESCRIÇÃO</th>
                                                    <th class="text-center" scope="col">AÇÕES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($produto->ficha as $ficha) :?>
                                                    <tr id="tb_ficha_<?= $ficha->id_ficha_tecnica; ?>">

                                                        <td class="text-center"><?= $ficha->campo; ?></td>
                                                        <td class="text-center"><?= $ficha->descricao; ?></td>

                                                        <td class="text-center">
                                                            <button data-id="<?= $ficha->id_ficha_tecnica; ?>"
                                                                    class="deletarFichaTecnica btn btn-danger btn-icon btn-sm mr-2">
                                                                <i class="fas fa-window-close"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        </p>
                                    </div>

                                </div>

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