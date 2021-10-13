<?php
//include('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class Commande extends DataBase{
    private $numeroDeCommande;
    private $client_id;
    private $boutique_id;
    private $dateDeCommande;
    private $etat;
    function __construct($numeroDeCommande,$client_id,$boutique_id,$dateDeCommande,$etat)
    {
        $this->numeroDeCommande=$numeroDeCommande;
        $this->client_id=$client_id;
        $this->boutique_id=$boutique_id;
        $this->dateDeCommande=$dateDeCommande;
        $this->etat=$etat;
    }
    public function __get($param)
    {
        return $this->$param;
    }
    public function __set($param, $value)
    {
        $this->$param = $value;
    }
    public function nouveau(){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("insert into Commande(client_id,boutique_id,dateDeCommande,etat) values (?,?,CURDATE(),?)");
            $rp->execute([$this->client_id,$this->boutique_id,$this->etat]);
        } catch (PDOException $e) {
            die("Erreur d'ajout de la commande" . $e->getMessage());
        }
    }
    public static function ajouterProduit($commande_num,$produit_id,$qte){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("insert into CommandeProduit(commande_num,produit_id,qte) values (?,?,?)");
            $rp->execute([$commande_num,$produit_id,$qte]);
        } catch (PDOException $e) {
            die("Erreur d'ajout de le produit a la commande" . $e->getMessage());
        }
    }
    public static function derniereCommande(){
        self::connect_db();
        $rp = self::$cnx->prepare("select * from commande where numeroDeCommande =(select MAX(numeroDeCommande) from commande)");
        $rp->execute([]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
    public static function find($num){
        self::connect_db();
        $rp = self::$cnx->prepare("select * from commande where numeroDeCommande =?");
        $rp->execute([$num]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
    public static function nombreDeProduit($num){
        self::connect_db();
        $rp = self::$cnx->prepare("select count(commande_num) as nbr from commandeProduit where commande_num = ?");
        $rp->execute([$num]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
    public static function paniner($num){
        self::connect_db();
        $rp = self::$cnx->prepare("select * FROM CommandeProduit cp,produit p where cp.produit_id=p.id and cp.commande_num=?");
        $rp->execute([$num]);
        $resultat =  $rp->fetchAll();
        return $resultat;
    }
    public static function suppProduit($num,$produit){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("delete from commandeProduit where commande_num = ? and produit_id = ?");
            $rp->execute([$num,$produit]);
        } catch (PDOException $e) {
            die("Erreur de suppression de le produit dans le manier" . $e->getMessage());
        }
    }
    public static function changerQte($num,$produit,$qte){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("update commandeProduit set qte = ? where commande_num = ? and produit_id = ?");
            $rp->execute([$qte,$num,$produit]);
        } catch (PDOException $e) {
            die("Erreur de modification de le quantite dans le manier" . $e->getMessage());
        }
    }
    public static function confirmer($num){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("update Commande set etat = 2 where numeroDeCommande = ?");
            $rp->execute([$num]);
        } catch (PDOException $e) {
            die("Erreur de confirmation du commande" . $e->getMessage());
        }
    }
    public static function confirmerRec($num){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("update Commande set etat = 3 where numeroDeCommande = ?");
            $rp->execute([$num]);
        } catch (PDOException $e) {
            die("Erreur de confirmation du commande" . $e->getMessage());
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
    public static function modifierQuantite($id,$qte){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("update produit set qteEnStock = qteEnStock-? where id=?");
            $rp->execute([$qte,$id]);
        } catch (PDOException $e) {
            die("erreur de modifier qte en stock " . $e->getMessage());
        }
    }
    public static function findProduit($num,$id){
        self::connect_db();
        $rp = self::$cnx->prepare("select * from commandeProduit where commande_num =? and produit_id=?");
        $rp->execute([$num,$id]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
    public static function nomClient($num){
        self::connect_db();
        $rp = self::$cnx->prepare("select c.nom ,c.prenom FROM Commande cm,Client c where c.id=cm.client_id and cm.numeroDeCommande=?");
        $rp->execute([$num]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
    public static function nomVendeur($num){
        self::connect_db();
        $rp = self::$cnx->prepare("select v.nom ,v.prenom FROM Commande cm,Boutique b,Vendeur v where cm.boutique_id=b.id and b.vendeur_id=v.id and cm.numeroDeCommande=?");
        $rp->execute([$num]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
}