<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    session_start();
    if (!($_SESSION && key_exists("user",$_SESSION))){
        header("location: ../login.php?message=Utente+non+loggato");
    }
    try{
        $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $command = $con -> prepare("SELECT E.nome AS 'nomeEvento', count(*) AS 'numAccessi' 
        FROM log L, sensori S, tipi T, sensoriineventi SE, areeineventi AE, eventi E 
        WHERE L.idSensore = S.id AND S.idTipo = T.id AND T.nome = 'ip camera' AND SE.idSensore = L.idSensore
        AND SE.idAreaInEvento = AE.id AND AE.idEvento = E.id AND (E.dataInizio+E.numGiorni-1) < CURDATE() 
        AND L.data BETWEEN E.dataInizio AND (E.dataInizio+E.numGiorni-1) GROUP BY E.nome");
        $command -> execute();
        $results = $command -> fetchall(PDO::FETCH_ASSOC);
        $data = array();
        foreach($results as $res){
            $data[] = $res;
        }
        print json_encode($data);
    }catch(PDOException $e){
        die("<form method = 'POST' action = '../control.php'>
            <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di controllo</button>
            </form><br>Errore: " . $e -> getMessage());
    }
?>