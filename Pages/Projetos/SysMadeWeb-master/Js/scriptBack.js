/**
 * 
 * antes de enviar para o php fazendo uma validação dos dados
 * 
 **/

/*validando Horas*/
function validaHoras(horas) {
    var issoNumber;

    if (horas.length <= 7) {

        horas = parseFloat(horas);

        issoNumber = isNaN(horas);

        if (issoNumber === false) {

            //horas = parseFloat(horas);
            horas = false;

        } else {

            horas = true; //pois é string

        }




    } else {
        horas = true;
    }

    return horas;

}
/*fim*/

/*validando o cnpj*/
function validaCnpj(cnpj) {
    var valido;

    /**
     * 
     * expressão regular do cnpj
     * 
     */
    ///^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/

    //verificando o cnpj
    cnpj = cnpj.trim();
    cnpj = cnpj.replace(/[^\d]+/g, "");
    cnpj = cnpj.length;
    cnpj = parseInt(cnpj);

    if (cnpj == 14) {

        valido = true;

    } else {
        valido = false;
    }

    return valido;
}
/*fim*/

/*validandoTelefone*/
function validaTel(tel) {
    var valido;

    tel = tel.trim();
    tel = tel.replace(/[^\d]+/g, "");
    tel = tel.length;

    if (tel == 10 || tel == 11) {

        valido = true;

    } else {

        valido = false;

    }

    return valido;

}

/*validandoCpf*/
function validaCpf(cpf) {
    //declarando variaveis locais
    var valido;

    /**
     * 
     * fazendo teste da função sendo chamado pela outra
     * 
     * */

    //verificando cpf
    cpf = cpf.trim();
    cpf = cpf.replace(/[^\d]+/g, ""); //expressão regular para tirar . e o - do cpf
    cpf = cpf.length;
    cpf = parseInt(cpf);

    //vendo se o cpf tem 11 caracteres
    if (cpf == 11) {

        valido = true;

    } else {
        valido = false;
    }

    return valido;

}
/*fim*/

/*valida cep*/
function validaCep(cep) {
    var valido;

    //verificando o cep
    cep = cep.trim();
    cep = cep.replace(/[^\d]+/g, ""); //expressão regular para tirar . e o - do cpf
    cep = cep.length;
    cep = parseInt(cep);

    //vendo se o cep tem 8 caracteres
    if (cep == 8) {

        valido = true;

    } else {

        valido = false;

    }

    return valido;
}

/*fim*/

/*comparando as senhas*/
function igualSenha(senha1, senha2) {
    var senhaValida;

    if (senha1 != "" && senha2 != "" && senha1 === senha2) {
        if (senha1.length <= 15 && senha1.length >= 6 || senha2.length <= 15 && senha2.length >= 6) {
            //alert('Suas senha estao no padrao');
            senhaValida = senha1;
        } else {
            //alert('suas senha não estao no padrao');

            senhaValida = parseInt(1);
        }
    } else {
        //alert('senhas diferentes');
        senhaValida = parseInt(0);
    }

    return senhaValida;

    //alert("Senha 1: " + senha1 + " senha 2: " + senha2 );
}
/*fim*/

/*funcãoDeLogin*/
function Login(value) {
    //declarando variaveis locais
    var login, senha, serverHttp, path;

    value = parseInt(value);

    login = document.getElementById("LoginCpf").value;
    senha = document.getElementById("LoginSenha").value;

    if (value === 1) {

        path = "./Php/Executando.php";

    } else {
        path = "../Php/Executando.php";
    }

    //verificando os valores
    if (login == "" || login == null || senha == "" || senha == null) { //se o valores estiverem vazio

        alert("Não tem nada aqui volte e tenta de novo");

    } else { //segunda etapa verificando os valores

        //verificando se o cpf e valido
        if (validaCpf(login) === true) {
            //verificando a senha
            if (senha.length <= 15 && senha.length >= 6) {

                //Desenvolvendo o ajax
                serverHttp = new XMLHttpRequest(); //Criando um objeto xml

                serverHttp.onreadystatechange = function () {
                    //verificando o status e se esta pronto para responder
                    if (this.readyState == 4 && this.status == 200) {

                        //verificando se tem cadastro
                        if (parseInt(this.responseText) === 1) {

                            alert("Essa conta é invalida!!!");

                        } else {

                            location.href = this.responseText;
                        }

                    }

                };

                serverHttp.open("POST", path, true);

                serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                serverHttp.send("loginCpf=" + login + "&loginSenha=" + senha + "&pgLoc=" + value);





            } else {

                alert("sua senha não esta aceitavel");

            }
        } else {

            //Desenvolvendo o ajax
            serverHttp = new XMLHttpRequest(); //Criando um objeto xml

            serverHttp.onreadystatechange = function () {
                //verificando o status e se esta pronto para responder
                if (this.readyState == 4 && this.status == 200) {

                    //verificando se tem cadastro
                    //alert(this.responseText);

                    if (parseInt(this.responseText) === 1) {

                        alert("Essa conta é invalida!!!");

                    } else {

                        location.href = this.responseText;
                    }

                }

            };

            serverHttp.open("POST", path, true);

            serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            serverHttp.send("loginSC=" + login + "&senhaSC=" + senha + "&pgLoc=" + value);

        }

    }
}
/*fim*/

/*funcao validacao*/
function validaDados(nome, cpf, cnpj, empresa, rua, bairro, cep, cidade, uf, tel) {
    var dadoValida;

    if (nome.trim().length <= 150 && nome.trim().length >= 3) {

        if (validaCpf(cpf) === true) {

            if (validaCnpj(cnpj) === true) {

                if (empresa.trim().length <= 200 && empresa.trim().length >= 3) {

                    if (rua.trim().length <= 110 && rua.trim().length >= 3) {

                        if (bairro.trim().length <= 50 && bairro.trim().length >= 3) {

                            if (validaCep(cep) === true) {

                                if (cidade.trim().length <= 100 && cidade.trim().length >= 3) {

                                    if (uf.trim().length == 2) {

                                        if (validaTel(tel) === true) {

                                            dadoValida = new Array(nome,
                                                cpf,
                                                cnpj,
                                                empresa,
                                                rua,
                                                bairro,
                                                cep,
                                                cidade,
                                                uf,
                                                tel
                                            );


                                        } else {
                                            dadoValida = "telefone invalido";
                                        }

                                    } else {
                                        dadoValida = "tem que ser um UF valido";
                                    }

                                } else {

                                    dadoValida = "tem q ser uma cidade valida";

                                }

                            } else {

                                dadoValida = "tem que ser um cep valido";

                            }

                        } else {

                            dadoValida = "tem que ser um nome de bairro valido";

                        }

                    } else {
                        dadoValida = "tem que ser um nome de rua valido";
                    }

                } else {

                    dadoValida = "Tem que ser um nome de empresa valido!";

                }

            } else {

                dadoValida = "Tem que ser cnpj valido!!!";

            }

        } else {

            dadoValida = "Tem que ser um cpf valido";
        }

    } else {
        dadoValida = "Tem que ser um nome valido";
    }

    return dadoValida;

}
/*fim*/

/*funcao cadastro*/
function registrarUser() {
    var nomeReg, cpfReg, cnpjReg, empresaReg, ruaReg, bairroReg, cepReg, cidadeReg, ufReg, telReg, dadosReg, senhaOne, senhaTwo;

    //dadosCadastro
    nomeReg = document.getElementById('nomeCliente').value;
    cpfReg = document.getElementById('cpfCliente').value;
    cnpjReg = document.getElementById('cnpjCliente').value;
    empresaReg = document.getElementById('empresaCliente').value;
    ruaReg = document.getElementById('ruaCliente').value;
    bairroReg = document.getElementById('bairroCliente').value;
    cepReg = document.getElementById('cepCliente').value;
    cidadeReg = document.getElementById('cidadeCliente').value;
    ufReg = document.getElementById('ufCliente').value;
    telReg = document.getElementById('telefoneCliente').value;
    loginReg = document.getElementById('loginUser').value;
    senhaOne = document.getElementById('senhaUser').value;
    senhaTwo = document.getElementById('senhaRepeat').value;

    //verificando se é string

    dadosReg = validaDados(nomeReg, cpfReg, cnpjReg, empresaReg, ruaReg, bairroReg, cepReg, cidadeReg, ufReg, telReg);

    if (typeof dadosReg === "string") {

        alert(dadosReg);

    } else {
        //alert(dadosReg.toString());

        senhaOne = igualSenha(senhaOne, senhaTwo);

        if (senhaOne === 0) {
            alert("senhas não estão iguais!");
        } else if (senhaOne === 1) {
            alert("sua senha não deve se menor que 6 ou maior que 15!!");
        } else {

            //Desenvolvendo o ajax
            var serverHttp = new XMLHttpRequest(); //Criando um objeto xml

            serverHttp.onreadystatechange = function () {
                //verificando o status e se esta pronto para responder
                if (this.readyState == 4 && this.status == 200) {

                    alert(this.responseText);

                }

            };

            serverHttp.open("POST", "../Php/Executando.php", true);

            serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            serverHttp.send("dataUserCad=" + dadosReg.toString() + "&senhaCad=" + senhaOne + "&loginCad=" + loginReg);
        }


    }
}

/*função deslogar*/
function sairLogin() {
    var exitSessao, serverHttp;

    //valor que vai ser usado para acionar a funcao php
    exitSessao = parseInt(0);

    //Desenvolvendo o ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);

            alert("Você foi deslogado");

            //voltando a tela de login
            location.href = this.responseText;
        }

    };

    serverHttp.open("POST", "../Php/Executando.php", true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("outSign=" + exitSessao);

}
/*fim*/

/* funcao */
function EmDesenvolvimento() {
    alert("Em Breve!!!");
}


/**
 * 
 * 
 * Aqui fica a parte de função do usuario 
 * 
 * 
 */
function RealizaPedido(idCLi) {
    var nomeProj, descricaoProj;

    nomeProj = document.getElementById('nomeProjeto').value;
    descricaoProj = document.getElementById('descricaoProjeto').value;

    //validado as quantidade de caracteres
    if (nomeProj.length <= 130 && nomeProj.length >= 5) {

        if (descricaoProj.length <= 500 && descricaoProj.length >= 80) {

            //desenvolvendo ajax
            serverHttp = new XMLHttpRequest(); //Criando um objeto xml

            serverHttp.onreadystatechange = function () {
                //verificando o status e se esta pronto para responder
                if (this.readyState == 4 && this.status == 200) {

                    //resposta do php
                    alert(this.responseText);

                }

            };

            serverHttp.open("POST", "../Php/Executando.php", true);

            serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            serverHttp.send("projNome=" + nomeProj + "&projDescricao=" + descricaoProj + "&codCli=" + idCLi);


        } else {

            alert("ele não tem a quantidade de texto recomendavel a descricao falta " + parseInt(80 - descricaoProj.length)) + " caracteres";

        }

    } else {

        alert("ele não tem a quantidade de texto recomendavel o titulo de projeto");

    }
    //alert("Teste nome projeto: " + nomeProj + " descricao projeto: " + descricaoProj);

}

/*fim*/

/**
 * 
 * 
 * Aqui fica a parte de função do SC 
 * 
 * 
 */
function atualizarDados(){

    document.location.reload();

}
function RegistraProjeto() {
    var projName, projDate, projHour, projNameCli, descrProj, horasConv;

    projName = document.getElementById('nomeProjeto').value;
    projDate = document.getElementById('dateEntrega').value;
    projHour = document.getElementById('horasEstim').value;
    projNameCli = document.getElementById('nomeCliente').value;
    projCpfCli = document.getElementById('cpfCliente').value;
    descrProj = document.getElementById('descricaoProjeto').value;

    //verificando se tao vazio
    if (projName == "" || projName == null || projDate == "" || projDate == null || projHour == "" || projHour == null) {

        alert("Nome do Projeto ou date de entrega ou hora estimada estão vazio!!");

    } else if (projNameCli == "" || projNameCli == null || projCpfCli == "" || projCpfCli == null || projCpfCli == "" || descrProj == "" || descrProj == null) {

        alert("Nome do cliente ou cpf do cliente ou a descricao estao vazia!!!");

    } else if (validaCpf(projCpfCli) === false) {

        alert("Esse cpf é invalido");

    } else {

        if (projName.length <= 110 && projName.length >= 5) {

            //guardando o valor pra ver se é numero e convertendo
            horasConv = validaHoras(projHour);
            /*projHour = parseFloat(projHour);

            issoNumber = isNaN(projHour);*/


            if (horasConv === false) {

                if (projNameCli.length <= 110 && projNameCli.length >= 3) {

                    projHour = parseFloat(projHour);

                    if (descrProj.length <= 600 && descrProj.length >= 80) {

                        //desenvolvendo ajax
                        serverHttp = new XMLHttpRequest(); //Criando um objeto xml

                        serverHttp.onreadystatechange = function () {
                            //verificando o status e se esta pronto para responder
                            if (this.readyState == 4 && this.status == 200) {

                                //resposta do php
                                alert(this.responseText);


                            }

                        };

                        serverHttp.open("POST", "../Php/Executando.php", true);

                        serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        serverHttp.send("projNameSc=" + projName + "&projDateSc=" + projDate + "&projHourSc=" + projHour + "&projCliSc=" + projNameCli + "&projCpfCli=" + projCpfCli + "&projDescSc=" + descrProj);

                    } else {

                        alert('campo descrição não esta respeitando o limite decaracteres');

                    }


                } else {

                    alert("campo nome do cliente não esta respeitando o limite de caracteres");

                }

            } else {
                alert("Horas esta em um formato invalido!!!");
            }

        } else {
            alert("Ele deve ter no minimo 5 caracteres e no maximo 110 caracteres!!");
        }

    }

}

function ProjetoRecentes() {

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('projetoUlt').innerHTML = this.responseText;
            document.getElementById('projetoUlt').classList.remove("loadding");
            document.getElementById('avisoLodg').classList.add("noVisive");


        }

    };

    serverHttp.open("POST", "../Php/Executando.php", true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("ult=" + 1);

    //document.getElementById('projetoRecente').innerHTML = "Funfou";
}

//busca Bm
function testeInstantaneo() {
    var search;

    //guardando e tratando
    search = document.getElementById('buscaFinal').value;
    search = search.toLowerCase();

    if (search == "" || search == null) {

        document.getElementsByClassName('buscaSearch')[0].classList.remove("noVisive");
        document.getElementById('tabelaResult').classList.add("noVisive");

    } else {

        document.getElementsByClassName('buscaSearch')[0].classList.add("noVisive");
        document.getElementById('tabelaResult').classList.remove("noVisive");

    }

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('tabelaResult').innerHTML = this.responseText;

        }

    };

    serverHttp.open("POST", "../PagesUser/Bsc/buscaProjeto.php", true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("searchPj=" + search);



}

//busca Bs
function buscaBdSt() {
    var search;

    //guardando e tratando
    search = document.getElementById('buscaPedido').value;

    if (search == "" || search == null) {

        document.getElementsByClassName('buscaSearch')[1].classList.remove("noVisive");
        document.getElementById('tabelaCliente').classList.add("noVisive");

    } else {

        document.getElementsByClassName('buscaSearch')[1].classList.add("noVisive");
        document.getElementById('tabelaCliente').classList.remove("noVisive");

    }
    //search = search.toLowerCase();

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('tabelaCliente').innerHTML = this.responseText;


        }

    };

    serverHttp.open("POST", "../PagesUser/Bsc/buscaPedido.php", true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("searchCliPd=" + search);
}

//detalhes bs

//busca updateProj
function buscaUpdate() {
    var search;

    //guardando e tratando
    search = document.getElementById('buscaAltera').value;
    search = search.toLowerCase();

    if (search == "" || search == null) {

        document.getElementsByClassName('buscaSearch')[2].classList.remove("noVisive");
        document.getElementById('tabelaUpdate').classList.add("noVisive");

    } else {

        document.getElementsByClassName('buscaSearch')[2].classList.add("noVisive");
        document.getElementById('tabelaUpdate').classList.remove("noVisive");

    }

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('tabelaUpdate').innerHTML = this.responseText;

        }

    };

    serverHttp.open("POST", "../PagesUser/Bsc/alterarProjeto.php", true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("searchUpd=" + search);



}

//detalhes BM
function detalhes(codPj, codCli, value) {
    var caminho;
    value = parseInt(value);

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('modalResult').innerHTML = this.responseText;

        }

    };

    if (value == 1) {

        caminho = "../../Php/Executando.php";

    } else {

        caminho = "../Php/Executando.php";

    }

    serverHttp.open("POST", caminho, true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("codPj=" + codPj + "&codCli=" + codCli);
}
//teste
function detalhesUlt(codPj, codCli) {
    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('modalUltResult').innerHTML = this.responseText;

        }

    };


    serverHttp.open("POST", "../Php/Executando.php", true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("codpjUlt=" + codPj + "&codcliUlt=" + codCli);
}

//update BM
function pegarValor(codCli, codPj) {

    codPj = parseInt(codPj);
    codCli = parseInt(codCli);

    document.getElementById('codigoCli').value = codCli;
    document.getElementById('codigoPj').value = codPj;

}

function updtPj(value) {
    var codCli, codPj, nomePj, statusPj, datePj, horasPj, descricaoPj;

    value = parseInt(value);

    codCli = document.getElementById('codigoCli').value;
    codPj = document.getElementById('codigoPj').value;
    nomePj = document.getElementById('nomePj').value;
    statusPj = document.getElementById('statusPj').value;
    datePj = document.getElementById('diaPj').value;
    horasPj = document.getElementById('horasPj').value;
    descricaoPj = document.getElementById('descricaoPj').value;

    horasConv = validaHoras(horasPj);

    if (horasConv === false) {

        horasPj = parseFloat(horasPj);

    }
    
    if(horasPj == "" || horasPj == null){

        horasPj = "";
    }

    if(typeof horasPj == "string"){

        alert("aqui não pode letras!");
        
        document.getElementById('horasPj').focus();

    }else{
        //desenvolvendo ajax
        serverHttp = new XMLHttpRequest(); //Criando um objeto xml

        serverHttp.onreadystatechange = function () {
            //verificando o status e se esta pronto para responder
            if (this.readyState == 4 && this.status == 200) {

                //resposta do php
                alert(this.responseText);

            }

        };

        if (value == 1) {

            caminho = "../../Php/Executando.php";

        } else {

            caminho = "../Php/Executando.php";

        }

        serverHttp.open("POST", caminho, true);

        serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        serverHttp.send("codpj=" + codPj + "&codcli=" + codCli + "&nomePj=" + nomePj + "&statusPj=" + statusPj + "&datePj=" + datePj + "&horasPj=" + horasPj + "&descriPj=" + descricaoPj);
    }    
}

//delete BM
function apagarProjeto(codCli, codPj, value) {

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            alert(this.responseText);

        }

    };

    if (value == 1) {

        caminho = "../../Php/Executando.php";

    } else {

        caminho = "../Php/Executando.php";

    }

    serverHttp.open("POST", caminho, true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("pjCod=" + codPj + "&cliCod=" + codCli);

}

//detalhes BS
function detalhesPd(codPd, codCli, value) {
    var caminho;
    value = parseInt(value);

    //desenvolvendo ajax
    serverHttp = new XMLHttpRequest(); //Criando um objeto xml

    serverHttp.onreadystatechange = function () {
        //verificando o status e se esta pronto para responder
        if (this.readyState == 4 && this.status == 200) {

            //resposta do php
            document.getElementById('modalResultPedido').innerHTML = this.responseText;

        }

    };

    if (value == 1) {

        caminho = "../../Php/Executando.php";

    } else {

        caminho = "../Php/Executando.php";

    }

    serverHttp.open("POST", caminho, true);

    serverHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    serverHttp.send("codPd=" + codPd + "&clientCod=" + codCli);

}

function acRec(value) {

    value = parseInt(value);

    if (value == 1) {

        alert("Em breve! Aceitar Pedido");


    } else {

        alert("Em breve! Aceitar Pedido");

    }


}