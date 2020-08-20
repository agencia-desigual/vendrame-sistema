<?php $this->view("site/include/header"); ?>


    <div class="login" style="background-image: url('<?= BASE_URL ?>assets/theme/site/img/bg.png')">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="espaco-form centraliza-itens-sem-text">
                        <div>
                            <form>
                                <div class="text-center">
                                    <img src="<?= BASE_URL; ?>assets/theme/site/img/logo-branca.png">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="cpf">CPF</label>
                                        <input type="tel" class="form-control maskCPF" id="cpf">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control" id="senha">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7"></div>
            </div>
        </div>
    </div>

<?php $this->view("site/include/footer") ?>