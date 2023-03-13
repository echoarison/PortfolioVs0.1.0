<!DOCTYPE html>
<html>

<head>
    <title>User Socio</title>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, intial-scale=1.0">-->
    <link rel="stylesheet" href="../../Css/bootstrap.css">
    <link rel="stylesheet" href="../../Css/style.css">
    <link rel="stylesheet" href="../../Css/bootstrap.css.map">
    <script type="text/javascript" src="../../Js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../../Js/jquery-3.0.0.js"></script>
    <script type="text/javascript" src="../../Js/bootstrap.js"></script>
    <script type="text/javascript" src="../../Js/bootstrap.min.js"></script>
</head>
<?php
 //chamando o banco do cliente
 require_once('../../Php/conectBM.php');

 //guardando a valor do ajax
     
if(!isset($_POST['searchUpd'])):
        
    $_POST['searchUpd'] = "";

    $search = $_POST['searchUpd'];

 else:

    $search = $_POST['searchUpd'];
 
 endif;
 
 //fim

 //valor da pagina
 if(!isset($_GET['pgUpd'])){

   $_GET['pgUpd'] = 1;

   $pagina = $_GET['pgUpd'];

  }else{

       $pagina = $_GET['pgUpd'];

  }
 //fim

 if($search == "" || $search == null):
    //CMD SQL
    $sqlSlect = "SELECT * FROM Projeto";
    $sqlExecut = $conn->query($sqlSlect);
    $numberRowPg = $sqlExecut->num_rows;
    
    //variaveis da paginacao
    $qtdItensPg = 6;

    //limpando o resultado
    $sqlExecut->free_result();
    $sqlExecut = "";

    //calculando o numeros de pagina
    $numeroPgs = ceil($numberRowPg/ $qtdItensPg);

    //calculando o inicio dos itens
    $inicio = ($qtdItensPg * $pagina) - $qtdItensPg;

    //selecionando o que apresentar
    $sqlSlctItens = "SELECT * FROM Projeto LIMIT $inicio, $qtdItensPg";
    $sqlExecut = $conn->query($sqlSlctItens);
    $totalItens = $sqlExecut->num_rows;

    if($totalItens > 0){
    echo'<table class="table text-center">
    <thead class="#" style="background-color: #43528A; color: white;">
        <tr>
            <th scope="col">Projeto</th>
            <th scope="col">Data entrega</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody class="textColorPadrao">';

    while($result = $sqlExecut->fetch_assoc()){
        
        if($result["statusProjeto"] == null){

            $result["statusProjeto"] = "Em Desenvolvimento";

        }

        echo'<tr>
        <td>'.$result['nomeDoProjeto'].'</td>
        <td>Data entrega:'.$result['dataDeTermino'].'</td>
        <td>
        <button type="button"
        class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesProjeto" onclick="detalhes('.$result['codigoProjeto'].', '.$result['codigoFKCliente'].', 1);" >Detalhes</button>
        <button type="button"
        class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#AlterarProjeto" onclick="pegarValor('.$result['codigoFKCliente'].', '.$result['codigoProjeto'].')">Alterar</button>
        <button type="button"
                  class="btn btn-light border textColorPadrao" onclick="apagarProjeto('.$result['codigoFKCliente'].', '.$result['codigoProjeto'].', 1)">Deletar</button>
        </td>
    </tr>';
    }

    echo'<!-- Modal detalhes -->
            <div class="modal fade textColorPadrao" id="DetalhesProjeto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-left">
                    <div id="modalResult"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>';
    
            echo'<!-- Modal update -->
            <div class="modal fade textColorPadrao" id="AlterarProjeto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-left">
                    <div id="modalAlter">

                    <input type="hidden" id="codigoCli" value="">
                    <input type="hidden" id="codigoPj" value="">

                    <form>
                        <div class="row">
                          <div class="col">
                              <label>Nome do projeto:</label>
                              <input type="text" class="form-control" id="nomePj" placeholder="Nome do projeto: ">
                          </div>
                          <div class="col my-1">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Status Do Projeto: </label>
                            <select class="custom-select mr-sm-2" id="statusPj">
                              <option selected value="2">Estado</option>
                              <option value="0">Cancelado</option>
                              <option value="1">Desenvolvimento</option>
                              <option value="2">Em Analise</option>
                              <option value="3">Finalizado</option>
                            </select>
                          </div>
                        </div>

                        <div class="row">
                        <div class="col">
                            <label>Data Entrega: </label>
                            <input type="date" class="form-control" id="diaPj">
                        </div>
                        <div class="col">
                            <label>Horas estimadas: </label>
                            <input type="text" id="horasPj" class="form-control" placeholder="1478.00">
                        </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>Descrição</label>
                                <textarea class="form-control" id="descricaoPj" rows="5"></textarea>
                            </div>    
                        </div>
                    </form>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-light border" data-dismiss="modal" onclick="updtPj(1)">Registrar</button>
                  </div>
                </div>
              </div>
            </div>';         


    echo '</tbody>
    </table>';

    //verificando a pagina posterior e anterior
    $pg_after = $pagina - 1;
    $pg_before = $pagina + 1;

    echo'<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">';

    //button anterior
    if($pg_after != 0):
        echo'<li class="page-item">
        <a class="page-link" href="alterarProjeto.php?pgUpd='.$pg_after.'" tabindex="-1" aria-disabled="true">Previous</a>
        </li>';
    else:
        echo'<li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>';
    endif;
    //fim

    //loop das page-itens
    for($i = 1; $i < $numeroPgs + 1; $i++):
        echo'<li class="page-item"><a class="page-link" href="alterarProjeto.php?pgUpd='.$i.'">'. $i .'</a></li>';
    endfor;
    //fim

    //button posterior
    if($pg_before <= $numeroPgs):
        echo'<li class="page-item">
        <a class="page-link" href="alterarProjeto.php?pgUpd='.$pg_before.'">Next</a>
        </li>';
    else:
        echo'<li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
    </li>';
    endif;

    echo'</ul>
    </nav>';


    }else{

    echo "Nenhum Resultado";

    }
else:

    //CMD SQL
    $sqlSlctPd = "SELECT codigoProjeto, nomeDoProjeto, dataDeTermino, codigoFKCliente FROM Projeto WHERE nomeDoProjeto LIKE '%$search%'";;
          
    //executando
    $sqlExcut = $conn->query($sqlSlctPd);   //busca especifico
    $numberRow = $sqlExcut->num_rows;

    //verificando se há registro
    if($numberRow > 0):
      
      echo'<table class="table text-center">
      <thead class="#" style="background-color: #43528A; color: white;">
          <tr>
              <th scope="col">Projeto</th>
              <th scope="col">Data entrega</th>
              <th scope="col">Ações</th>
          </tr>
      </thead>
      <tbody class="textColorPadrao">';
      
      while($result = $sqlExcut->fetch_assoc()){

          if($result['dataDeTermino'] == null){

              $result['dataDeTermino'] = "20-11-10";

          }

          echo'<tr>
          <td>' . $result['nomeDoProjeto'] . '</td>
          <td>Data entrega: ' . $result['dataDeTermino'] . '</td>
          <td>
          <button type="button"
          class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesProjeto" onclick="detalhes('.$result['codigoProjeto'].', '.$result['codigoFKCliente'].');" >Detalhes</button>
              <button type="button"
              class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#AlterarProjeto" onclick="pegarValor('.$result['codigoFKCliente'].', '.$result['codigoProjeto'].')">Alterar</button>
              <button type="button"
                  class="btn btn-light border textColorPadrao" onclick="apagarProjeto('.$result['codigoFKCliente'].', '.$result['codigoProjeto'].')">Deletar</button>
          </td>
      </tr>';

      }

      echo'<!-- Modal detalhes -->
            <div class="modal fade textColorPadrao" id="DetalhesProjeto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-left">
                    <div id="modalResult"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>';
        
            echo'<!-- Modal update -->
            <div class="modal fade" id="AlterarProjeto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-left">
                    <div id="modalAlter">

                    <input type="hidden" id="codigoCli" value="">
                    <input type="hidden" id="codigoPj" value="">

                    <form>
                        <div class="row">
                          <div class="col">
                              <label>Nome do projeto:</label>
                              <input type="text" class="form-control" id="nomePj" placeholder="Nome do projeto: ">
                          </div>
                          <div class="col my-1">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Status Do Projeto: </label>
                            <select class="custom-select mr-sm-2" id="statusPj">
                              <option selected value="2">Estado</option>
                              <option value="0">Cancelado</option>
                              <option value="1">Desenvolvimento</option>
                              <option value="2">Em Analise</option>
                              <option value="3">Finalizado</option>
                            </select>
                          </div>
                        </div>

                        <div class="row">
                        <div class="col">
                            <label>Data Entrega: </label>
                            <input type="date" class="form-control" id="diaPj">
                        </div>
                        <div class="col">
                            <label>Horas estimadas: </label>
                            <input type="text" id="horasPj" class="form-control" placeholder="1478.00">
                        </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>Descrição</label>
                                <textarea class="form-control" id="descricaoPj" rows="5"></textarea>
                            </div>    
                        </div>
                    </form>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-light border" data-dismiss="modal" onclick="updtPj()">Registrar</button>
                  </div>
                </div>
              </div>
            </div>';    

      echo '</tbody>
      </table>';
      
    else:
      
      echo"Nenhum resultado";

    endif;

endif;


 $conn->close();


?>

<script type="text/javascript" src="../../Js/scriptBack.js"></script>

</html>