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
                        <li class="breadcrumb-item"><a href="areeInEventi.php">Gestione aree</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Elimina area in evento</li>
                      </ol>
                  </nav>
                  <br>
                  <?php
        if (!isset($_POST['nomeArea']) || !isset($_POST['nomeEvento'])){
    ?>
    <h1> Elimina Area in un evento </h1>
    <form method='POST' action='eliminaAreaInEvento.php'>
        <p> Nome Area: </p>
        <input list="nomiAree" name="nomeArea">
        <datalist id="nomiAree">
        </datalist>
        <p> Nome Evento: </p>
        <input list="nomiEventi" name="nomeEvento">
        <datalist id="nomiEventi">
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
            const RES2 = await fetch(`${url.origin}/elaborato_prog/api/aree/getAllNames.php`);
            const nomi2 = await RES2.json();
            nomi2.forEach((el)=>{
                const nome2 = el.nome;
                $("#nomiAree").append(`<option value="${nome2}">`);
            })
            const RES = await fetch(`${url.origin}/elaborato_prog/api/eventi/getAllNames.php`);
            const nomi = await RES.json();
            nomi.forEach((el)=>{
                const nome = el.nome;
                $("#nomiEventi").append(`<option value="${nome}">`);
            })
        })
    </script>
    <?php
        }else{
            //area esiste, evento esiste, area in evento esiste, area non più in nessun evento dopo eliminazione
            try{
                $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
                $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $nomeArea = $_POST['nomeArea'];
                $nomeEvento = $_POST['nomeEvento'];
                $command = $con -> prepare("SELECT id FROM aree WHERE nome = :nomeArea ");
                $command -> bindParam(":nomeArea", $nomeArea, PDO::PARAM_STR);
                $command -> execute();
                $res = $command -> fetch(PDO::FETCH_ASSOC);
                $command = $con -> prepare("SELECT id FROM eventi WHERE nome = :nomeEvento");
                $command -> bindParam(":nomeEvento", $nomeEvento, PDO::PARAM_STR);
                $command -> execute();
                $res2 = $command -> fetch(PDO::FETCH_ASSOC);
                $msg = "";
                if($res == ""){
                    $msg .= "Area+non+esistente";
                    if($res2 == ""){
                        $msg .= "+evento+non+esistente";
                    }
                    header("location: eliminaAreaInEvento.php?message=".$msg);
                }else{
                    //area esistente
                    if($res2 == ""){
                        //area esistente, evento non esistente
                        header("location: eliminaAreaInEvento.php?message=Evento+non+esistente");
                    }else{
                        //area ed evento esistenti
                        $idArea = $res['id'];
                        $idEvento = $res2['id'];
                        $command = $con -> prepare("SELECT id FROM areeineventi WHERE idArea = :idArea AND idEvento = :idEvento ");
                        $command -> bindParam(":idArea", $idArea, PDO::PARAM_STR);
                        $command -> bindParam(":idEvento", $idEvento, PDO::PARAM_STR);
                        $command -> execute();
                        $res3 = $command -> fetch(PDO::FETCH_ASSOC);
                        if($res3 == ""){
                            //area esistente, evento esistente, area in evento non presente
                            header("location: eliminaAreaInEvento.php?message=Area+non+presente+in+questo+evento");
                        }else{
                            //area esistente, evento esistente, area presente in questo evento
                            $id = $res3['id'];
                            $command = $con -> prepare("DELETE FROM areeineventi WHERE id = :id");
                            $command -> bindParam(":id", $id, PDO::PARAM_STR);
                            $command -> execute();

                            //verifico se l'area appena eliminata è presente in altri eventi
                            $command = $con -> prepare("SELECT DISTINCT AE.idArea FROM areeineventi AE, aree A WHERE 
                            A.id = AE.idArea AND A.id = :idArea");
                            $command -> bindParam(":idArea", $idArea, PDO::PARAM_STR);
                            $command -> execute();
                            $res4 = $command -> fetch(PDO::FETCH_ASSOC);
                            if($res4 == ""){
                                //area non presente in altri eventi -> elimino definitivamente l'area
                                $command = $con -> prepare("DELETE FROM aree WHERE nome = :nomeArea");
                                $command -> bindParam(":nomeArea", $nomeArea, PDO::PARAM_STR);
                                $command -> execute();
                                header("location: eliminaAreaInEvento.php?message=Area+eliminata+dal+database");
                            }else{
                                //area presente in altri eventi -> non la elimino definitivamente
                                header("location: eliminaAreaInEvento.php?message=Area+eliminata+dall+evento");
                            }
                        }
                    }
                }
            }catch(PDOException $e){
                die("<form method = 'POST' action = '../../control.php'>
                    <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di controllo</button>
                    </form> <br> Errore:" . $e -> getMessage());
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