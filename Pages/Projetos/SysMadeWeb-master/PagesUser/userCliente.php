<?php
    //iniciando sessão
    session_start();

    /**
     * 
     * Fazendo ele voltar para a tela de login caso essa sessões não foram inciadas
     * 
     * */

    if(!isset($_SESSION["DataUser"])){
        
        header("Location: ../Pages/Login.html");        //Header com location direciona a pagina
        
        exit;   //Ele pode enviar mensagem e terminar o script
    }  
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Cliente</title>
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
                        <h6 class="textColorPadrao"><?php echo $_SESSION['DataUser'][1];?>
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

    <!-- userDados -->
    <section class="container-fluid my-4">
        <div class="row justify-content-center my-3">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 py-2">
                <article class="dataUsuario row mx-1 p-0 shadow">
                    <div class="fotoUser col-12 p-2 text-center border">
                        <img class="bg-light rounded-circle border" src="../Img/Icones/profileUser.png"
                            alt="fotoUsuario">
                    </div>

                    <div class="dadosUser col-12 p-3 border textColorPadrao">
                        <h6><?php echo $_SESSION['DataUser'][2];?></h6> <!-- nome do cliente -->

                        <h6><?php echo $_SESSION['DataUser'][3];?></h6> <!-- email do cliente -->

                        <h6><?php echo $_SESSION['DataUser'][4];?></h6> <!-- empresa do cliente -->
                    </div>
                </article>
            </div>

            <div class="col-11 col-sm-11 col-md-11 col-lg-6 col-xl-6 py-2">
                <article class="dadosPedidos row border shadow">

                    <div class="listaPedidos col-12 text-center">
                        <h2 class="text-center textColorPadrao">Pedidos em Desenvolvimento</h2>
                        <img src="../Img/Icones/web-development.png" alt="emDesenvolvimento">
                        <h1 class="text-center textColorPadrao">Em Desenvolvimento</h1>
                    </div>

                </article>
            </div>
        </div>
    </section>
    <!-- fimUserDados -->

    <!-- funcaoUsuario -->
    <section class="container-fluid bg-light">

        <!-- tablist -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Fazer Pedido</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Pedido Em espera</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Configuração</a>
            </li>
        </ul>
        <div class="tab-content shadow border-top-0 p-3 textColorPadrao" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nome Do Projeto: </label>
                        <input type="text" class="form-control" id="nomeProjeto" placeholder="Nome do projeto....">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição do projeto: </label>
                        <textarea class="form-control" id="descricaoProjeto" rows="3"></textarea>
                    </div>

                    <button type="button" class="btn btn-light border textColorPadrao"
                        onclick="RealizaPedido(<?php echo $_SESSION['DataUser'][0]; ?>)">Realizar</button>

                </form>
            </div>

            <div class="tab-pane fade p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h1 class="text-center">Em Desenvolvimento</h1>
            </div>

            <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h1 class="text-center">Em Desenvolvimento</h1>
            </div>
        </div>
        <!-- fimTablist -->
    </section>
    <!-- fimFuncaoUsuario -->

    <!--rodapé-->
    <footer class="container-fluid bg-light userBoxShadowTop mt-4">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <img class="#" src="../Img/logo/LogotipoNew.png" alt="logo_da_empresa" width="150" height="100">
            </div>
        </div>
    </footer>
    <!-- fimRodapé -->

    <!-- version do sistema -->
    <div class="versao">
        <p><b>ALPHA</b>V0.2.1</p>
    </div>
    <!-- fim -->

    <script type="text/javascript" src="../Js/scriptBack.js"></script>
    <script type="text/javascript" src="../Js/scriptStyle.js"></script>
</body>

</html>