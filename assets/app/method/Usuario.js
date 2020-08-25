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