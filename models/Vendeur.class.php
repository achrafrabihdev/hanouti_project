<?php
//include('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class Vendeur extends DataBase{
    private $id;
 private $prenom;
 private $nom;
 private $email;
 private $mdp;

 function __construct($id,$prenom,$nom,$email,$mdp)
 {
     $this->id=$id;
     $this->prenom=$prenom;
     $this->nom=$nom;
    $this->email=$email;
    $this->mdp=$mdp;
 }
 public function __get($param)
 {
     return $this->$param;
 }
 public function __set($param, $value)
 {
     $this->$param = $value;
 }
 public function signUp(){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("insert into Vendeur (prenom,nom,email,mdp) values (?,?,?,?)");
        $rp->execute([$this->prenom,$this->nom,$this->email,$this->mdp]);
    } catch (PDOException $e) {
        die("Erreur d'ajout de le vendeur" . $e->getMessage());
    }
}
public static function find($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("select * from Vendeur where id=? ");
        $rp->execute([$id]);
        $resultat =  $rp->fetch();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation (find) dans Vendeur dans  la base de donnees " . $e->getMessage());
    }
}
public static function signIn($email, $mdp)
{
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("select * from Vendeur where email = ? and mdp = ?");
        $rp->execute([$email, $mdp]);
        $resultat =  $rp->fetch();
        if (!empty($resultat)) {
            session_start();
            $_SESSION["id_vendeur"] = $resultat->id;
            $_SESSION["prenom"] = $resultat->prenom;
            $_SESSION["nom"] = $resultat->nom;
            return $resultat;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die("erreur de  conexion" . $e->getMessage());
    }
}
public static function boutiques($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("select * from Boutique where Vendeur_id = ?");
        $rp->execute([$id]);
        $resultat =  $rp->fetchAll();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation des boutiqque  dans  la base de donnees " . $e->getMessage());
    }
}
public static function commandesAL($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("SELECT b.nom as bnom,cl.prenom,cl.nom,cl.adresse,c.numeroDeCommande  FROM boutique b,commande c,client cl
        WHERE b.id=c.boutique_id AND c.client_id = cl.id AND c.etat=2 AND b.vendeur_id=? order by c.numeroDeCommande desc");
        $rp->execute([$id]);
        $resultat =  $rp->fetchAll();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation des commandes dans  la base de donnees " . $e->getMessage());
    }
}
public static function historique($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("SELECT b.nom as bnom,cl.prenom,cl.nom,cl.adresse,c.numeroDeCommande,c.etat,c.dateDeCommande  FROM boutique b,commande c,client cl
        WHERE b.id=c.boutique_id AND c.client_id = cl.id AND b.vendeur_id=? and c.etat<>1 order by c.numeroDeCommande desc");
        $rp->execute([$id]);
        $resultat =  $rp->fetchAll();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation des commandes dans  la base de donnees " . $e->getMessage());
    }
}
}