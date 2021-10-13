<?php
//include ('../models/Client.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
$boutiques = Client::boutiques($_SESSION['quartier']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>hanouti - Client page</title>
</head>
<body class="bg-primary">
        <nav class="navbar navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" width="150" height="50" class="d-inline-block align-top" alt="hanouti-logo" loading="lazy">
            </a>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="mesCommandes.php">Mes commandes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/clientController.php?a=decon">deconexion</a>
            </div>
        </nav>
        <div class="container" style="margin-top: 18vh;">
            <div class="row">
            <?php foreach($boutiques as $b){ 
                
                    $evlBoutique = Evaluation::evlBoutique($b->id);

                        $evaluation = Evaluation::evlDeClient($b->id,$_SESSION['id_client']);         
            
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                                <i class="fas fa-star text-primary"></i>
                                <b class="text-primary">
                                   <?php echo (empty($evlBoutique->avgEvl)?'-----':$evlBoutique->avgEvl.'/5')?>
                                </b>
                                <i class="fas fa-star text-primary"></i>        
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center"><?=$b->nom?></h3>
                            <p class="card-text text-center"><?php echo $b->ville .' - '.$b->quartier;?></p>
                            <div class="text-center">
                                <a href="acheter.php?bid=<?=$b->id?>" class="btn btn-primary"><i class="far fa-folder-open"></i></a>
                                <a data-toggle="modal" href="#myModal<?=$b->id?>" class="btn btn-primary <?php echo (!empty($evaluation))?'disabled':''; ?>"><i class="far fa-star"></i></a>
                                    <div class="modal fade" id="myModal<?=$b->id?>" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary" >Evaluation du boutique : <?=$b->nom?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="../controllers/evaluationController.php?user=client&bid=<?=$b->id?>">
                                                        <div class="form-group">
                                                            <span class="float-left"><b>0</b></span>
                                                            <span><b>2.5</b></span>
                                                            <span class="float-right"><b>5</b></span>
                                                            <input type="range" class="form-control-range" min="0" max="5" step="0.5" name="evl">
                                                        </div>
                                                        
                                                        <button class="btn btn-primary btn-block ">Evaluer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            <?php }?>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>