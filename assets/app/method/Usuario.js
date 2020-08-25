import Global from "../global.js"

/**
 * Método responsável por receber os dados os dados
 * e solicitar um requisição para que seja feio o login
 * do usuário.
 * ---------------------------------------------------------
 */
$("#formLogin").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Dados de login
    var usuario = form.get("usuario");
    var senha = form.get("senha");

    // Realiza a requisição
    realizaLogin(usuario,senha)
        .then(function(data){

            // Salva a session
            Global.session.set("usuario", data.objeto.usuario);
            Global.session.set("token", data.objeto.token);

            // Avisa que deu certo
            Global.setSuccess(data.mensagem, "alertify");

            // Atualiza a página
            setTimeout(() => {

                // Verifica se é admin
                if(data.objeto.usuario.nivel === "admin")
                {
                    // Manda para o painel
                    location.href = Global.config.url + "painel";
                }
                else
                {
                    // Redireciona para a pagina inicial
                    location.href = Global.config.url;
                }

            }, 800);

        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Desbloqueia o formulário
    $(this).removeClass("bloqueiaForm");

    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por cadastrar uma nova newsletter
 * enviado seus dados para a API correspndente.
 * ---------------------------------------------------------
 * @author edilson-pereira
 */
$("#formInserirUsuario").on("submit", function(){

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera a session
    var token = Global.session.get("token");

    // Recupera o url
    var url = Global.config.urlApi + "usuario/insert";

    // Realiza a requisição
    Global.enviaApi("POST", url, form,token.token, "swal")
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess("Cadastro realizado com sucesso!");

            // Atualiza a pagina
            setTimeout(function () {
                location.reload();
            },1500);

            // Limpa o formulário
            Global.limparFormulario("#formInserirUsuario");

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



/**
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 */
$(".deletarUsuario").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "usuario/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: "Deletar usuário",
        text: "Realmente deseja deletar esse usuário?",
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
 * Método responsável por realizar o login
 * --------------------------------------------------
 * @param user string
 * @param senha string
 * ----------------------------------------------------------
 * @author igorcacerez
 * */
function realizaLogin(user, senha)
{
    return new Promise(function (resolve, reject) {

        // Configura o Header a ser enviado
        $.ajaxSetup({
            async: false,
            headers:{
                'Authorization': "Basic " + window.btoa(user + ":" + senha)
            }
        });

        // Faz o envio do post
        $.post(Global.config.urlApi + "usuario/login", null, (data) => {

            if(data.tipo === true)
            {
                resolve(data);
            }
            else
            {
                // Avisa que deu merda
                Global.setError(data.mensagem, "alertify");

                reject(true);
            }

        }, "json");
    });

} // End >> Fun::realizaLogin()