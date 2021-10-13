<?php
//include('../models/Produit.class.php');
spl_autoload_register(function ($class) {
  include('../models/' . $class . '.class.php');
});
extract($_GET);
$p = Produit::find($id);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>hanouti - Modifier produit</title>
    <style>
        #myForm{
            margin-top: 25vh;
        }
    </style>
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
                <a class="dropdown-item" href="nouveauProduit.php">Nouveau Produit</a>
                <a class="dropdown-item" href="vendeurPage.php">Mes boutiques</a>
                <a class="dropdown-item" href="#">Historique</a>
                <a class="dropdown-item" href="#">Mes commandes à livrer</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/vendeurController.php?a=decon">deconexion</a>
            </div>
        </nav>
    <div class="container" id="myForm">
   <div class="alert alert-primary text-center">
    <strong>Modification de la Produit : <?=$p->nom?></strong>
    </div>
    <form style="color: #757575;" action="../controllers/produitController.php?a=modiffier&bnom=<?=$bnom?>" method="post">
      <div class="form-group">
        <input type="hidden" name="id" value="<?=$p->id?>">
      </div>
      <div class="form-group">
        <input type="hidden" name="boutique_id" value="<?=$p->boutique_id?>">
      </div>
      <div class="form-group">
        <input type="text" name="prix" class="form-control text-center" placeholder="prix" value="<?=$p->prix?>">
      </div>
      <div class="form-group">
        <input type="text" name="qteEnStock" class="form-control text-center" placeholder="qteEnStock" value="<?=$p->qteEnStock?>">
      </div>
      <button class="btn btn-outline-light btn-block">Modifier</button>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>