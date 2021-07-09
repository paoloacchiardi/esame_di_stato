<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    session_start();
    if (!($_SESSION && key_exists("user",$_SESSION))){
        header("location: ../../login.php?message=Utente+non+loggato");
    }else{
        try{
            $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
            $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $command = $con -> prepare("SELECT cap FROM citta");
            $command -> execute();
            $results = $command -> fetchall(PDO::FETCH_ASSOC);
            echo json_encode($results);
        }catch(PDOException $e){
            die("Errore: " . $e -> getMessage());
        }
    }
?>