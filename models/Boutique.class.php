<?php
//include('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class Boutique extends DataBase{
    private $id;
    private $vendeur_id;
    private $nom;
    private $ville;
    private $quartier;
    function __construct($id,$vendeur_id,$nom,$ville,$quartier)
    {
        $this->id=$id;
        $this->vendeur_id=$vendeur_id;
        $this->nom=$nom;
        $this->ville=$ville;
        $this->quartier=$quartier;
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
            $rp = self::$cnx->prepare("insert into Boutique(vendeur_id,nom,ville,quartier) values (?,?,?,?)");
            $rp->execute([$this->vendeur_id,$this->nom,$this->ville,$this->quartier]);
        } catch (PDOException $e) {
            die("Erreur d'ajout de la boutique" . $e->getMessage());
        }
    }
    public static function supprimer($id){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("delete from Boutique where id=?");
            $rp->execute([$id]);
        } catch (PDOException $e) {
            die("erreur de suppression  de la boutique dans  la base de donnees " . $e->getMessage());
        }
    }
    public static function Modifier($id,$nom,$ville,$quartier){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("update Boutique set nom=?,ville=?,quartier=? where id =?");
            $rp->execute([$nom,$ville,$quartier,$id]);
        } catch (PDOException $e) {
            die("erreur de suppression  de la boutique dans  la base de donnees " . $e->getMessage());
        }
    }
    public static function find($id){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("select * from Boutique where id=? ");
            $rp->execute([$id]);
            $resultat =  $rp->fetch();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation (find) dans Boutique dans  la base de donnees " . $e->getMessage());
        }
    }
    public static function produits($id){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("select * from Produit where boutique_id = ?");
            $rp->execute([$id]);
            $resultat =  $rp->fetchAll();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation des produits  dans  la base de donnees " . $e->getMessage());
        }
    }
    public static function nombreDeProduit($num){
        self::connect_db();
        $rp = self::$cnx->prepare("select count(commande_num) as nbr from commandeProduit where commande_num = ?");
        $rp->execute([$num]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
}
