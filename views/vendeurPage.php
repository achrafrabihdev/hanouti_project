<?php
//include ('../models/Vendeur.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
$boutiques = Vendeur::boutiques($_SESSION['id_vendeur']);
$nbrCommandes= Vendeur::commandesAL($_SESSION['id_vendeur']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>hanouti - Vendeur page</title>
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
                <a class="dropdown-item" href="nouveauBoutique.php">Nouveau boutique</a>
                <a class="dropdown-item" href="historique.php">Historique</a>
                <a class="dropdown-item" href="commandesAlivrer.php">Les commandes à livrer
                <div class="badge badge-pill badge-primary"> 
                    <?php echo (!empty($nbrCommandes))?count(($nbrCommandes)):'0'; ?>
                </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/vendeurController.php?a=decon">deconexion</a>
            </div>
        </nav>
        <div class="container" style="margin-top: 18vh;">
            <div class="row">
            <?php foreach($boutiques as $b){ 
                 $evlBoutique = Evaluation::evlBoutique($b->id);?>
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
                            <a href="produitsPage.php?bid=<?=$b->id?>&bnom=<?=$b->nom?>" class="btn btn-primary"><i class="far fa-folder-open"></i></a>
                            <a href="modifierBoutique.php?bid=<?=$b->id?>" class="btn btn-primary"><i class="far fa-edit"></i></a>
                            <a href="../controllers/boutiqueController.php?a=supp&bid=<?=$b->id?>" class="btn btn-primary"><i class="far fa-trash-alt"></i></a>
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
        <script>
            setInterval(true,5000);
        </script>
</body>
</html>