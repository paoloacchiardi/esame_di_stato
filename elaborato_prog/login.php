<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Granda Eventi snc</title>
        <link rel="icon" type="image/x-icon" href="assets/icona.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
    <body>
        <?php
            if (!isset($_POST['user']) or !isset($_POST['pw'])){
        ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Login</h1>
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input type="text" class="form-control" id="nickname" aria-describedby="emailHelp" placeholder = "Inserisci Username" name = "user">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder = "Inserisci password" name = "pw">  
                    </div>
                    <button type="submit" class="btn btn-outline-dark">Login</button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script type='text/javascript'>
            const url = new URL(window.location.href);
            $(document).ready(()=>{
                if(url.searchParams.get("message")){
                    const message = url.searchParams.get("message");
                    alert(message);
                }
            }) 
        </script>
        <?php
            }else{
                require_once 'config.php';
                try{
                $con = new PDO("mysql:host=localhost;dbname=".$dbname,"root");
                $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $user = $_POST['user'];
                $pw = md5($_POST['pw']);
                $command = $con -> prepare("SELECT id FROM login WHERE user = :user AND pw = :pw ");
                $command -> bindParam(":user", $user, PDO::PARAM_STR);
                $command -> bindParam(":pw", $pw, PDO::PARAM_STR);
                $command -> execute();
                $result = $command -> fetch(PDO::FETCH_ASSOC);
                if($result == ""){
                    header("location: login.php?message=Credenziali+sbagliate");
                }else{
                    session_start();
                    $_SESSION["user"] = $user;
                    $_SESSION["pw"] = $pw;
                    header("location: control.php");
                }
                }catch(PDOException $e){
                    die("<form method = 'POST' action = 'login.php'>
                        <button type = 'submit' class = 'btn btn-outline-dark'>Pagina di login</button>
                        </form><br>Errore: " . $e -> getMessage());
                }
            }
        ?>
    </body>
</html>