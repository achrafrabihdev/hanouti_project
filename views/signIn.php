<?php 
    $message="";
    $class="";
    $style="";
    extract($_GET);
    if(isset($c)&& $c=='no'){
        $class = 'alert alert-danger text-center';
        $message = 'email / mot de pass incorrecte';
        $style='style="margin-top:1vh;"';
    }
?><!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../fontawesome/css/all.min.css">
        <title>hanouti.ma - Conexion </title>
        <style>
        .register{
            margin-top: 18vh;
        }
        #myTabContent{
            padding-top: 15vh;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" width="150" height="50" class="d-inline-block align-top" alt="hanouti-logo" loading="lazy">
            </a>
            <a href="index.php" class="btn btn-primary float-right">S'inscrire</a>
    </nav>
        <div class="container register" style="min-height: 70vh;">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="vendeur-tab" data-toggle="tab" href="#vendeur" role="tab" aria-controls="vendeur" aria-selected="true">Vendeur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="client-tab" data-toggle="tab" href="#client" role="tab" aria-controls="client" aria-selected="false">Client</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active text-align form-new" id="vendeur" role="tabpanel" aria-labelledby="vendeur-tab">
                            <div class="row register-form">
                                <div class="col-md-6 mx-auto">
                                    <form method="post" action="../controllers/vendeurController.php?a=signin">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control text-center" placeholder="Email"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="mdp" class="form-control text-center" placeholder="Mot de passe" />
                                        </div>                       
                                           <button class="btn btn-primary btn-block">Conexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show text-align form-new" id="client" role="tabpanel" aria-labelledby="client-tab">
                            <div class="row register-form">
                                <div class="col-md-6 mx-auto">
                                    <form method="post" action="../controllers/clientController.php?a=signin">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control text-center" placeholder="Email"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="mdp" class="form-control text-center" placeholder="Mot de passe" />
                                        </div>
                                    
                                           <button class="btn btn-primary btn-block">Conexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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