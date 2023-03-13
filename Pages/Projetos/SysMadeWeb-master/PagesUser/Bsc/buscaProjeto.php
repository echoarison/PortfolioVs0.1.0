
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
     //chamando o banco de dados  
     require_once "../../Php/conectBM.php";
     
     //guardando a valor do ajax
     
     if(!isset($_POST['searchPj'])):
        
        $_POST['searchPj'] = "";

        $search = $_POST['searchPj'];

     else:

        $search = $_POST['searchPj'];
     
     endif;
     
     //fim

     //valor da pagina
     if(!isset($_GET['pg'])){

         $_GET['pg'] = 1;

         $pagina = $_GET['pg'];

     }else{

         $pagina = $_GET['pg'];

     }
     //fim


if($search == "" || $search == null):
     //Executando comandos
     $sqlpg = "SELECT codigoProjeto, nomeDoProjeto, dataDeTermino, statusProjeto, codigoFKCliente FROM Projeto";    //chamando tudo que tem no banco
     $sqlExcutPg = $conn->query($sqlpg);     //para o sistema de paginacao
     $numberRowPg = $sqlExcutPg->num_rows;   //total de registros no banco

     //variaveis da paginacao
     $qtdItensPg = 6;

     //limpando o resultado
     $sqlExcutPg->free_result();
     $sqlExcutPg = "";

     //calculando o numeros de pagina
     $numeroPgs = ceil($numberRowPg/ $qtdItensPg);    //usando a função ou method ceil para redondar os numeros

     //calculando o inicio dos itens
     $inicio = ($qtdItensPg * $pagina) - $qtdItensPg;

     //selecionando o que apresentar
     $sqlSlctItens = "SELECT codigoProjeto, nomeDoProjeto, dataDeTermino, statusProjeto, codigoFKCliente FROM Projeto LIMIT $inicio, $qtdItensPg";
     $sqlExecutPg = $conn->query($sqlSlctItens);
     $totalItens = $sqlExecutPg->num_rows;

     if($totalItens > 0){

         //colocando table no php
         echo '<table class="table text-center">
         <thead class="#" style="background-color: #43528A; color: white;">
             <tr>
                 <th scope="col">Projeto</th>
                 <th scope="col">Status</th>
                 <th scope="col">Ações</th>
             </tr>
         </thead>
         <tbody class="textColorPadrao">';

         while($resultado = $sqlExecutPg->fetch_assoc()):

          if($resultado['statusProjeto'] == "" || $resultado['statusProjeto'] == null){

            $resultado['statusProjeto'] = "Em Análise";
            $corText = "text-info";

          }elseif($resultado['statusProjeto'] == 0){

            $resultado['statusProjeto'] = "Cancelado";
            $corText = "text-danger";

          }elseif($resultado['statusProjeto'] == 1){

            $resultado['statusProjeto'] = "Em Desenvolvimento";
            $corText = "text-primary";

          }elseif($resultado['statusProjeto'] == 2){

            $resultado['statusProjeto'] = "Em Análise";
            $corText = "text-info";

          }elseif($resultado['statusProjeto'] == 3){

            $resultado['statusProjeto'] = "Finalizado";
            $corText = "text-success";

          }

             echo'<tr>
             <td>' . $resultado["nomeDoProjeto"] . '</td>
             <td class="'.$corText.'">' . $resultado["statusProjeto"] .' '. $resultado["dataDeTermino"] .'</td>
             <td><button type="button"
             class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesProjeto" onclick="detalhes('.$resultado['codigoProjeto'].', '.$resultado['codigoFKCliente'].', 1);" >Detalhes</button>
             </tr>';

         endwhile;

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
         
         echo "</tbody>";
         echo "</table>";

         //verificando a pagina posterior e anterior
         $pg_after = $pagina - 1;
         $pg_before = $pagina + 1;

         echo'<nav aria-label="Page navigation example">
         <ul class="pagination justify-content-center">';

         //button anterior
         if($pg_after != 0):
             echo'<li class="page-item">
             <a class="page-link" href="buscaProjeto.php?pg='.$pg_after.'" tabindex="-1" aria-disabled="true" id="paginacao">Previous</a>
             </li>';
         else:
             echo'<li class="page-item disabled">
             <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
             </li>';
         endif;
         //fim
         
         //loop das page-itens
         for($i = 1; $i < $numeroPgs + 1; $i++):
             echo'<li class="page-item"><a class="page-link" href="buscaProjeto.php?pg='.$i.'" id="paginacao">'. $i .'</a></li>';
         endfor;
         //fim
         
         //button posterior
         if($pg_before <= $numeroPgs):
             echo'<li class="page-item">
             <a class="page-link" href="buscaProjeto.php?pg='.$pg_before.'" id="paginacao">Next</a>
             </li>';
         else:
             echo'<li class="page-item disabled">
             <a class="page-link" href="#">Next</a>
         </li>';
         endif;
         
         echo'</ul>
         </nav>';

     }else{
         echo "Nenhum Resultado 0";
     }
else:

    //cmd sql
    //$sqlSlctPj = "SELECT nomeDoProjeto, dataDeTermino, statusProjeto FROM Projeto WHERE nomeDoProjeto LIKE '%$search%' ";
    $sqlSlctPj = "SELECT codigoProjeto, nomeDoProjeto, dataDeTermino, statusProjeto, codigoFKCliente FROM Projeto WHERE nomeDoProjeto LIKE '%$search%'";       
            
    //Executando comandos
        
    $sqlExcut = $conn->query($sqlSlctPj);   //busca especifico
    $numberRow = $sqlExcut->num_rows;

    //verificando se vem algo
    if($numberRow > 0):

            //colocando table no php
            echo '<table class="table text-center">
            <thead class="#" style="background-color: #43528A; color: white;">
                <tr>
                    <th scope="col">Projeto</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="textColorPadrao">';
    
            //echo '<tbody class="textColorPadrao">';
    
            while($result = $sqlExcut->fetch_assoc()): 
    
              if($result['statusProjeto'] == "" || $result['statusProjeto'] == null){

                $result['statusProjeto'] = "Em Análise";
                $corText = "text-info";
    
              }elseif($result['statusProjeto'] == 0){
    
                $result['statusProjeto'] = "Cancelado";
                $corText = "text-danger";
    
              }elseif($result['statusProjeto'] == 1){
    
                $result['statusProjeto'] = "Em Desenvolvimento";
                $corText = "text-primary";
    
              }elseif($result['statusProjeto'] == 2){
    
                $result['statusProjeto'] = "Em Análise";
                $corText = "text-info";
    
              }elseif($result['statusProjeto'] == 3){
    
                $result['statusProjeto'] = "Finalizado";
                $corText = "text-success";
    
              }
    
                echo'<tr>
                <td>' . $result["nomeDoProjeto"] . '</td>
                <td class="'.$corText.'">' . $result["statusProjeto"] .' '. $result["dataDeTermino"] .' </td>
                <td><button type="button"
                class="btn btn-light border textColorPadrao" data-toggle="modal" data-target="#DetalhesProjeto" onclick="detalhes('.$result['codigoProjeto'].', '.$result['codigoFKCliente'].');" >Detalhes</button>
                </tr>';

            endwhile;

            echo'<!-- Modal detalhes -->
            <div class="modal fade" id="DetalhesProjeto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            
            echo "</tbody>";
            echo "</table>";

        else:

            echo"Nenhum resultado";

        endif;

endif;

     $conn->close();

?>

<script type="text/javascript" src="../../Js/scriptBack.js"></script>
<script type="text/javascript" src="../../Js/bootstrap.js"></script>
<script type="text/javascript" src="../../Js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Js/jquery-3.5.1.min.js"></script>

</html>