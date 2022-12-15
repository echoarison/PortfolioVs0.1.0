<?php
    //iniciando sessão
    session_start();

    /**
     * 
     * Fazendo ele voltar para a tela de login caso essa sessões não foram inciadas
     * 
     * */

    if(!isset($_SESSION["userSC"])){
        
        header("Location: ../Pages/Login.html");        //Header com location direciona a pagina
        
        exit;   //Ele pode enviar mensagem e terminar o script
    }    

?>
<!DOCTYPE html>
<html>

<head>
    <title>User Socio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <link rel="stylesheet" href="../Css/bootstrap.css">
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" href="../Css/bootstrap.css.map">
    <link rel="stylesheet" href="../Css/styleResponsive.css">
    <script type="text/javascript" src="../Js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../Js/jquery-3.0.0.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.min.js"></script>
</head>

<body class="bg-light">
    <!--cabecarioUsuarioCliente-->
    <header class="container-fluid bg-light userBoxShadow">
        <div class="row">
            <div class="col-8 text-left">
                <div class="#">
                    <img class="#" src="../Img/logo/LogotipoNew.png" alt="logo_da_empresa" width="180" height="110">
                </div>
            </div>

            <div class="col-4 userNavegacaoRespon userNav noItensUser" id="usuarioMenu">
                <div class="py-2 aqui">

                    <div class="itenMenu mx-1 py-2">
                        <img class="iconeFoto shadow rounded-circle teste" src="../Img/Icones/user.png"
                            alt="foto_usuario">
                    </div>

                    <div class="itenMenu mx-1 py-2">
                        <h6 class="textColorPadrao"><?php echo $_SESSION['userSC'][1];?>
                        </h6>
                    </div>

                    <div class="itenMenu mx-1 py-2">

                        <img class="btnSair" src="../Img/Icones/sair.png" alt="foto_usuario" onclick="sairLogin();">

                    </div>

                </div>
            </div>

        </div>
        </div>

        <div class="menuUser"
            onclick="menuResponsivoUser(document.getElementsByTagName('img')[0],document.getElementsByTagName('div')[2],document.getElementsByTagName('BODY')[0])"></div>
    </header>
    <!-- fimCabecario -->

    <!-- socioDados -->
    <section class="container-fluid my-4">

        <div class="row justify-content-center mx-1 my-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-lx-6 my-2">
                <article class="dataSocio mx-auto border shadow">

                    <div class="fotoUserSocio text-center"></div>

                    <div class="dadosUserSocio p-2 textColorPadrao bg-light">
                        <h6><?php echo $_SESSION['userSC'][1];?></h6><!-- nome do socio -->

                        <h6><?php echo $_SESSION['userSC'][2];?></h6><!-- cargo -->

                        <h6><?php echo $_SESSION['userSC'][3];?></h6><!-- email -->

                        <h6><?php echo $_SESSION['userSC'][4];?></h6><!-- telefone -->
                    </div>
                </article>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-lx-6 my-2">
                <article class="border shadow">
                    <h2 class="text-center textColorPadrao">Projetos Recentes</h2>

                    <div class="row justify-content-center">
                        <div class="col-10 mx-auto table-responsive-sm">
                        <!-- Gambiarra--->
                        <iframe src="#" title="#" class="noVisive" onload="ProjetoRecentes()"></iframe> 
                        <div id="projetoUlt" class="text-center loadding"></div>
                        <h4 class="text-center" id="avisoLodg">Aguarde...</h4>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>
    <!-- fimSocioDados -->

    <!-- funcaoUsuario -->
    <section class="container-fluid bg-light">
        <div class="row">
            <div class="col">
                <!-- tablist -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#addProjeto" role="tab"
                            aria-controls="home" aria-selected="true">Adicionar Projeto</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#complProjeto" role="tab"
                            aria-controls="profile" aria-selected="false">Projetos Concluidos</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#esperaPedido" role="tab"
                            aria-controls="profile" aria-selected="false">Pedido Em espera</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#updateProjeto" role="tab"
                            aria-controls="contact" aria-selected="false">Aletrar Projetos</a>
                    </li>
                </ul>

                <!-- adicionarProjeto -->
                <div class="tab-content shadow border-top-0 p-3 textColorPadrao" id="myTabContent">

                    <div class="tab-pane fade show active" id="addProjeto" role="tabpanel" aria-labelledby="home-tab">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Nome Do Projeto:</label>
                                    <input type="text" class="form-control" id="nomeProjeto"
                                        placeholder="exemplo nome: Adminiscar">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Data Entrega:</label>
                                    <input type="date" class="form-control" id="dateEntrega">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Horas Estimadas</label>
                                    <input type="text" class="form-control" id="horasEstim" placeholder="1751.00">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Nome do Cliente:</label>
                                    <input type="text" class="form-control" id="nomeCliente"
                                        placeholder="exemplo nome: Carlos Pereira Silva">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Cpf:</label>
                                    <input type="text" class="form-control" id="cpfCliente"
                                        placeholder="exemplo cpf: 123.654.789-89">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição Do Projeto:</label>
                                <textarea class="form-control" id="descricaoProjeto" rows="5"></textarea>
                            </div>

                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-1">
                                    <button type="button" class="btn btn-light border textColorPadrao"
                                        onclick="RegistraProjeto();">Registrar</button>
                                </div>

                                <div class="form-group col-md-1">
                                    <button type="reset" class="btn btn-light border textColorPadrao">Limpar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- ProjetoCompleto e cancelado-->
                    <div class="tab-pane fade p-3" id="complProjeto" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <form>
                            <div class="form-row justify-content-center">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="buscaFinal"
                                        placeholder="Faça sua busca aqui...." onkeyup="testeInstantaneo()">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-light border textColorPadrao" onclick="atualizarDados()">Refresh</button>
                                </div>
                            </div>
                        </form>
                        <!-- fimBuscaProjeto -->

                        <!-- resultados-->
                        <div class="listaProjeto my-4 text-center">
                            <iframe src="./Bsc/buscaProjeto.php" class="buscaSearch"></iframe>

                            <div id="tabelaResult" class="text-center"></div>
                        </div>
                        <!--Fimresultado-->


                    </div>

                    <!-- PedidosEmEspera -->
                    <div class="tab-pane fade p-3" id="esperaPedido" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- buscaProjeto -->
                        <form>
                            <div class="form-row justify-content-center">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="buscaPedido"
                                        placeholder="Faça sua busca aqui...." onkeyup="buscaBdSt()">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-light border textColorPadrao"
                                        onclick="atualizarDados()">Refrash</button>
                                </div>
                            </div>
                        </form>
                        <!-- fimBuscaProjeto -->

                        <!-- resultados-->
                        <div class="listaProjeto my-4 text-center">
                            <iframe src="./Bsc/buscaPedido.php" class="buscaSearch"></iframe>
                        </div>

                        <div id="tabelaCliente" class="text-center"></div>
                        <!-- fimResultados -->
                    </div>

                    <!-- PedidosUpdate -->
                    <div class="tab-pane fade p-3" id="updateProjeto" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- buscaProjeto -->
                        <form>
                            <div class="form-row justify-content-center">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="buscaAltera"
                                        placeholder="Faça sua busca aqui...." onkeyup="buscaUpdate()">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-light border textColorPadrao" onclick="atualizarDados()">Refrash</button>
                                </div>
                            </div>
                        </form>
                        <!-- fimBuscaProjeto -->

                        <!-- resultados-->
                        <div class="listaProjeto my-4 text-center">
                            <!-- resultados-->
                            <div class="listaProjeto my-4 text-center">
                                <iframe id="tabelaCliente" src="./Bsc/alterarProjeto.php" class="buscaSearch"></iframe>
                            </div>

                            <div id="tabelaUpdate" class="text-center"></div>
                            <!-- fimResultados -->
                        </div>

                    </div>
                    <!-- fimTablist -->
                </div>
            </div>
    </section>
    <!-- fimFuncaoUsuario -->

    <!--Modal-->
    <div class="modal fade textColorPadrao" id="alterarProjeto" tabindex="-1" aria-labelledby="alterarProjeto"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alterarProjeto">Alterar Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlInput1">Nome Do Projeto</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="exemplo name: adminiscar">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleFormControlInput1">Data Entrega</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1"
                                    placeholder="name@example.com">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlInput1">Horas Estimadas</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="exemplo name: adminiscar">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descrição Do Projeto</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <!-- fim -->

    <!--rodapé-->
    <footer class="container-fluid bg-light userBoxShadowTop mt-4">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <img class="#" src="../Img/logo/LogotipoNew.png" alt="logo_da_empresa" width="150" height="100">
            </div>
        </div>
    </footer>
    <!-- fimRodapé -->

    <script type="text/javascript" src="../Js/scriptBack.js"></script>
    <script type="text/javascript" src="../Js/scriptStyle.js"></script>

    <!-- version do sistema -->
    <div class="versao">
        <p><b>ALPHA</b>V0.2.1</p>
    </div>
    <!-- fim -->
</body>

</html>