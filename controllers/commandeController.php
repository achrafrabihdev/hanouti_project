<?php
include('../models/Commande.class.php');
session_start();
extract($_GET);
extract($_POST);
if($a==='ajouter'){
    if(isset($_SESSION['commande'])){
         $cheak=   Commande::findProduit($_SESSION['commande'],$pid);
        if(!empty($cheak)){
                $msg='Ce produit est déja au panier';
        }else{
                Commande::ajouterProduit($_SESSION['commande'],$pid,1);
                $msg='Le produit est ajouté au panier avec succès';
        }
        header('location:../views/acheter.php?bid='.$bid.'&msg='.$msg);
    }else{
        $c = new Commande(0,$_SESSION['id_client'],$bid,'0000-00-00',1);
        $c->nouveau();
       $dc=Commande::derniereCommande();
        $_SESSION['commande']=$dc->numeroDeCommande;
        Commande::ajouterProduit($_SESSION['commande'],$pid,1);
        $msg='Le produit est ajouté au panier avec succès';
        header('location:../views/acheter.php?bid='.$bid.'&msg='.$msg);
    }
}else if($a==='suppP'){
        Commande::suppProduit($_SESSION['commande'],$pid);
        header('location:../views/panier.php?bid='.$bid);
}else if($a==='changer'){
        Commande::changerQte($_SESSION['commande'],$pid,$qte);
        header('location:../views/panier.php?bid='.$bid);
}else if($a==='confirmer'){
        Commande::confirmer($_SESSION['commande']);
        unset($_SESSION['commande']);
        header('location:../views/mesCommandes.php');
}else if($a==='anuller'){
        Commande::annulerCommande($numC);
        header('location:../views/mesCommandes.php');
}else if($a==='confirmerRec'){
        Commande::confirmerRec($numC);
        header('location:../views/mesCommandes.php'); 
}