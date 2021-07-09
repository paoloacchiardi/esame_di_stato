<?php //idSensore,dato
    require_once $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(key_exists("idSensore",$_GET) && key_exists("dato",$_GET)){
            $idSensore = $_GET["idSensore"];
            $dato = $_GET["dato"];
            try{
                date_default_timezone_set('Europe/Rome');
                $hour = explode(" ",date('Y-m-d H:i:s'))[1];
                $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
                $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $command = $con -> prepare("INSERT INTO log (idSensore, data, ora, dato) VALUES (:idSensore,CURDATE(),:hour,:dato)");
                $command -> bindParam(":idSensore", $idSensore, PDO::PARAM_STR);
                $command -> bindParam(":hour", $hour, PDO::PARAM_STR);
                $command -> bindParam(":dato", $dato, PDO::PARAM_STR);
                $command -> execute();
            }catch(PDOException $e){
                die("<form method = 'POST' action = '../control.php'>
                    <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di controllo</button>
                    </form> <br> Errore:" . $e -> getMessage());
            }
        }
    }
?>