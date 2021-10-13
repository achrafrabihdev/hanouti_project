<?php
include('../models/Produit.class.php');
extract($_GET);
extract($_POST);
if($a==='nouveau'){
    $ch=Produit::uploader($_FILES['img']);
    $p=new Produit(0,$boutique_id,$nom,$typeP,$ch,$prix,$qteEnStock);
    $p->nouveau();
    header('location:../views/produitsPage.php?bid='.$boutique_id.'&bnom='.$bnom);
}else if($a==='supp'){
    $p=Produit::find($id);
    Produit::supprimer($id);
    unlink($p->img);
    header('location:../views/produitsPage.php?bid='.$p->boutique_id.'&bnom='.$bnom);
}else if($a==='modiffier'){
    Produit::Modifier($id,$prix,$qteEnStock);
    header('location:../views/produitsPage.php?bid='.$boutique_id.'&bnom='.$bnom);
}