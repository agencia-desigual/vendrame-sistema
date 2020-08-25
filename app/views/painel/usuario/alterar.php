<?php $this->view("painel/admin/include/header"); ?>

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
                            <h4 class="page-title">Alterar Administrador</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel/administradores">Administrador</a></li>
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

                                <h4 class="mt-0 header-title">Alterar Administrador</h4>
                                <p class="sub-title">Altere os dados do administrador.</p>

                                <form id="formAlterarUsuario" data-id="<?= $admin->id_usuario ?>" data-alerta="swal">

                                    <!-- NOME, NIVEL E ID DO ADMIN -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nome Completo</label>
                                                <input type="text" class="form-control" name="nome" value="<?= $admin->nome ?>" required/>
                                            </div>


                                            <div class="col-md-6">
                                                <label>Nível</label>
                                                <select class="form-control" name="nivel" required>
                                                    <option selected disabled >Selecione</option>
                                                    <option <?= ($admin->nivel == "admin") ? 'selected' : '' ?> value="admin">Admin</option>
                                                    <option <?= ($admin->nivel == "representante") ? 'selected' : '' ?> value="representante">Representante</option>
                                                    <option <?= ($admin->nivel == "anunciante") ? 'selected' : '' ?> value="anunciante">Anunciante</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EMAIL E STATUS -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" name="email" value="<?= $admin->email ?>" required/>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option selected disabled >Selecione</option>
                                                    <option <?= ($admin->status == 1) ? 'selected' : '' ?> value="1">Ativo</option>
                                                    <option <?= ($admin->status == 0) ? 'selected' : '' ?> value="0">Inativo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SENHA E CONFIRMA SENHA -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" name="senha" value=""/>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Confirma Senha</label>
                                                <input type="password" class="form-control" name="repete_senha" value=""/>
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

<?php $this->view("painel/admin/include/footer"); ?>

<script>

    $(document).ready(function(){

        // Basic
        $('.dropify').dropify();

    });

</script>