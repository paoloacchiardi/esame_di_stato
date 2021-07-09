<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    session_start();
    if (!($_SESSION && key_exists("user",$_SESSION))){
        header("location: ../login.php?message=Utente+non+loggato");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Sensori</title>
    <style>
    table, th, td {
    border: 2px solid black;
    }
    </style>
</head>
<body>
<?php
    try{
        $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $command = $con -> prepare("SELECT DISTINCT L.id AS 'IdLog', L.idSensore, T.nome AS 'Tipo', A.nome AS 'Nome area',
            E.nome AS 'Nome evento', L.data, L.ora, L.dato FROM log L, sensori S, tipi T, sensoriineventi SE, areeineventi AE,
            aree A, eventi E WHERE L.idSensore = S.id AND S.idTipo = T.id AND S.id = SE.idSensore AND SE.idAreaInEvento =
            AE.id AND AE.idArea = A.id AND AE.idEvento = E.id AND L.data >= E.dataInizio AND L.data <= 
            (E.dataInizio+E.numGiorni-1) ORDER BY L.id DESC");
        $command -> execute();
        $results = $command -> fetchall(PDO::FETCH_ASSOC);
        echo "<table><tr><th>IdLog</th><th>idSensore</th><th>Tipo</th><th>Nome area</th>
        <th>Nome evento</th><th>Data</th><th>Ora</th><th>Dato</th></tr>";
        foreach($results as $res){
            if(($res["Tipo"] == "metal detector" && $res["dato"] == 1) || ($res["Tipo"] == "smoke detector" && $res["dato"] >= 600) 
            || ($res["Tipo"] == "ip camera" && $res["dato"] > 37.5)){
                //rosso, dato allarmante
                $text = "<span style='color:#FF0000'><strong>";
                $text2 = "</strong>";
            }else{
                //nero, dato normale
                $text = "<span style='color:#000000'>";
                $text2 = "";
            }
            echo "<tr><td>".$text.$res["IdLog"].$text2."</td><td>"
            .$text.$res["idSensore"].$text2."</td><td>".$text.$res["Tipo"].$text2."</td>
            <td>".$text.$res["Nome area"].$text2."</td><td>".$text
            .$res["Nome evento"].$text2."</td><td>".$text.$res["data"].$text2."</td>
            <td>".$text.$res["ora"].$text2."</td><td>".$text.$res["dato"].$text2."</td></tr>";
        }
        echo "</table>";
    }catch(PDOException $e){
        die("<form method = 'POST' action = '../control.php'>
        <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di controllo</button>
        </form> <br> Errore:" . $e -> getMessage());
    }
?>
</body>
</html>