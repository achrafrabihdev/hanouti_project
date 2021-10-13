<?php
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
extract($_GET);
if($type==='vendeur'){
    $client=Commande::nomClient($num);
    $vendeur=Vendeur::find($_SESSION['id_vendeur']);
}else{
    $vendeur=Commande::nomVendeur($num);
    $client=Client::find($_SESSION['id_client']);
}
$list = Commande::paniner($num);
$com = Commande::find($num);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>Hanouti- facture</title>
    <style>
         @media print {
            body{
            size: A4;
            }
            button{
            display:none !important;
            }

      }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-primary" style="font-size: 50px;width: 900;">Facture</h1>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Vendeur:</span><span class="ml-1"><?php echo $vendeur->prenom.' '.$vendeur->nom?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Boutique:</span><span class="ml-1"><?=$bnom?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Client:</span><span class="ml-1"><?php echo $client->prenom.' '.$client->nom?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1"><?=$com->dateDeCommande?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Numero de commande:</span><span class="ml-1">#<?=$num?></span></div>
                    </div>
                    <div class="col-md-6 text-right mt-3">
                        <img src="../logo.png" alt="hanouti logo" width="300px">
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table">
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
                                        $ttc+=$l->prix*$l->qte;
                                    }?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>TTC</b></td>
                                        <td><b><?=$ttc?>DH</b></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right mb-3"><button class="btn btn-primary mr-5" onclick="window.print()">Imprimer</button></div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>