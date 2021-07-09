<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    try{
        $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $command = $con -> prepare("SELECT S.id, T.nome, AE.id AS 'area' FROM sensori S, tipi T, sensoriineventi SE, 
        areeineventi AE, eventi E WHERE T.id = S.idTipo AND SE.idSensore = S.id AND AE.id = SE.idAreaInEvento AND AE.idEvento
         = E.id AND CURDATE() <= DATE_ADD(E.dataInizio, INTERVAL E.numGiorni-1 DAY)");
        $command -> execute();
        $results = $command -> fetchall(PDO::FETCH_ASSOC);
        echo json_encode($results);
    }catch(PDOException $e){
        die("Errore: " . $e -> getMessage());
    }
?>