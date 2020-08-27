<?php $this->view("painel/include/header"); ?>

    <!-- ============================================================== -->
    <!-- INICIO alterar usuario -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- BREADCUMP -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h4 class="page-title">Alterar Usuários</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/usuarios">Usuários</a></li>
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

                                <h4 class="mt-0 header-title">Alterar Usuário</h4>
                                <p class="sub-title">Altere os dados do usuário.</p>

                                <form id="formAlterarUsuario" data-id="<?= $user->id_usuario ?>">

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nome Completo</label>
                                                <input type="text" class="form-control" name="nome" value="<?= $user->nome; ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nível</label>
                                                <select class="form-control" name="nivel" required>
                                                    <option selected disabled >Selecione</option>
                                                    <option value="admin" <?= ($user->nivel == "admin") ? "selected" : ""; ?>>Admin</option>
                                                    <option value="vendedor" <?= ($user->nivel == "vendedor") ? "selected" : ""; ?>>Vendedor</option>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option selected disabled >Selecione</option>
                                                    <option value="1" <?= ($user->status == true) ? "selected" : ""; ?>>Ativo</option>
                                                    <option value="0" <?= ($user->status == false) ? "selected" : ""; ?>>Inativo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EMAIL E STATUS -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>CPF</label>
                                                <input type="text" class="form-control maskCPF" value="<?= $user->cpf; ?>" name="cpf" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" name="senha" />
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