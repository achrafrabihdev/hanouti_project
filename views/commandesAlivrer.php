<?php
//include ('../models/Client.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
$commandes = Vendeur::commandesAL($_SESSION['id_vendeur']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>hanouti - commandes à livrer</title>
</head>
<body class="bg-primary">
        <nav class="navbar navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" width="150" height="50" class="d-inline-block align-top" alt="hanouti-logo" loading="lazy">
            </a>
            <div class="badge badge-primary" style="font-size: 25px;">Les commandes à livuer</div>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="vendeurPage.php">Mes boutique</a>
                <a class="dropdown-item" href="historique.php">Hisotique</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/vendeurController.php?a=decon">deconexion</a>
            </div>
        </nav>
        <div class="container" style="margin-top: 18vh;">
            <table class="table table-hover table-light">
                    <thead>
                        <tr>
                        <th scope="col">Prenmm</th>
                        <th scope="col">Nom</th>
                        <th scope="col">adresse</th>
                        <th scope="col">Boutique</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($commandes as $c){ ?>
                        <tr>
                            <td><?=$c->prenom?></td>
                            <td><?=$c->nom?></td>
                            <td><?=$c->adresse?></td>
                            <td><?=$c->bnom?></td>
                            <td>
                                <a data-toggle="modal" href="#myModal<?=$c->numeroDeCommande?>" class="btn btn-primary">details</a>
                                <div class="modal fade" id="myModal<?=$c->numeroDeCommande?>" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                                <?php
                                    $list = Commande::paniner($c->numeroDeCommande);
                                ?>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" >details du commande N° <?=$c->numeroDeCommande?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <table class="table table-hover table-light">
                                    <thead>
                                        <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Poduit</th>
                                        <th scope="col">Quantite</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $ttc=0;
                                        foreach($list as $l){ ?>
                                        <tr>
                                            <td><img src="../.images/<?=$l->img?>" alt="image produit" width="50" height="50"></th>
                                            <td><?=$l->nom?></td>
                                            <td><?=$l->qte?> <?php echo ($l->typeP==1)? 'Unité' : 'Kg &nbsp;&nbsp;&nbsp;' ?></td>
                                            <td><?=$l->prix?> DH</td>
                                            <td><?=$l->prix*$l->qte?> DH</td>
                                        </tr>
                                        <?php
                                        $ttc=$ttc+$l->prix+$l->qte;
                                     }?>
                                        <td><b>TTC : </b></td>
                                        <td><b><?=$ttc?>DH</b></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="facture.php?num=<?=$c->numeroDeCommande?>&type=vendeur&bnom=<?=$c->bnom?>" class="btn btn-primary btn-small">Facture</a></td>
                                    </tbody>
                                </table>
                                    </div>
                                    </div>
                                </div>
                             </div>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>