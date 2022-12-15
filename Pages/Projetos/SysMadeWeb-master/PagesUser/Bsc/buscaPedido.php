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
 require_once('../../Php/conect.php');

 //guardando a valor do ajax
     
if(!isset($_POST['searchCliPd'])):
        
    $_POST['searchCliPd'] = "";

    $search = $_POST['searchCliPd'];

 else:

    $search = $_POST['searchCliPd'];
 
 endif;
 
 //fim

 //valor da pagina
 if(!isset($_GET['pgCli'])){

   $_GET['pgCli'] = 1;

   $pagina = $_GET['pgCli'];

  }else{

       $pagina = $_GET['pgCli'];

  }
 //fim

if($search == "" || $search == null): 
 //CMD SQL
 $sqlSlect = "SELECT CODIGOPEDIDO, CODIGOFKSCLIENTE, NOMEDOPEDIDO, DATAREALIZADO FROM PEDIDO";
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
 $sqlSlctItens = "SELECT CODIGOPEDIDO, CODIGOFKSCLIENTE, NOMEDOPEDIDO, DATAREALIZADO FROM PEDIDO LIMIT $inicio, $qtdItensPg";
 $sqlExecut = $conn->query($sqlSlctItens);
 $totalItens = $sqlExecut->num_rows;

 if($totalItens > 0){
   echo'<table class="table text-center">
   <thead class="#" style="background-color: #43528A; color: white;">
       <tr>
           <th scope="col">Projeto</th>
           <th scope="col">Data Solicitado</th>
           <th scope="col">Ações</th>
       </tr>
   </thead>
   <tbody class="textColorPadrao">';

   while($result = $sqlExecut->fetch_assoc()){
       
       if($result['DATAREALIZADO'] == null){

           $result['DATAREALIZADO'] = "20-11-10";

       }

       echo'<tr>
       <td>' . $result['NOMEDOPEDIDO'] . '</td>
       <td>Data entrega: ' . $result['DATAREALIZADO'] . '</td>
       <td>
       <button type="button"
       class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesPedido" onclick="detalhesPd('.$result['CODIGOPEDIDO'].', '.$result['CODIGOFKSCLIENTE'].', 1);" >Detalhes</button>
       <button type="button"
       class="btn btn-light border textColorPadrao" onclick="acRec(1)">Aceitar</button>
       <button type="button"
       class="btn btn-light border textColorPadrao" onclick="acRec(0)">Recusar</button>
       </td>
       </tr>';
   }

   echo'<!-- Modal detalhes -->
      <div class="modal fade textColorPadrao" id="DetalhesPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-left">
              <div id="modalResultPedido"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
       <a class="page-link" href="buscaPedido.php?pgCli='.$pg_after.'" tabindex="-1" aria-disabled="true">Previous</a>
       </li>';
   else:
       echo'<li class="page-item disabled">
       <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
       </li>';
   endif;
   //fim

   //loop das page-itens
   for($i = 1; $i < $numeroPgs + 1; $i++):
       echo'<li class="page-item"><a class="page-link" href="buscaPedido.php?pgCli='.$i.'">'. $i .'</a></li>';
   endfor;
   //fim

   //button posterior
   if($pg_before <= $numeroPgs):
       echo'<li class="page-item">
       <a class="page-link" href="buscaPedido.php?pgCli='.$pg_before.'">Next</a>
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
    $sqlSlctPd = "SELECT CODIGOPEDIDO, CODIGOFKSCLIENTE, NOMEDOPEDIDO, DATAREALIZADO FROM PEDIDO WHERE NOMEDOPEDIDO LIKE '%$search%'";
          
    //executando
    $sqlExcut = $conn->query($sqlSlctPd);   //busca especifico
    $numberRow = $sqlExcut->num_rows;

    //verificando se há registro
    if($numberRow > 0):
      
      echo'<table class="table text-center">
      <thead class="#" style="background-color: #43528A; color: white;">
          <tr>
              <th scope="col">Projeto</th>
              <th scope="col">Data Solicitado</th>
              <th scope="col">Ações</th>
          </tr>
      </thead>
      <tbody class="textColorPadrao">';
      
      while($result = $sqlExcut->fetch_assoc()){

          if($result['DATAREALIZADO'] == null){

              $result['DATAREALIZADO'] = "20-11-10";

          }

          echo'<tr>
          <td>' . $result['NOMEDOPEDIDO'] . '</td>
          <td>Data entrega: ' . $result['DATAREALIZADO'] . '</td>
          <td>
          <button type="button"
          class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesPedido" onclick="detalhesPd('.$result['CODIGOPEDIDO'].', '.$result['CODIGOFKSCLIENTE'].');" >Detalhes</button>
              <button type="button"
                  class="btn btn-light border textColorPadrao" onclick="acRec(1)">Aceitar</button>
              <button type="button"
                  class="btn btn-light border textColorPadrao" onclick="acRec(0)">Recusar</button>
          </td>
      </tr>';

      }

      echo'<!-- Modal detalhes -->
      <div class="modal fade" id="DetalhesPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-left">
              <div id="modalResultPedido"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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