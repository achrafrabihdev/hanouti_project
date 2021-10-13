<?php
//include('DataBase.class.php');
spl_autoload_register(function ($class) {
    include('../models/' . $class . '.class.php');
});
class Produit extends DataBase{
    private $id;
    private $boutique_id;
    private $nom;
    private $typeP;
    private $img;
    private $prix;
    private $qteEnStock;
    function __construct($id,$boutique_id,$nom,$typeP,$img,$prix,$qteEnStock)
    {
        $this->id=$id;
        $this->boutique_id=$boutique_id;
        $this->nom=$nom;
        $this->typeP=$typeP;
        $this->img=$img;
        $this->prix=$prix;
        $this->qteEnStock=$qteEnStock;
    }
    public function __get($param)
    {
        return $this->$param;
    }
    public function __set($param, $value)
    {
        $this->$param = $value;
    }
    public static function uploader($info){
            $tmp=$info["tmp_name"];
            $nom=$info["name"];
            $path=pathinfo($nom);
            $ext=strtolower($path["extension"]);
            $newname=md5(date("YmdHis")."_".rand(1,9999)).".".$ext;
            $chemain="../images/".$newname;
            $autorise=['jpg','png','jpeg','gif'];
            if(!in_array($ext,$autorise)){
                die("ce  n'est pas un image");
            }
            if(filesize($tmp)>1024*1024*8){
                die("taille de fichier est > 8Mo");
            }
            if(!move_uploaded_file($tmp,$chemain)){
                die("error d'uplode");
            }
            return $chemain;
        }
        public function nouveau(){
            try {
                self::connect_db();
                $rp = self::$cnx->prepare("insert into Produit(boutique_id,nom,typeP,img,prix,qteEnStock) values (?,?,?,?,?,?)");
                $rp->execute([$this->boutique_id,$this->nom,$this->typeP,$this->img,$this->prix,$this->qteEnStock]);
            } catch (PDOException $e) {
                die("Erreur d'ajout de la produit" . $e->getMessage());
            }
        }
        public static function supprimer($id){
            try {
                self::connect_db();
                $rp = self::$cnx->prepare("delete from Produit where id=?");
                $rp->execute([$id]);
            } catch (PDOException $e) {
                die("erreur de suppression  de produit dans  la base de donnees " . $e->getMessage());
            }
        }
        public static function find($id){
            try {
                self::connect_db();
                $rp = self::$cnx->prepare("select * from Produit where id=? ");
                $rp->execute([$id]);
                $resultat =  $rp->fetch();
                return $resultat;
            } catch (PDOException $e) {
                die("erreur de  recuperation (find) dans Produit dans  la base de donnees " . $e->getMessage());
            }
        }
        public static function Modifier($id,$prix,$qteEnStock){
            try {
                self::connect_db();
                $rp = self::$cnx->prepare("update Produit set prix=?,qteEnStock=? where id =?");
                $rp->execute([$prix,$qteEnStock,$id]);
            } catch (PDOException $e) {
                die("erreur de modification  de la produit dans  la base de donnees " . $e->getMessage());
            }
        }
}