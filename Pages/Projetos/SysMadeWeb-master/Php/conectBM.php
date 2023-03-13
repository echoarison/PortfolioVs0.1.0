<?php
    $server = "127.0.0.1";
    $userDb = "pcosta";
    $passDb = "D@10+XLqlM";
    $bancoDb = "bancoMBTest";

    $conn = new mysqli($server, $userDb, $passDb, $bancoDb);

    //Checando conexão
    if ($conn->connect_error){
        die("Falha na conexão: " . $conn->connect_error);
    }


?>
