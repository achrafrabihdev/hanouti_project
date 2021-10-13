<?php 
    $message="";
    $class="";
    $style="";
    extract($_GET);
    if(isset($x)&& !empty($x)){
        $class = 'alert alert-success text-center';
        $message = 'L\'inscription a été faite avec succès';
        $style='style="margin-top:1vh;"';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../fontawesome/css/all.min.css">
        <title>hanouti.ma - bienvenu </title>
        <style>
            .tx{
                font-family: 'Modak', cursive;
                font-size: 40px;
                padding-top: 25vh;
            }
            i{
                font-size: 80px;
            }
        </style>
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" width="150" height="50" class="d-inline-block align-top" alt="hanouti-logo" loading="lazy">
            </a>
            <a href="../views/signIn.php" class="btn btn-primary float-right">connexion</a>
        </nav>
        <div class="container" style="min-height:90vh;">
            <p class="text-primary text-center tx">Nouveau utilisateur ?<br>s'inscrire maintenant</p>
            <br>
            <div class="row">
                <div class="col-sm-6 text-center">
                <i class="fas fa-user-tie text-primary"></i>
                <br>
                <br>
                <a href="signUp.php?type=vendeur" class="btn btn-primary">Vendeur</a>
                <br>
                <br>
                </div>
                <div class="col-sm-6 text-center">
                <i class="fas fa-user text-primary"></i>
                <br>
                <br>
                <a href="signUp.php?type=client" class="btn btn-primary">Client</a>
                </div>   
            </div>
            <div class="<?=$class?>" <?=$style?>><?=$message?></div>
        </div>
        <footer>
            <div class="footer-copyright text-center py-3 text-primary lead">© 2020 Copyright:
            <a href="#"> hanouti.ma</a>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>