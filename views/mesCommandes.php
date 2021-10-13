<?php
//include ('../models/Client.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
$commandes = Client::commandes($_SESSION['id_client']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>hanouti - Mes commandes</title>
</head>
<body class="bg-primary">
        <nav class="navbar navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" width="150" height="50" class="d-inline-block align-top" alt="hanouti-logo" loading="lazy">
            </a>
            <div class="badge badge-primary" style="font-size: 25px;">Mes commandes</div>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="clientPage.php">Boutique de quartier</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controllers/clientController.php?a=decon">deconexion</a>
            </div>
        </nav>
        <div class="container" style="margin-top: 18vh;">
            <table class="table table-hover table-light">
                    <thead>
                        <tr>
                        <th scope="col">Numero de commande</th>
                        <th scope="col">Boutique</th>
                        <th scope="col">Date de commande</th>
                        <th scope="col">TTC</th>
                        <th scope="col">Etat</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($commandes as $c){ ?>
                        <tr>
                            <td><?=$c->numeroDeCommande?></td>
                            <td><?=$c->nom?></td>
                            <td><?=$c->dateDeCommande?></td>
                            <td><?=$c->ttc?> DH</td>
                            <td><?php echo ($c->etat==1)?'En attente' : (($c->etat==2)? 'En cours de traitement' :'Terminé' )?></td>
                            <td> 
                                <a href="facture.php?num=<?=$c->numeroDeCommande?>&bnom=<?=$c->nom?>&type=client" target="_blank" class="btn btn-primary">facture</a>
                                <a href="../controllers/commandeController.php?a=<?php echo ($c->etat==1)?'anuller':'confirmerRec' ?>&numC=<?=$c->numeroDeCommande?>" class="btn btn-primary <?php echo ($c->etat==3)?'disabled' : '' ?>"><?php echo ($c->etat==1)?'Annuler la commande' : 'confirmer la réception' ?></a>
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