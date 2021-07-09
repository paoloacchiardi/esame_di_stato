<?php
	require_once  $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    session_start();
    if (!($_SESSION && key_exists("user",$_SESSION) && key_exists("nomeEvento",$_SESSION))){
        header("location: ../../login.php?message=Utente+non+loggato");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Granda Evento snc - Acchiardi Paolo</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../../assets/icona.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../../control.php">Area riservata</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"></ul>
                    <form class="d-flex" action = "../../login.php">
                        <button class="btn btn-outline-dark" type="submit">
                            logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Benvenuto nell'area riservata!</h1>
                    <p class="lead fw-normal text-white-50 mb-0">da qui potrai effetturare tutti i controlli</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section>
            <div class="container px-4 px-lg-5 mt-5">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../control.php">Home page</a></li>
                        <li class="breadcrumb-item"><a href="../gestioni.php">GESTIONE</a></li>
						<li class="breadcrumb-item"><a href="calcoloBudget.php">Gestione budget in eventi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Salvo mansioni</li>
                      </ol>
                  </nav>
                  <br>
                  <?php
    try{
        $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $command = $con -> prepare("SELECT id, retrOraria AS 'retribuzione oraria' FROM mansioni ORDER BY id");
        $command -> execute();
        $mansioniRichieste = $command -> fetchall(PDO::FETCH_ASSOC);
        $count = 1;
        $command = $con -> prepare("SELECT id FROM eventi WHERE nome = :nomeEvento ");
        $command -> bindParam(":nomeEvento", $_SESSION["nomeEvento"], PDO::PARAM_STR);
        $command -> execute();
        $res = $command -> fetch(PDO::FETCH_ASSOC);
        $idEvento = $res['id'];
        foreach($mansioniRichieste as $row){
            //$row['id'] -> idMansione
            //$_SESSION['numPersone'.$count] -> numPersone per quella mansione
            $command = $con -> prepare("SELECT id,numPersone FROM mansioniineventi WHERE idEvento = :idEvento AND idMansione =
            :idMansione");
            $command -> bindParam(":idEvento", $idEvento, PDO::PARAM_STR);
            $command -> bindParam(":idMansione", $row['id'], PDO::PARAM_STR);
            $command -> execute();
            $res = $command -> fetch(PDO::FETCH_ASSOC);
            $change = false;
            if($res == ""){
                //la mansione non è ancora stata inserita nel suddetto evento
                $command = $con -> prepare("INSERT INTO mansioniineventi (idEvento , idMansione , numPersone) VALUES (:idEvento , 
                :idMansione , :numPersone)");
                $command -> bindParam(":idEvento", $idEvento, PDO::PARAM_STR);
                $command -> bindParam(":idMansione", $row['id'], PDO::PARAM_STR);
                $command -> bindParam(":numPersone", $_SESSION['numPersone'.$count], PDO::PARAM_STR);
                $command -> execute();
                $change = true;
            }else if($res['numPersone'] < $_SESSION['numPersone'.$count]){
                //si vogliono inserire più persone
                $command = $con -> prepare("UPDATE mansioniineventi SET numPersone = :numPersone WHERE idEvento = :idEvento AND idMansione = :idMansione ");
                $command -> bindParam(":numPersone", $_SESSION['numPersone'.$count], PDO::PARAM_STR);
                $command -> bindParam(":idEvento", $idEvento, PDO::PARAM_STR);
                $command -> bindParam(":idMansione", $row['id'], PDO::PARAM_STR);
                $command -> execute();
                $change = true;
            }else if($res['numPersone'] > $_SESSION['numPersone'.$count]){
                //si vogliono inserire meno persone -> questo dettaglio viene segnalato
                $command = $con -> prepare("SELECT nome FROM mansioni WHERE id = :idMansione ");
                $command -> bindParam(":idMansione", $row['id'], PDO::PARAM_STR);
                $command -> execute();
                $risultato = $command -> fetch(PDO::FETCH_ASSOC);
                echo "Hai richiesto ". $_SESSION['numPersone'.$count] ." persone per la mansione '". $risultato['nome']. "'
                ma sul database sono salvate ". $res['numPersone']. " persone per questa mansione, rivedere
                il personale. <br>";
            }
            unset($_SESSION['numPersone'.$count]);
            $count = $count + 1;
        }
        unset($_SESSION['nomeEvento']);
        if($change){
            echo "<br><h3>Mansioni inserite nel database</h3><br>";
        }
        echo "<form method = 'POST' action = '../../control.php'>
        <button type = 'submit' class = 'btn btn-outline-dark'>Ritorna alla pagina di controllo</button>
        </form>";
    }catch(PDOException $e){
        die("<form method = 'POST' action = '../../control.php'>
            <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di controllo</button>
            </form> <br> Errore:" . $e -> getMessage());
    }
?>
            </div>
        </section>
        <!-- Footer--><br>
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Granda eventi snc 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
    </body>
</html>