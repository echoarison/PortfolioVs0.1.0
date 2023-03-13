/*navegacaoInformacaoSACandPortfolio*/
function navegacaoInfo(value){
    //declarando variavel local
    var botaoClass, secaoInfoClass,listClassDiv;
    
    /*
    *
    *guardando uma lista de className q possui a class botao one
    * 
    * 
    * */
    botaoClass = document.getElementsByClassName('botaoOne');     //guardando o nome da class em uma variavel
    secaoInfoClass = document.getElementsByClassName('secaoInfo');
    listClassDiv = botaoClass[value].classList;       //guardando a lista da div em questão

    /**
     * 
     * Convertendo para string para usar o indexOf
     * e depois usar parseInt converte em numero
     * 
     * */
    listClassDiv = listClassDiv.toString();
    listClassDiv = listClassDiv.indexOf("butonActvie");
    listClassDiv = parseInt(listClassDiv);

    //Fazendo a mudança de conteudo
    if(listClassDiv == -1){
        
        switch(value){
            case 0:
                botaoClass[value].classList.add("butonActvie");
                secaoInfoClass[1].classList.add("noVisive");
                botaoClass[1].classList.remove("butonActvie");
                secaoInfoClass[value].classList.remove("noVisive");
            break;
            
            case 1:
                botaoClass[value].classList.add("butonActvie");
                secaoInfoClass[0].classList.add("noVisive");
                botaoClass[0].classList.remove("butonActvie");
                secaoInfoClass[value].classList.remove("noVisive");
            break;
            
            default:
                alert("Erro no valores da função!");
            break;    
        }

    }

}
/*fim*/

/*trocaDeIconesAndOfParallax*/
function iconesAndParallax(){

    //declarando variaveis locais
    var icone, paralax, contato, fundo;

    icone = document.getElementsByClassName("icone");
    paralax = document.getElementsByClassName("parallax");
    contato = document.getElementsByClassName("iconeContato");
    fundo = document.getElementsByClassName("testeFundo");

    //informações
    icone[1].style.backgroundImage = "url('./Img/Icones/document.png')";
    icone[2].style.backgroundImage = "url('./Img/Icones/scriptDesen.png')";

    //Paralax
    paralax[0].style.backgroundImage = "url(./Img/imagens/parallax01.jpg)";
    paralax[1].style.backgroundImage = "url(./Img/imagens/parallax01.jpg)";
    paralax[2].style.backgroundImage = "url(./Img/imagens/parallax03.jpg)";
    paralax[3].style.backgroundImage = "url(./Img/imagens/parallax03.jpg)";

    //testeFundo
    fundo[2].style.backgroundImage = "url(./Img/imagens/parallax03.jpg)";
    
    //Contato
    contato[0].style.backgroundImage = "url(./Img/Icones/call.png)";
    contato[1].style.backgroundImage = "url(./Img/Icones/email.png)";
    contato[2].style.backgroundImage = "url(./Img/Icones/whatsapp.png)";
    contato[3].style.backgroundImage = "url(./Img/Icones/facebook.png)";
    contato[4].style.backgroundImage = "url(./Img/Icones/instagram.png)";


}

/*fimTrocaDeIconesAndOfParallax*/

/*Menu Responsivo*/
function menuResponsivoUser(value,preguica2,preguica){
    var itensLinks, btnRespon, janela, noItensClass;

    //guardando o valor
    itensLinks = document.getElementById('usuarioMenu');
    btnRespon = document.getElementsByClassName('menuUser')[0];
    noItensClass = document.getElementsByClassName('noItensUser')[0];
    janela = value;

    if(noItensClass.style.visibility === "hidden"){

        itensLinks.classList.remove("yesItensUser");
        itensLinks.classList.add("noItensUser");



    }else {

        btnRespon.style.zIndex = "-1";
        itensLinks.classList.add("yesItensUser");
        itensLinks.classList.remove("noItensUser");

        
    }

    window.onclick = function(event) {
        if (event.target == janela || event.target == preguica2 || event.target == preguica) {
          itensLinks.classList.add("noItensUser");
          btnRespon.style.zIndex = "1";
        }
    }
}

function menuResponsivo(value, preguica, preguica2){
    var itensLinks, btnRespon, janela, noItensClass;

    //guardando o valor
    itensLinks = document.getElementById('linksMenu');
    btnRespon = document.getElementsByClassName('menuRespBtn')[0];
    janela = value;
    noItensClass = document.getElementsByClassName('noItens')[0];

    if(noItensClass.style.display === "none" || noItensClass.style.visibility === "hidden"){

        //alert("foi!!");
        itensLinks.classList.remove("yesItens");
        itensLinks.classList.add("noItens");

    }else {

        //alert("não foi");
        itensLinks.classList.add("yesItens");
        itensLinks.classList.remove("noItens");
        btnRespon.style.zIndex = "-1";

        
    }

    window.onclick = function(event) {
        if (event.target == janela || event.target == itensLinks || event.target == preguica || event.target == preguica2) {
          //alert(value);
          itensLinks.classList.add("noItens");
          itensLinks.classList.remove("yesItens");
          btnRespon.style.zIndex = "1";
        }
    }
}
/*fim*/
