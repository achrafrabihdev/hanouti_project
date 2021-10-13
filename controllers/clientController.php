<?php
//include('../models/Client.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
extract($_GET);
extract($_POST);
if($a==='signup'){
    $c = new Client(0,$prenom,$nom,$email,$mdp,$ville,$quartier,$adresse);
    $c->signUp();
    header('location:../views/index.php?x=done');
}else if($a==='signin'){
    $c=Client::signIn($email,$mdp);
    if($c!=0){
        header('location:../views/ClientPage.php');
    }else{
        header('location:../views/signin.php?c=no');
    }
}else if($a==='decon'){
    session_start();
    if(isset($_SESSION['commande'])){
        $c=Commande::find($_SESSION['commande']);
        if($c->etat==1){
        Client::annulerCommande($_SESSION['commande']);
        }
    }
    session_unset();
    session_destroy();
    header('location:../views/index.php');
}