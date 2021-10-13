<?php
include('../models/Vendeur.class.php');
extract($_GET);
extract($_POST);
if($a==='signup'){
    $v = new Vendeur(0,$prenom,$nom,$email,$mdp);
    $v->signUp();
    header('location:../views/index.php?x=done');
}else if($a==='signin'){
    $v=Vendeur::signIn($email,$mdp);
    if($v!=0){
        header('location:../views/vendeurPage.php');
    }else{
        header('location:../views/signin.php?c=no');
    }
}else if($a==='decon'){
    session_start();
    session_unset();
    session_destroy();
    header('location:../views/index.php');
}