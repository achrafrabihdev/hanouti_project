<?php
//include ('../models/Client.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
extract($_GET);
session_start();
$paniner = Commande::paniner($_SESSION['commande']);
$ttc=0;
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
            <div class="badge badge-primary" style="font-size: 25px;">Mon panier</div>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="mesCommandes.php">Mes commandes</a>
                <a class="dropdown-item" href="acheter.php?bid=<?=$bid?>">Continuer mes achats</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/clientController.php?a=decon">deconexion</a>
            </div>
        </nav>
        <div class="container" style="margin-top: 18vh;">
            <table class="table table-hover table-light">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Poduit</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Prix</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($paniner as $p){ ?>
                        <tr>
                            <td><img src="../.images/<?=$p->img?>" alt="image produit" width="50" height="50"></th>
                            <td><?=$p->nom?></td>
                            <td><?=$p->qte?> <?php echo ($p->typeP==1)? 'Unité' : 'Kg &nbsp;&nbsp;&nbsp;' ?> <a data-toggle="modal" href="#myModal<?=$p->produit_id?>" class="btn btn-outline-primary btn-small"><i class="far fa-edit"></i></a></td>
                            <div class="modal fade" id="myModal<?=$p->produit_id?>" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" >Changer la quantité <?php echo ($p->typeP==1)? '(Unité)' : '(Kg)' ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="post" action="../controllers/commandeController.php?a=changer&pid=<?=$p->produit_id?>&bid=<?=$bid?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control text-center" name="qte" value="<?=$p->qte?>">
                                        </div>
                                        <button class="btn btn-primary btn-block">Changer</button>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                             </div>
                            <td><?=$p->prix?> DH</td>
                            <td><a href="../controllers/commandeController.php?a=suppP&pid=<?=$p->produit_id?>&bid=<?=$bid?>" class="btn btn-primary"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php 
                        $ttc+=$p->prix*$p->qte;
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>TTC :</b></td>
                            <td><b><?=$ttc?> DH</b></td>
                        </tr>
                    </tbody>
                </table>
                <a href="../controllers/commandeController.php?a=confirmer&bid=<?=$bid?>" class="btn btn-light btn-block">Confirmer la commande</a>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>