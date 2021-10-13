<?php
include('../models/boutique.class.php');
extract($_GET);
extract($_POST);
if($a==='nouveau'){
    $b = new Boutique(0,$vendeur_id,$nom,$ville,$quartier);
    $b->nouveau();
    header('location:../views/vendeurPage.php');
}else if($a==='supp'){
    Boutique::supprimer($bid);
    header('location:../views/vendeurPage.php');
}else if($a==='modifier'){
    Boutique::Modifier($id,$nom,$ville,$quartier);
    header('location:../views/vendeurPage.php');
}