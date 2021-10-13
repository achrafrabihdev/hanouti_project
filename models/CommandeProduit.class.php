<?php
//include ('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class CommandeProduit extends DataBase{
    private $commande_num;
    private $produit_id;
    private $qte;
    function __construct($commande_num,$produit_id,$qte)
    {
        $this->commande_num=$commande_num;
        $this->produit_id=$produit_id;
        $this->qte=$qte;
    }
    public function __get($param)
    {
        return $this->$param;
    }
    public function __set($param, $value)
    {
        $this->$param = $value;
    }
    public function Ajouter(){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("insert into CommandeProduit(commande_num,produit_id,qte) values (?,?,?)");
            $rp->execute([$this->commande_num,$this->produit_id,$this->qte]);
        } catch (PDOException $e) {
            die("Erreur d'ajout de le produit a la commande" . $e->getMessage());
        }
    }
}