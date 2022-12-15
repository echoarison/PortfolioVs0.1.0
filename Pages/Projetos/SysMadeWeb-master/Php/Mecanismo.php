<?php
    session_start();

    //Busca SC
    function BuscaSc($lg, $snh){
        //chamando conexao
        require_once("conectBM.php");

        //guardando comando sql
        $sqlSlectSC = "SELECT Socio.codigoSocio, Socio.nomeDoSocio, Cargo.nomeDoCargo,Socio.emailSocio, Telefone.telefoneOne, Login.loginSocio FROM Socio INNER JOIN Cargo on Socio.codigoFKCargo = Cargo.codigoCargo INNER JOIN Login on Socio.codigoFKLogin = Login.codigoLogin INNER JOIN Telefone on Socio.codigoFKtelefone = Telefone.codigoTelefone WHERE loginSocio = '$lg' AND senhaSocio = '$snh'";
        $arrayValueSc = "";

        //Desenvolvendo script de execução
        $sqlExecut = $conn->query($sqlSlectSC);     //executando o comando sql

        $numberLinhas = $sqlExecut->num_rows;   //Retorno de linhas que o select fez

        //se vem algo ou não
        if($numberLinhas > 0){

            //Loop que vai percorrer todo resultado do select
            while($result = $sqlExecut->fetch_assoc()){
                
                $idSc = $result['codigoSocio'];
                $nomeSc = $result['nomeDoSocio'];
                $cargoSc = $result['nomeDoCargo'];
                $emailSc = $result['emailSocio'];
                $telefoneSc = $result['telefoneOne'];

                //guardando em um array
                $arrayValueSc = array($idSc, $nomeSc, $cargoSc, $emailSc,$telefoneSc);

            }
        }else{
            $arrayValueSc = false;
        }

        $conn->close();

        return $arrayValueSc;

    }

    //Busca de usuario
    function BuscaUsuario($loginBusc, $senhaBusc){
        //Chamando a pagina de conexao
        require_once("conect.php");

        //criando um lugar para guardar os dados do cliente
        $valoresUserArray = "";

        /*Desenvolvendo scrip sql com php*/

        //Fazendo a Busca busca do cliente
        $sqlSlect = "SELECT CLIENTE.CODIGOCLIENTE, CLIENTE.NOMECLIENTE, CLIENTE.EMAILCLIENTE, CLIENTE.EMPRESACLIENTE, LOGIN.LOGINUSER FROM CLIENTE, LOGIN WHERE CLIENTE.CPFCLIENTE = '$loginBusc' AND LOGIN.SENHASOCIO = '$senhaBusc' AND LOGIN.CODIGOLOGIN = CLIENTE.CODIGOCLIENTE";
        //$sqlSlect = "SELECT Cliente.nomeCliente, Cliente.emailCliente, Cliente.nomeDaEmpresaCliente,Login.loginUser FROM Cliente, Login WHERE Cliente.cpfCliente = '$loginBusc' AND Login.senhaSocio = '$senhaBusc'";
        
        $sqlResult = $conn->query($sqlSlect);       //Executando o comando sql no banco

        //numero de linhas
        $numberLinhas = $sqlResult->num_rows;       //se o num_rows estiver dando erro provavelment é o cmd sql

        //se vai tem resultado ou não
        if($numberLinhas > 0){
            //Loop se tiver resultado
            while($resultado = $sqlResult->fetch_assoc()):
                //guardando
                $nome = $resultado['NOMECLIENTE'];
                $user = $resultado['LOGINUSER'];
                $email = $resultado['EMAILCLIENTE'];
                $empresa = $resultado['EMPRESACLIENTE'];
                $idClient = $resultado['CODIGOCLIENTE'];

                

                //guardando os valores do usuario em uma array
                $valoresUserArray = array($idClient,$nome, $user, $email, $empresa);
    
            endwhile;
            
        }else{

            $valoresUserArray = false;
        }

        $conn->close();

        return $valoresUserArray;
        
    }

    //Funcao validaCpf
    function validaSenha($senha){
        $resposta = "";

        if($senha <= 15 || $senha >= 6){

            $resposta = true;

        }else{
            $resposta = false;
        }

        return $resposta;
    }

    //funcao validaSenha
    function validaCpf($cpf){
        //variavel de resposta
        $resposta = "";

        //variavel que vai guardar o cpf
        $valido = preg_replace('/[^0-9]/',"", $cpf);

        //contando o numero de caracetres q tem
        $valido = strlen($valido);

        //verificando se tem os 11 numeros
        if($valido === 11){

            $resposta = true;
            
        }else{
            $resposta = false;
        }

        //returnando resposta da validação
        return $resposta;

    }

    //funcao cadastro
    function cadastroClient($dataCad, $loginCad, $senhaCad){
        //Chamando a pagina de conexao
        require_once("conect.php");

        //para aramzenar
        $arrayDataUser = "";
        $respostaCadastro = "";
        
        //transformando $dataCad em array
        $arrayDataUser = explode(',', $dataCad);

        //obejetos sql guardando cmd sql
        $sqlSlectLg = "SELECT MAX(CODIGOLOGIN) FROM LOGIN";
        $sqlSlectEd = "SELECT MAX(CODIGOENDERECO) FROM ENDERECO";
        $sqlSlectTel= "SELECT MAX(CODIGOTELEFONE) FROM TELEFONE";
        $sqlIsertLg = "INSERT INTO LOGIN(LOGINUSER, SENHASOCIO)VALUES('$loginCad', '$senhaCad')";
        $sqlIsertEd = "INSERT INTO ENDERECO(
            RUA,
            BAIRRO,
            CIDADE,
            ESTADO,
            CEP,
            UF
        )VALUES(
            '$arrayDataUser[4]',
            '$arrayDataUser[5]',
            '$arrayDataUser[6]',
            'Sao Paulo',
            '$arrayDataUser[7]',
            '$arrayDataUser[8]'
        )";
        $sqlIsertTel = "INSERT INTO TELEFONE(TELEFONE1)VALUES('$arrayDataUser[9]')";
        $sqlIsertCli = "";

        //insert login
        if($conn->query($sqlIsertLg) === true){

            $respostaCadastro = "Foi cadastrado com sucesso login e a senha";

        }/*else{

            echo "Error: " . $sqlIsert . "<br>" . $conn->error;
        }*/

        //insert endereco
        if($conn->query($sqlIsertEd) === true){

            $respostaCadastro = "Foi cadastrado com sucesso endereco";

        }/*else{

            echo "Error: " . $sqlIsertEd . "<br>" . $conn->error;
        }*/

        //insert telefone
        if($conn->query($sqlIsertTel) === true){

            $respostaCadastro = "Foi cadastrado com sucesso Telefone";

        }/*else{

            echo "Error: " . $sqlIsertTel . "<br>" . $conn->error;
        }*/

        //puxando as chaves estrangeiras
        $resultLastIdLg = $conn->query($sqlSlectLg);
        $resultLastIdEd = $conn->query($sqlSlectEd);
        $resultLastIdTel = $conn->query($sqlSlectTel);
        
        if ($resultLastIdLg->num_rows > 0){
            
            //echo $resultLastIdLg;
            while($resultadoLg = $resultLastIdLg->fetch_assoc()){

                 $lgId = intval($resultadoLg['MAX(CODIGOLOGIN)']);

            } 

        }else{

            $respostaCadastro = "Error No SELECT Ultimo registro feito no login";

        }

        if($resultLastIdEd->num_rows > 0){

           //echo $resultLastIdLg;
            while($resultadoEd = $resultLastIdEd->fetch_assoc()){

                $edId = intval($resultadoEd['MAX(CODIGOENDERECO)']);
            
            }
        }else{

            $respostaCadastro = "Error No SELECT Ultimo registro feito no Endereco";
        }

        if($resultLastIdTel->num_rows > 0){

            //echo $resultLastIdLg;
             while($resultadoTel = $resultLastIdTel->fetch_assoc()){
 
                 $telId = intval($resultadoTel['MAX(CODIGOTELEFONE)']);
             
             }
         }else{
 
             $respostaCadastro = "Error No SELECT Ultimo registro feito no Telefone";
         }
         /*fim*/

         //Registrando o cliente
         $sqlIsertCli = "INSERT INTO CLIENTE(
             CPFCLIENTE,
             CNPJCLIENTE,
             EMPRESACLIENTE,
             NOMECLIENTE,
             CODIGOFKSLOGIN,
             CODIGOFKSENDERECO,
             CODIGOFKSTELEFONE
         )VALUES(
            '$arrayDataUser[1]',
            '$arrayDataUser[2]',
            '$arrayDataUser[3]',
            '$arrayDataUser[0]',
             $lgId,
             $edId,
             $telId
         )";

        
        //echo $sqlIsertCli;

        if($conn->query($sqlIsertCli) === true){

            $respostaCadastro = "Foi cadastrado com sucesso o Cliente";

        }/*else{

            echo "Error: " . $sqlIsertCli . "<br>" . $conn->error;
        }*/

        $conn->close();

        echo $respostaCadastro;
        
    }

    //funcao logarUser
    function SessaoLogar($loginValue, $senhaValue, $pgLoc){
        //variaveis locais
        $login = $loginValue;
        $senha = $senhaValue;
        $pgLoc = intval($pgLoc);

        //validando o cpf segunda vez
        if (validaCpf($login) === true):

            //validando a senha
            if(validaSenha($senha) === true){

                //verificando se a funcao veio com array
                $testeValor = BuscaUsuario($login, $senha);

                if($testeValor === false){

                    echo 1;

                }else{
                    //criando uma sessão que vai possuir os dados do usuaraio
                    /**
                     * 
                     * Foreach é só usado em variaveis de matriz traduzindo arrays
                     * 
                     **/
                    /*$_SESSION["DataUser"] = $testeValor;

                    foreach($_SESSION["DataUser"] as $resultUser):
                        echo $resultUser . " ";
                    endforeach;*/

                    //criando a session,
                    $_SESSION["DataUser"] = $testeValor;

                    if($pgLoc === 1){
                        
                        echo "./PagesUser/userCliente.php";     //enviando ao ajax pra ele poder mudar de pagina

                    }else{
                        echo "../PagesUser/userCliente.php";    //enviando ao ajax pra ele poder mudar de pagina
                    }        
                }

            }else{
                echo "Não foi a senha";
            }

        else:

            echo "Não Foi o Cpf";

        endif;    

    }

    //funcao logarSC
    function SocioLg($loginSc, $senhaSc, $pgLoc){
        $valorSc = "";
        $pgLoc = intval($pgLoc);

        //guardando o valor da busca
        $valorSc = BuscaSc($loginSc, $senhaSc);

        //verificando se tem resultado
        if($valorSc === false){
            
            echo 1;

        }else{

            //criando session
            $_SESSION['userSC'] = $valorSc;

            if($pgLoc === 1){

                echo "./PagesUser/userSocio.php";

                exit();

            }else{

                echo "../PagesUser/userSocio.php";

                exit();

            }

        }

    }

    //função deslogar
    function DesLogar($sair){
        
        session_unset();        //apagando os dados da sessão mas ela existe
        session_destroy();      // destruindo a sessão

        echo"../Pages/Login.html";

    }


    /**
     * 
     * Funcao do cliente
     * 
     */

     function RealizaPedido($codCli,$nome, $descricao){
         //requerindo a apgina de conexao
         require_once("conect.php");

         //meta charset no banco
         $conn->set_charset("utf8");

         //convertendo os valores dos tipos
         $codCli = intval($codCli);
         $nome = strval($nome);
         $descricao = strval($descricao);

         //guardando os comandos sql
         $oSqlInsert = "INSERT INTO PEDIDO( CODIGOFKSCLIENTE, NOMEDOPEDIDO, DESCRICAOPEDIDO, DATAREALIZADO)VALUES( $codCli, '$nome', '$descricao', NOW())";

         if($conn->query($oSqlInsert) === true){

            echo "Pedido Cadastro com sucesso!!!";

         }else{

            echo "Erro ao executar o pedido!!!";

         }


     }

     /*fim*/

     /**
      * 
      *funcao Sc
      *
      */
      
      //Projetos recem colocados
      function UltimosProjetos(){
        require_once "conectBM.php";

        //meta charset no banco
        $conn->set_charset("utf8");

        //buscando
        $sqlUltimos = "SELECT codigoProjeto, nomeDoProjeto, codigoFKCliente,dataDeInicio, dataDeTermino FROM Projeto ORDER BY dataDeInicio DESC LIMIT 0,6";
        $sqlExecutar = $conn->query($sqlUltimos);
        $linhas = $sqlExecutar->num_rows;

        if($linhas > 0){

            echo'<table class="table text-center">
            <thead class="tHeadBg">
                <tr>
                    <th scope="col">Projeto</th>
                    <th scope="col">Data entrega</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="textColorPadrao">';

            while($rst = $sqlExecutar->fetch_assoc()):
              echo'<tr>
              <td>'.$rst['nomeDoProjeto'].'</td>
              <td>'.$rst['dataDeInicio'].'</td>
              <td><button type="button"
                      class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesPjt" onclick="detalhesUlt('.$rst['codigoProjeto'].', '.$rst['codigoFKCliente'].')">Detalhes</button></td>
              </tr>';  


            endwhile;

            echo'<!-- Modal detalhes -->
            <div class="modal fade textColorPadrao" id="DetalhesPjt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-left">
                    <div id="modalUltResult"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>';
            
            echo "</tbody>";
            echo "</table>";
            //echo"Foi cara!!!";

        }else{

            echo"Não foi!!!";

        }

      } 


      //cadastrando projeto
      function CadastrarProjeto($nomeProjSc, $dateProjSc, $hourProjSc, $cliProjSc, $cpfProjSc, $descProjSc){
        //chamando o banco
        require_once("conectBM.php");

        //meta charset no banco
        $conn->set_charset("utf8");

        //resposta da busca
        $arrayCliente = "";
        $cdcli = "";

        //convertendo as houras
        $hourProjSc = floatval($hourProjSc);

        //comando sql
        $sqlSlectCli = "SELECT codigoCliente,cpfCliente, nomeDoCliente FROM Cliente WHERE cpfCliente = '$cpfProjSc'";
        $sqlExcut = $conn->query($sqlSlectCli);

        $sqlNumbRow = $sqlExcut->num_rows;      //numero de linhas que retornaram no select

        //verificando se veio algo do cliente
        if($sqlNumbRow > 0):
            
            while($result = $sqlExcut->fetch_assoc()){

                $cpfProjSc = $result['cpfCliente'];
                $codCliProjSc = $result['codigoCliente'];
                
                //se o nome do cpf não batendo 
                if($result['nomeDoCliente'] != $cliProjSc){

                    $cliProjSc = $result['nomeDoCliente'];

                    //echo "são diferente os nomes!";

                }

                $arrayCliente = array(intval($codCliProjSc),$cliProjSc, $cpfProjSc);


            }
        
        else:
            //Se ele não encontrou
            /**
             * 
             * AUTO-INCREMENT BASEADO NA GAMBIARRA
             * 
             */
            $sqlSlectCliente = "SELECT MAX(codigoCliente) FROM Cliente";
            $sqlExecutar = $conn->query($sqlSlectCliente);
            $sqlLinhas = $sqlExecutar->num_rows;

            if($sqlLinhas > 0){

                while($sqlRsl = $sqlExecutar->fetch_assoc()):

                    $cdcli = $sqlRsl['MAX(codigoCliente)'];

                    $cdcli = intval($cdcli) + 1;

                endwhile;

            }

            //fazendo o insert
            $sqlInsertCliente = "INSERT INTO Cliente(codigoCliente, nomeDoCliente, cpfcliente)VALUES( $cdcli, '$cliProjSc', '$cpfProjSc')";
            $sqlExecutar->free_result();
            $sqlExecutar = $conn->query($sqlInsertCliente);
            //$arrayCliente = false;

            if($sqlExecutar === true){

                $arrayCliente = array($cdcli,$cliProjSc, $cpfProjSc);

            }else{
                echo "Erro no cadastro!!!";

                exit();
            }
        
        endif;

            /**
             * 
             * Fazendo gambirra, pois esta muito complicado de alterar o banco
             * para colocar AUTO_INCREMENT, pois esqueci
             * 
             * */
            $sqlRegLst = "SELECT MAX(codigoProjeto) FROM Projeto";      //Busaca do ultimo registro feito
            
            $sqlExecut = $conn->query($sqlRegLst);
            
            $numberLinhas = $sqlExecut->num_rows;

            if($numberLinhas > 0){

                while($result = $sqlExecut->fetch_assoc()):

                    $regLast = $result['MAX(codigoProjeto)'];

                    $regLast = $regLast + 1;

                    $codProj = intval($regLast);

                endwhile;     

            }else{

                echo "Nada de registro Erro 404!!!";

                exit();

            }
            /*fim*/
        //endif; 

        //Comando de inserção
        $sqlIsertPj = "INSERT INTO Projeto(
            codigoProjeto,
            nomeDoProjeto,
            codigoFKCliente,
            dataDeTermino,
            dataDeInicio,
            horarioEstimadoDoProjeto,
            descricaoDoProjeto)VALUES(
                $codProj,
                '$nomeProjSc',
                $arrayCliente[0],
                '$dateProjSc',
                NOW(),
                $hourProjSc,
                '$descProjSc' )";
        //verificando se foi cadastrado
        if ($conn->query($sqlIsertPj) === TRUE) {

            //echo "Projeto cadastro na tabela Projeto ";

            /**
             * GAMBIRRA DE NOVO EU NÃO AGUENTO MAIS, PORÉM O TEMPO ESTA CURTO
             * E TEM COISAS PRA REVER AHHAHAHAH
             * Fazendo gambirra, pois esta muito complicado de alterar o banco
             * para colocar AUTO_INCREMENT, pois esqueci.
             * 
             * */
            $sqlRegLst = "SELECT MAX(codigoProjSoc) FROM ProjetoSocio";      //Busaca do ultimo registro feito
            
            $sqlExecut = $conn->query($sqlRegLst);
            
            $numberLinhas = $sqlExecut->num_rows;

            if($numberLinhas > 0){

                while($result = $sqlExecut->fetch_assoc()):

                    $regLast = $result['MAX(codigoProjSoc)'];

                    $regLast = $regLast + 1;

                    $codPJS = intval($regLast);

                endwhile;     

            }else{

                echo "Nada de registro Erro 404(PJS)!!!";

                exit();

            }

            //inserção na tabela socio 
            $sqlInsertPjS = "INSERT INTO ProjetoSocio(
                codigoProjSoc,
                codigoFKCargo,
                codigoFKProjeto,
                codigoFKArea)VALUES(
                    $codPJS,
                    1,
                    $codProj,
                    1)";

            if($conn->query($sqlInsertPjS) === true):

                echo "Registrado Com Sucesso o Projeto";

            else:

                echo "Error: " . $sqlInsertPjS . " " . $conn->error;
                die();

            endif;    

          } else {
            
            echo "Error: " . $sqlIsertPj . " " . $conn->error;
            die();

          }
        


      }

      //puxando dados especifico
      function Detalhes($codPj, $codCli){
          require_once "conectBM.php";  //chamando a conexão

          //meta charset no banco
          $conn->set_charset("utf8");
          
          //convertendo os valores
          $codPj = intval($codPj);
          $codCli = intval($codCli);
          
          //comando sql
          $sqlSlct = 'SELECT nomeDoProjeto, dataDeTermino, statusProjeto, dataDetermino, dataDeInicio, horarioEstimadoDoProjeto, descricaoDoProjeto, Cliente.nomeDoCliente, Cliente.cpfCliente FROM Projeto INNER JOIN Cliente ON Cliente.codigoCliente ='.$codCli.' WHERE Projeto.codigoProjeto =' . $codPj; 
          $sqlExect = $conn->query($sqlSlct);
          $numberRow = $sqlExect->num_rows;     //se der erro é o comando sql ou banco

          if($numberRow > 0){

                while($result = $sqlExect->fetch_assoc()):

                    if($result['statusProjeto'] == "" || $result['statusProjeto'] == null){

                        $result['statusProjeto'] = "<p class='text-info'>Em Análise</p>";

                    }elseif($result['statusProjeto'] == 0){

                        $result['statusProjeto'] = "<p class='text-danger'>Cancelado</p>";
                        $result['dataDeTermino'] = "<p class='text-danger'>Não Tem Data!</p>";
                        $result['dataDeInicio'] = "<p class='text-danger'>Não Tem Data!</p>";
                        $result['horarioEstimadoDoProjeto'] = "<p class='text-danger'>Não Existe Hora Para finalizar!</p>";

                    }elseif($result['statusProjeto'] == 1){

                        $result['statusProjeto'] = "<p class='text-primary'>Em Desenvolvimento</p>";

                    }elseif($result['statusProjeto'] == 2){

                        $result['statusProjeto'] = "<p class='text-info'>Em Análise</p>";

                    }elseif($result['statusProjeto'] == 3){

                        $result['statusProjeto'] = "<p class='text-success'>Finalizado</p>";

                    }

                    echo "<h5>Nome do cliente: </h5>" . $result['nomeDoCliente'];
                    echo "<h5>Cpf do Cliente: </h5>" . $result['cpfCliente'];
                    echo "<h5>Nome Do Projeto: </h5>" . $result['nomeDoProjeto'];
                    echo "<h5>Status: </h5>" . $result['statusProjeto'];
                    echo "<h5>Data De Entrega: </h5>" . $result['dataDeTermino'];
                    echo "<h5>Data De Inicio: </h5>" . $result['dataDeInicio'];
                    echo "<h5>Horas Estimadas: </h5>" . $result['horarioEstimadoDoProjeto'];
                    echo "<h5>Descrição Do Projeto: </h5>" .$result['descricaoDoProjeto'];
                    
                endwhile;   
           }

           $conn->close();

      }

      //fazendo redundancia
      function DetalhesUlt($codPj, $codCli){
        require_once "conectBM.php";  //chamando a conexão

        //meta charset no banco
        $conn->set_charset("utf8");
        
        //convertendo os valores
        $codPj = intval($codPj);
        $codCli = intval($codCli);
        
        //comando sql
        $sqlSlct = 'SELECT nomeDoProjeto, dataDeTermino, statusProjeto, dataDetermino, dataDeInicio, horarioEstimadoDoProjeto, descricaoDoProjeto, Cliente.nomeDoCliente, Cliente.cpfCliente FROM Projeto INNER JOIN Cliente ON Cliente.codigoCliente ='.$codCli.' WHERE Projeto.codigoProjeto =' . $codPj; 
        $sqlExect = $conn->query($sqlSlct);
        $numberRow = $sqlExect->num_rows;     //se der erro é o comando sql ou banco

        if($numberRow > 0){

              while($result = $sqlExect->fetch_assoc()):

                  if($result['statusProjeto'] == "" || $result['statusProjeto'] == null){

                      $result['statusProjeto'] = "<p class='text-info'>Em Análise</p>";

                  }elseif($result['statusProjeto'] == 0){

                      $result['statusProjeto'] = "<p class='text-danger'>Cancelado</p>";
                      $result['dataDeTermino'] = "<p class='text-danger'>Não Tem Data!</p>";
                      $result['dataDeInicio'] = "<p class='text-danger'>Não Tem Data!</p>";
                      $result['horarioEstimadoDoProjeto'] = "<p class='text-danger'>Não Existe Hora Para finalizar!</p>";

                  }elseif($result['statusProjeto'] == 1){

                      $result['statusProjeto'] = "<p class='text-primary'>Em Desenvolvimento</p>";

                  }elseif($result['statusProjeto'] == 2){

                      $result['statusProjeto'] = "<p class='text-info'>Em Análise</p>";

                  }elseif($result['statusProjeto'] == 3){

                      $result['statusProjeto'] = "<p class='text-success'>Finalizado</p>";

                  }

                  echo "<h5>Nome do cliente: </h5>" . $result['nomeDoCliente'];
                  echo "<h5>Cpf do Cliente: </h5>" . $result['cpfCliente'];
                  echo "<h5>Nome Do Projeto: </h5>" . $result['nomeDoProjeto'];
                  echo "<h5>Status: </h5>" . $result['statusProjeto'];
                  echo "<h5>Data De Entrega: </h5>" . $result['dataDeTermino'];
                  echo "<h5>Data De Inicio: </h5>" . $result['dataDeInicio'];
                  echo "<h5>Horas Estimadas: </h5>" . $result['horarioEstimadoDoProjeto'];
                  echo "<h5>Descrição Do Projeto: </h5>" .$result['descricaoDoProjeto'];
                  
              endwhile;   
         }

         $conn->close();

    }

      //puxando os pedidos no banco do site
      function DetalhesPd($codpd, $codcli){
        require_once "conect.php";  //chamando a conexão

        //meta charset no banco
        $conn->set_charset("utf8");

        //cmd sql
        $sqlSlct = 'SELECT NOMECLIENTE, CPFCLIENTE, NOMEDOPEDIDO, RESPOSTADOPEDIDO, DESCRICAOPEDIDO, DATAREALIZADO FROM PEDIDO INNER JOIN CLIENTE ON PEDIDO.CODIGOFKSCLIENTE = CLIENTE.CODIGOCLIENTE WHERE CLIENTE.CODIGOCLIENTE ='.$codcli. ' AND PEDIDO.CODIGOPEDIDO ='.$codpd.''; 
        $sqlExect = $conn->query($sqlSlct);
        $numberRow = $sqlExect->num_rows;     //se der erro é o comando sql ou banco

        if($numberRow > 0):

            while($result = $sqlExect->fetch_assoc()):

                    if($result['DATAREALIZADO'] == "" || $result['DATAREALIZADO'] == null){

                        $result['DATAREALIZADO'] = date("d/m/Y");

                    }

                    if($result['RESPOSTADOPEDIDO'] == "" || $result['RESPOSTADOPEDIDO'] == null){

                        $result['RESPOSTADOPEDIDO'] = "<p class='text-info'>Em espera de resposta!</p>";

                    }


                    echo "<h5>Nome do cliente: </h5>" . $result['NOMECLIENTE'];
                    echo "<h5>Cpf do Cliente: </h5>" . $result['CPFCLIENTE'];
                    echo "<h5>Nome Do Pedido: </h5>" . $result['NOMEDOPEDIDO'];
                    echo "<h5>Status de Resposta: </h5>" . $result['RESPOSTADOPEDIDO'];
                    echo "<h5>Dia solicitado: </h5>" . $result['DATAREALIZADO'];
                    echo "<h5>Descrição Do Pedido: </h5>" .$result['DESCRICAOPEDIDO'];

            endwhile;    

        endif;

      }

      //aletrar dados
      function AlteraData($codpj, $codcli, $nomepj, $statuspj, $datapj, $horaspj, $descripj){

        require_once "conectBM.php";

        //meta charset
        $conn->set_charset("utf-8");

        $pj = intval($codpj);
        $cli = intval($codcli);

        //cmd sql
        $sqlSlect = 'SELECT nomeDoProjeto, statusProjeto, dataDeTermino, horarioEstimadoDoProjeto, descricaoDoProjeto FROM Projeto INNER JOIN Cliente ON codigoFKCliente = codigoCliente WHERE codigoProjeto ='.$pj.' AND codigoCliente ='.$cli.'';
        $sqlExecut = $conn->query($sqlSlect);
        $numberLinhas = $sqlExecut->num_rows;

        if($numberLinhas > 0){

            while($result = $sqlExecut->fetch_assoc()):

                if($nomepj == "" || $nomepj == null){

                    $nomepj = $result['nomeDoProjeto'];

                }
                
                if($statuspj == "" || $statuspj == null){

                    $statuspj = 0;

                }
                
                if($datapj == "" || $datapj == null){

                    $datapj = $result['dataDeTermino'];

                }
                
                if($horaspj == "" || $horaspj == null){

                    $horaspj = $result['horarioEstimadoDoProjeto'];

                }

                if($descripj == "" || $descripj == null){

                    $descripj = $result['descricaoDoProjeto'];
                    $descripj = strval($descripj);

                }
            
            endwhile;

        }

        //limpando a variavel
        $sqlExecut->free_result();
        $sqlExecut = "";

        $sqlUpdt = 'UPDATE Projeto SET nomeDoProjeto = "'.$nomepj.'", statusProjeto ="'.$statuspj.'", dataDeTermino ="'.$datapj.'", horarioEstimadoDoProjeto ="'.$horaspj.'", descricaoDoProjeto=" '.$descripj.' " WHERE codigoProjeto = '.$pj.' AND codigoFKCliente ='.$cli.'';
        
        //meta charset no banco
        $conn->set_charset("utf8");
        
        $sqlExecut = $conn->query($sqlUpdt);

        if ($sqlExecut === TRUE) {
            
            echo "Atualizado com sucesso!!";
        
        } else {
            
            //echo "Error " . $sqlUpdt ." updating record: " . $conn->error;
            echo "Error ao alterar o projeto: " . $conn->error;
          
        }
          
          $conn->close();
      }

      //deletar dados
      function ApagarData($codpj, $codcli){
        
        echo"Em breve Deletar aqui!!!";

      }


?>