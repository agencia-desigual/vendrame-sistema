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