<?php
    require_once  $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    session_start();
    if (!($_SESSION && key_exists("user",$_SESSION))){
        header("location: ../login.php?message=Utente+non+loggato");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Granda Evento snc - Acchiardi Paolo</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/icona.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <style>
    table, th, td {
    border: 2px solid black;
    }
    </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">Area riservata</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"></ul>
                    <form class="d-flex" action = "../login.php">
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
                        <li class="breadcrumb-item"><a href="../control.php">Home page</a></li>
                        <li class="breadcrumb-item"><a href="query_list.php">QUERY</a></li>
                        <li class="breadcrumb-item active" aria-current="page">terza query</li>
                      </ol>
                  </nav>
                  <br>
                  <?php
        if (!isset($_POST['addetto']) or !isset($_POST['evento'])){
    ?>
    <h3>Elenco personale abile per le stesse mansioni di un addetto che dev'essere sostituito in un altro evento</h3>
    <form method="post" action="query3.php">
        <p> Codice fiscale Addetto: </p>
        <input list="addetti" name="addetto">
        <datalist id="addetti">
        </datalist>
        <p> Nome evento: </p>
        <input list="eventi" name="evento">
        <datalist id="eventi">
        </datalist>
        <button type="submit" class="btn btn-outline-dark">Ricerca</button>
    </form> <br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script type='text/javascript'>
        const url = new URL(window.location.href);
        $(document).ready(async()=>{
            if(url.searchParams.get("message")){
                const message = url.searchParams.get("message");
                alert(message);
            }
            const RESCODICIFISCALI = await fetch(`${url.origin}/elaborato_prog/api/personale/getAllCF.php`);
            const cf = await RESCODICIFISCALI.json();
            cf.forEach((el)=>{
                const codiceFiscale = el.cf;
                $("#addetti").append(`<option value="${codiceFiscale}">`);
            })
            const RESNOMIEVENTI = await fetch(`${url.origin}/elaborato_prog/api/eventi/getAllNames.php`);
            const nomiEventi = await RESNOMIEVENTI.json();
            nomiEventi.forEach((el)=>{
                const nomeEvento = el.nome;
                $("#eventi").append(`<option value="${nomeEvento}">`);
            })
        })
    </script>
    <?php
        }else{
            try{
                $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
                $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $addetto = $_POST['addetto'];
                $evento = $_POST['evento'];
                $command = $con -> prepare("SELECT id FROM personale P WHERE P.cf = :addetto");
                $command -> bindParam(":addetto", $addetto, PDO::PARAM_STR);
                $command -> execute();
                $results = $command -> fetch(PDO::FETCH_ASSOC);
                $message = "";
                if($results == ""){
                    $message .= "Questo+addetto+non+esiste";
                }
                $command = $con -> prepare("SELECT id FROM eventi E WHERE E.nome = :evento");
                $command -> bindParam(":evento", $evento, PDO::PARAM_STR);
                $command -> execute();
                $results = $command -> fetch(PDO::FETCH_ASSOC);
                if($results == ""){
                    if(strlen($message) != 0){
                        $message .= "+e+questo+evento+non+esiste";
                    }else{
                        $message .= "Questo+evento+non+esiste";
                    }
                }
                if(strlen($message) != 0){
                    header("location: query3.php?message=".$message);
                }else{
                    $command = $con -> prepare("SELECT MP.idMansione FROM personale P,eventi E, personaleineventi PE,
                     mansionipersonale MP WHERE E.nome = :evento AND P.cf = :addetto AND E.id = PE.idEvento
                     AND PE.idMansionePersona = MP.id AND MP.idPersona = P.id");
                    $command -> bindParam(":evento", $evento, PDO::PARAM_STR);
                    $command -> bindParam(":addetto", $addetto, PDO::PARAM_STR);
                    $command -> execute();
                    $results = $command -> fetchall(PDO::FETCH_ASSOC);
                    if($results[0] == ""){
                        header("location: query3.php?message=Questo+addetto+non+ricopre+mansioni+in+questo+evento");
                    }else{
                        $query = "SELECT DISTINCT P.nome, P.cognome, P.nascita, P.email, P.cf
                        FROM personale P, mansionipersonale MP
                        WHERE MP.idPersona = P.id AND P.cf <> :addetto";
                        foreach($results as $res){
                            $query.=" AND MP.idPersona IN 
                            (SELECT MP.idPersona
                                FROM mansionipersonale MP
                                WHERE MP.idMansione = ".$res["idMansione"].")";
                        }
                        $command = $con -> prepare($query);
                        $command -> bindParam(":addetto", $addetto, PDO::PARAM_STR);
                        $command -> execute();
                        $results = $command -> fetchall(PDO::FETCH_ASSOC);
                        if($results[0] == ""){
                            header("location: query3.php?message=Non+esistono+addetti+con+le+stesse+mansioni");
                        }else{
                            echo "<table border='1px'><tr><th>Nome</th><th>Cognome</th><th>Nascita</th><th>Email</th><th>Codice fiscale</th></tr>";
                            foreach($results as $res){
                                echo "<tr><td>".$res["nome"]."</td><td>".$res["cognome"]."</td><td>".$res["nascita"]."</td><td>".$res["email"]."</td><td>".$res["cf"]."</td></tr>";
                            }
                            echo "</table>";
                        }
                    }
                }
            }catch(PDOException $e){
                die("<form method = 'POST' action = '../control.php'>
                    <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di controllo</button>
                    </form><br>Errore: " . $e -> getMessage());
            }
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
        <script src="../js/scripts.js"></script>
    </body>
</html>