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
                            <h4 class="page-title">Inserir Usuário</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/usuarios">Usuários</a></li>
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

                                <h4 class="mt-0 header-title">Cadastrar Usuário</h4>
                                <p class="sub-title">Cadastre um novo usuário, para ter acesso ao sistema.</p>

                                <form id="formInserirUsuario">

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome Completo</label>
                                                <input type="text" class="form-control" name="nome" value="" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nível</label>
                                                <select class="form-control" name="nivel" required>
                                                    <option selected disabled >Selecione</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="vendedor">Vendedor</option>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option selected disabled >Selecione</option>
                                                    <option value="1">Ativo</option>
                                                    <option value="0">Inativo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EMAIL E STATUS -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>CPF</label>
                                                <input type="text" class="form-control maskCPF" name="cpf" value="" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" name="senha" value="" required/>
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
