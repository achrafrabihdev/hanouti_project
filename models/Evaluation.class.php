<?php
//include('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class Evaluation extends DataBase{
    private $boutique_id;
    private $client_id;
    private $evl;
    function __construct($boutique_id,$client_id,$evl)
    {
        $this->boutique_id=$boutique_id;
        $this->client_id=$client_id;
        $this->evl=$evl;
    }
    public function __get($param)
    {
        return $this->$param;
    }
    public function __set($param, $value)
    {
        $this->$param = $value;
    }
    public function evaluer(){
        try {
            self::connect_db();
            $rp = self::$cnx->prepare("insert into Evaluation(boutique_id,client_id,evl) values (?,?,?)");
            $rp->execute([$this->boutique_id,$this->client_id,$this->evl]);
        } catch (PDOException $e) {
            die("Erreur d'evaluer le boutique" . $e->getMessage());
        }
    }
    public static function evlBoutique($id){
        self::connect_db();
        $rp = self::$cnx->prepare("select avg(evl) as avgEvl from Evaluation where boutique_id=?");
        $rp->execute([$id]);
        $resultat =  $rp->fetch();
        return $resultat;
        
    }
    public static function evlDeClient($bid,$cid){
        self::connect_db();
        $rp = self::$cnx->prepare("select evl from Evaluation where boutique_id=? and client_id=?");
        $rp->execute([$bid,$cid]);
        $resultat =  $rp->fetch();
        return $resultat;
    }
    
}