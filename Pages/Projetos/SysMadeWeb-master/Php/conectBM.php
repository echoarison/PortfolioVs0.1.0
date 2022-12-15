<?php
    $server = "none";
    $userDb = "none";
    $passDb = "none";
    $bancoDb = "none";

    $conn = new mysqli($server, $userDb, $passDb, $bancoDb);

    //Checando conexão
    if ($conn->connect_error){
        die("Falha na conexão: " . $conn->connect_error);
    }


?>
