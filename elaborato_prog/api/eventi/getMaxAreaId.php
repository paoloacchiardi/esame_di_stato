<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    try{
        $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $command = $con -> prepare("SELECT max(AE.id) AS 'idMaxArea' FROM areeineventi AE");
        $command -> execute();
        $results = $command -> fetchall(PDO::FETCH_ASSOC);
        echo json_encode($results);
    }catch(PDOException $e){
        die("Errore: " . $e -> getMessage());
    }
?>