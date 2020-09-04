import Global from "../global.js"


/**
 * Método responsável por cadastrar uma nova newsletter
 * enviado seus dados para a API correspndente.
 * ---------------------------------------------------------
 * @author edilson-pereira
 */
$("#formInserirProduto").on("submit", function(){

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera a session
    var token = Global.session.get("token");

    // Recupera o url
    var url = Global.config.urlApi + "produto/insert";

    // Realiza a requisição
    Global.enviaApi("POST", url, form,token.token)
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Atualiza a página
            setTimeout(() => {
                location.href = Global.config.url + "painel/produto/adicionar";
            }, 1000);

        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 */
$(".deletarProduto").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "produto/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: "Deletar Produto",
        text: "Realmente deseja deletar esse produto?",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    $('#datatable-buttons')
                        .DataTable()
                        .row("#tb_" + id)
                        .remove()
                        .draw(false);

                });
        }
    });


    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por cadastrar um nova newsletter
 * enviado seus dados para a API correspndente.
 */
$("#formAlterarProduto").on("submit", function(){

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);
    var id = $(this).data("id");
    var token = Global.session.get("token");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera o url
    var url = Global.config.urlApi + "produto/update/"+id;

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token)
        .then((data) => {

            // Limpa o form
            $(".dropify-clear").trigger("click");

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");

        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;
});


/*
* ===========================================================
* MÉTODOS SECUNDARIOS =======================================
* ===========================================================
*/

/**
 * Método responsável por realizar o calculo do
 * valor em que o produto deve ser vendido.
 */
$(".selecionaMarca").on("change", function () {

    // Marca selecionada
    var marca = this.value;

    // Url
    var url = Global.config.url + "painel/produto/adicionar?marca=" + marca;

    // Redireciona
    location.href = url;

});


/**
 * Método responsável por realizar o calculo do
 * valor em que o produto deve ser vendido.
 */
$("#lucro").keyup(function () {

    var pago = $("#valorPago").val();
    var lucro = $(this).val();

    // limpa
    pago = pago.replace(".","");
    pago = pago.replace(",",".");
    parseFloat(pago);

    lucro = lucro.replace(".","");
    lucro = lucro.replace(",",".");
    parseFloat(lucro);

    console.log(pago);
    console.log(lucro);

    // Calcula a valor
    var valorLucro = parseFloat(parseFloat((parseFloat(lucro) / 100) * parseFloat(pago)) + parseFloat(pago));

    console.log(valorLucro);

    $("#valorVenda").html(Global.formatMoney(valorLucro, 2,"R$",".",","));
});



/*
* ===========================================================
* IMAGEM DO PRODUTO =========================================
* ===========================================================
*/


/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$("#formInserirImagemProduto").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);
    var id = $(this).data("id");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Url e token
    var url = Global.config.urlApi + "imagem/insert/" + id;
    var token = Global.session.get("token");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token)
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Redireciona para a página do produto
            setTimeout(() => {
                location.href = Global.config.url + "painel/produto/alterar/" + id + "/galeria";
            }, 500);
        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;

});



/**
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 */
$(".deletarImagemProduto").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "imagem/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Deletar Imagem',
        text: 'Deseja realmente deletar essa imagem?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    $('#datatable')
                        .DataTable()
                        .row("#tb_img_" + id)
                        .remove()
                        .draw(false);


                });
        }
    });


    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$(".imagemPrincipal").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados
    var id = $(this).data("id");
    var idProduto = $(this).data("produto");

    // Url e token
    var url = Global.config.urlApi + "imagem/principal/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Alterar Princial',
        text: 'Deseja tornar essa imagem a principal?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("PUT", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Redireciona para a página do produto
                    setTimeout(() => {
                        location.href = Global.config.url + "painel/produto/alterar/" + idProduto + "/galeria";
                    }, 500);

                });
        }
    });

    // Não atualiza
    return false;
});


/*
* ===========================================================
* ATRIBUTO DO PRODUTO =======================================
* ===========================================================
*/

$("#formInserirAtributoProduto").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Ids
    var id = $(this).data("id");
    var form = new FormData(this);

    var idAtr = form.get("id_atributo");


    // Url e token
    var url = Global.config.urlApi + "atributo/produto/" + id + "/" + idAtr;
    var token = Global.session.get("token");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Realiza a solicitação
    Global.enviaApi("POST", url, null, token.token)
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Redireciona para a página do produto
            setTimeout(() => {
                location.href = Global.config.url + "painel/produto/alterar/" + id + "/atributo";
            }, 500);

        })
        .catch((data) => {

            // Bloqueia o formulário
            $(this).removeClass("bloqueiaForm");

        });

    // Não atualiza
    return false;
});


/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$(".deletarAtributoProduto").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados
    var id = $(this).data("id");

    // Url e token
    var url = Global.config.urlApi + "atributo/produto/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Deletar Atributo',
        text: 'Deseja deletar esse atributo do produto?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Redireciona para a página do produto
                    setTimeout(() => {
                        location.href = Global.config.url + "painel/produto/alterar/" + id + "/atributo";
                    }, 500);

                });
        }
    });

    // Não atualiza
    return false;
});



/**
 * Reajustar o valor pago, lucro ou desconto máximo
 * de todos os produtos, usando filtro.
 */
$("#formReajusteProduto").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados
    var form = new FormData(this);
    var url = Global.config.urlApi + "produto/reajuste";
    var token = Global.session.get("token").token;

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Alterar Produtos',
        text: 'Deseja realmente alterar as informações dos produtos?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value) {
            // Bloqueia
            $(this).addClass("bloqueiaForm");

            // Faz a solicitação
            Global.enviaApi("POST", url, form, token)
                .then((data) => {

                    // Informa que deu certo
                    Global.setSuccess("Foram alterados um total de " + data.objeto.total + " produtos");

                    // Remove o bloqueio
                    $(this).removeClass("bloqueiaForm");
                })
                .catch((data) => {
                    // Remove o bloqueio
                    $(this).removeClass("bloqueiaForm");
                });
        }
    });
});

/*
* ===========================================================
* MÉTODOS PARA OP SITE ======================================
* ===========================================================
*/

/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$(".validarDesconto").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // bloqueia a tela
    $(".body").addClass("bloqueiaBody");

    // Recupera os dados
    var idUsuario = $(this).data("id-usuario");
    var idProduto = $(this).data("id-produto");

    var form = new FormData();

    form.set("id_usuario", idUsuario);
    form.set("id_produto", idProduto);

    // Url e token
    var url = Global.config.urlApi + "produto/desconto";
    var token = Global.session.get("token");

    // Realiza a solicitação
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then((data) => {

            // Redireciona para a página do produto
            setTimeout(() => {

                // Desbloqueia a tela
                $(".body").removeClass("bloqueiaBody");

                // Pega o valor com desconto
                $(".price-old").css("display","inline-block");
                $("#valorProduto").html("R$ " + data.objeto.valorVenda);

            }, 3000);

        })
        .catch((data) => {
            $(".body").removeClass("bloqueiaBody");
        });

    // Não atualiza
    return false;
});



/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente requisitados no banco.
 */
$("#pesquisaProduto").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Bloqueia o formulário
    $(".body").addClass("bloqueiaBody");

    // Ids
    var form = new FormData(this);
    var busca = form.get("busca");

    // Url e token
    var url = Global.config.url + "produtos?c=true&busca=" + busca  ;

    // Realiza a solicitação
    setTimeout(function () {

        // Redireciona
        location.href = url;

        // Bloqueia o formulário
        $(".body").removeClass("bloqueiaBody");

    },2000);

    // Não atualiza
    return false;
});