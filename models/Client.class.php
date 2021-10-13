<?php
//include ('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class Client extends DataBase{
    private $id;
    private $prenom;
    private $nom;
    private $email;
    private $mdp;
    private $ville;
    private $quartier;
    private $adresse;
    function __construct($id=0,$prenom,$nom,$email,$mdp,$ville,$quartier,$adresse)
 {
     $this->id=$id;
     $this->prenom=$prenom;
     $this->nom=$nom;
    $this->email=$email;
    $this->mdp=$mdp;
    $this->ville=$ville;
    $this->quartier=$quartier;
    $this->adresse=$adresse;
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
        $rp = self::$cnx->prepare("insert into Client (prenom,nom,email,mdp,ville,quartier,adresse) values (?,?,?,?,?,?,?)");
        $rp->execute([$this->prenom,$this->nom,$this->email,$this->mdp,$this->ville,$this->quartier,$this->adresse]);
    } catch (PDOException $e) {
        die("Erreur d'ajout de le client" . $e->getMessage());
    }
}
public static function signIn($email, $mdp)
{
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("select * from Client where email = ? and mdp = ?");
        $rp->execute([$email, $mdp]);
        $resultat =  $rp->fetch();
        if (!empty($resultat)) {
            session_start();
            $_SESSION["id_client"] = $resultat->id;
            $_SESSION["prenom"] = $resultat->prenom;
            $_SESSION["nom"] = $resultat->nom;
            $_SESSION["quartier"] = $resultat->quartier;
            return $resultat;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die("erreur de  conexion" . $e->getMessage());
    }
}
public static function boutiques($quartier){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("select * from Boutique where quartier = ?");
        $rp->execute([$quartier]);
        $resultat =  $rp->fetchAll();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation des boutiqque  dans  la base de donnees " . $e->getMessage());
    }
}
public static function find($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("select * from client where id = ?");
        $rp->execute([$id]);
        $resultat =  $rp->fetch();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation le client  dans  la base de donnees " . $e->getMessage());
    }
}
public static function commandes($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("SELECT c.numeroDeCommande,b.nom,c.dateDeCommande,SUM(p.prix*cp.qte) AS ttc,c.etat
        FROM commande c,boutique b,commandeproduit cp,produit p
        WHERE c.boutique_id=b.id AND c.numeroDeCommande=cp.commande_num AND cp.produit_id=p.id AND c.client_id=?
        GROUP BY c.numeroDeCommande order by c.numeroDeCommande desc");
        $rp->execute([$id]);
        $resultat =  $rp->fetchAll();
        return $resultat;
    } catch (PDOException $e) {
        die("erreur de  recuperation des commandes dans  la base de donnees " . $e->getMessage());
    }
}
public static function annulerCommande($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("delete from Commande where numeroDeCommande=?");
        $rp->execute([$id]);
    } catch (PDOException $e) {
        die("erreur de l'annulation de la commande dans  la base de donnees " . $e->getMessage());
    }
}
public static function supprimerPanier($id){
    try {
        self::connect_db();
        $rp = self::$cnx->prepare("delete from commandeProduit where commande_num=?");
        $rp->execute([$id]);
    } catch (PDOException $e) {
        die("erreur de suppression  de la panier dans  la base de donnees " . $e->getMessage());
    }
}

}