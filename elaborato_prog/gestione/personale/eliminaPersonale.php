<?php
    require_once  $_SERVER['DOCUMENT_ROOT'].'/elaborato_prog/config.php';
    session_start();
    if (!($_SESSION && key_exists("user",$_SESSION))){
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
                        <li class="breadcrumb-item"><a href="personale.php">Gestione personale</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Elimina personale</li>
                      </ol>
                  </nav>
                  <br>
                  <?php
        if (!isset($_POST['addetto'])){
    ?>
    <h1> Elimina personale </h1>
    <form method='POST' action='eliminaPersonale.php'>
        <p> Codice fiscale Addetto: </p>
        <input list="addetti" name="addetto">
        <datalist id="addetti">
        </datalist>
        <button type="submit" class="btn btn-outline-dark">Elimina</button>
    </form>
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
        })
    </script>
    <?php
        }else{
            try{
                $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
                $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $addetto = $_POST['addetto'];
                $command = $con -> prepare("SELECT id FROM personale WHERE cf = :addetto");
                $command -> bindParam(":addetto",$addetto,PDO::PARAM_STR);
                $command -> execute();
                $results = $command -> fetch(PDO::FETCH_ASSOC);
                if($results == ""){
                    header("location: eliminaPersonale.php?message=Addetto+non+presente+nel+database");
                }else{
                $command = $con -> prepare("DELETE FROM personale WHERE cf = :addetto");
                $command -> bindParam(":addetto",$addetto,PDO::PARAM_STR);
                $command -> execute();
                header("location: eliminaPersonale.php?message=Addetto+rimosso+correttamente");
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
        <!-- Footer--> <br>
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Granda eventi snc 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
    </body>
</html>