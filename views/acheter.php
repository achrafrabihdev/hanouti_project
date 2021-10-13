<?php
//include ('../models/Boutique.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
extract($_GET);
if(isset($_SESSION['commande'])){
    $nbrProduit= Commande::nombreDeProduit($_SESSION['commande']);
}
$boutique= Boutique::find($bid);
$produits = Boutique::produits($bid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>hanouti - Acheter page</title>
</head>
<body class="bg-primary">
        <nav class="navbar navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" width="150" height="50" class="d-inline-block align-top" alt="hanouti-logo" loading="lazy">
            </a>
            <div class="badge badge-primary" style="font-size: 25px;"><?=$boutique->nom?></div>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="panier.php?bid=<?=$bid?>">Mon Panier
                      <div class="badge badge-pill badge-primary"> 
                           <?php echo isset($_SESSION['commande'])? $nbrProduit->nbr : '0'?>
                      </div>
                </a>
                <a class="dropdown-item" href="clientPage.php">Les boutiques de quartier</a>
                <a class="dropdown-item" href="mesCommandes.php">Mes commandes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/clientController.php?a=decon">deconexion</a>
            </div>
        </nav>
        <div class="container" style="margin-top: 18vh;">
            <div class="row">
                <?php foreach($produits as $p){?>
                <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center">
                    <div class="badge badge-pill badge-primary" style="font-size: large;"> 
                          <?=$p->prix?> dh
                      </div>
                      <div class="badge badge-pill badge-primary" style="font-size: large;"> 
                          <?php echo $p->qteEnStock.' '.($p->typeP==1 ? 'Unité':'Kg' );?> 
                      </div>
                    </div>
                    <img src="../images/<?=$p->img?>" class="card-img-top" alt="..." height="253px">
                    <div class="card-body text-center">
                      <h5 class="card-title"><?=$p->nom?><?php echo (strlen($p->nom)<23 ? '<br><br>' : '');?></h5>
                      <a href="../controllers/commandeController.php?pid=<?=$p->id?>&a=ajouter&bid=<?=$bid?>" class="btn btn-primary">Ajouter au panier</a>
                    </div>
                  </div>
                  <br>
                </div>
                <?php }?>
            </div>
            <div class="modal fade" id="myMsg" tabindex="-1" role="dialog" aria-labelledby="myMsg" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="#myMsg">Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <?=$msg?>
                    </div>
                    </div>
                </div>
                </div>   
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
<?php if(isset($msg) && !empty($msg)){ ?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myMsg').modal('show');
    });
</script>
<?php }?>
</html>