import Global from "../global.js"


/*
* ===========================================================
* MÉTODOS NA INDEX ==========================================
* ===========================================================
*/

// $(".categoria").on("click",function () {
//
//     // Pega a categoria
//     var categoria = $(this).data('id');
//     var conteudo = "";
//
//
//     var token = Global.session.get('token');
//     var url = Global.config.urlApi + 'categoria/get?where[id_categoria_pai]='+categoria+"limit=99999";
//
//     // Realiza a requisição
//     Global.enviaApi("GET", url, null, token.token,"alertify")
//         .then((data) => {
//
//             if (data.objeto.total > 0)
//             {
//
//                 $.each(data.objeto.itens, function(index, item) {
//                     conteudo += "                                   <div class=\"input-group mb-3\">\n" +
//                         "                                        <div class=\"input-group-prepend\">\n" +
//                         "                                            <div class=\"input-group-text\">\n" +
//                         "                                                <input class=\"categoria\" data-id="+item.id_categoria+" name=\"categoria\" type=\"radio\">\n" +
//                         "                                                <span>"+item.nome+"</span>\n" +
//                         "                                            </div>\n" +
//                         "                                        </div>\n" +
//                         "                                    </div>"
//                     console.log(item)
//                 });
//
//                 $("#categoriaPAI").fadeOut(200);
//                 $("#categoriaFILHAS").fadeIn(500);
//                 $(".categoriasFilhas").html(conteudo);
//             }
//
//
//             // Redireciona o usuário
//             // location.href = link;
//         })
//         .catch((data) => {
//
//             // Redireciona o usuário
//             // location.href = link;
//         });
//
// });


/**
 * Método responsável por buscar as marcas
 * na pagina de listagem de produtos.
 * NÃO USAR AGORA
 */
// $("#pesquisaProduto").keyup(function () {
//
//     // Pega o valor digitado
//     var pesquisa = $("#pesquisa").val();
//     var qtdeCaracteres =  $("#pesquisa").val().length;
//
//     // Deixa minusculo
//     pesquisa = pesquisa.toLocaleLowerCase();
//
//     // Faz a busca acima de 3 caracteres
//     if (qtdeCaracteres >= 3)
//     {
//
//         // Não atualiza a página
//         event.preventDefault();
//
//         // Recupera os dados do formulário
//         var form = new FormData(this);
//         var conteudo = "";
//
//         // Url e token
//         var url = Global.config.urlApi + "produto/pesquisa/"+pesquisa;
//
//         // Realiza a requisição
//         Global.enviaApi("POST", url, form, null)
//             .then((data) => {
//
//                 // Encontrou algum produto
//                 if (data.produtos.length > 0)
//                 {
//                     console.log(data.produtos);
//
//                     $.each( data.produtos, function( chave,produto ) {
//                         conteudo += "<a href='"+Global.config.url+"app/produto/detalhes/"+produto.id_produto+"'><div class='row mb-2'><div class='col-2'><div class='img' style='background-image: url("+produto.img.thumb+")'></div></div>";
//                         conteudo += "<div class='col-10'> <div class='nome'><p>"+produto.nome+"</p></div> <div class='empresa'><p>"+produto.empresa.nome+"</p></div></div></div></a>";
//                     });
//                     $("#conteudo-resultado").html(conteudo);
//                     $(".resultado-pesquisa").fadeIn(500);
//                 }
//                 else
//                 {
//                     conteudo = "<div class='row' style='padding: 10px'><div class='col-12'><p style='font-size: 10px;font-style: italic;'>Sem resultados</p><a style='font-size: 14px;color: #00acf1;' href='"+Global.config.url+"app/produtos?c=true&b="+pesquisa+"'>Buscar "+pesquisa+"</a></div></div>"
//                     $("#conteudo-resultado").html(conteudo);
//                     $(".resultado-pesquisa").fadeIn(500);
//                 }
//
//
//             })
//             .catch((error) => {
//                 // Desbloqueia o formulário
//                 $(this).removeClass("bloqueiaForm");
//             });
//
//     }
//     else
//     {
//         $(".resultado-pesquisa").fadeOut(500);
//     }
//
// });


// Retorno para os demais arquivos
export default (() => {

    return null;

})();