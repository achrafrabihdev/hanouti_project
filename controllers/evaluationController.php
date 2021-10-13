<?php 
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
session_start();
extract($_GET);
extract($_POST);
$e = new Evaluation($bid,$_SESSION['id_client'],$evl);
$e->evaluer();
header('location:../views/'.$user.'Page.php');