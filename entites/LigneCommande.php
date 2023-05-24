<?php
class LigneCommande
{
    private $idCmd;
    private $idUser;
    private $refProd;
    private $qte;
    function __construct($idCmd, $idUser, $refProd, $qte)
    {

        $this->idCmd = $idCmd;
        $this->idUser = $idUser;
        $this->refProd = $refProd;
        $this->qte = $qte;
    }
    public function __get($attr)
    {
        if (!isset($this->$attr)) return "erreur";
        else return ($this->$attr);
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
    public static function addLigneCommande($ligCmd)
    {
        try {
            include("/connection.php");
            $rep =  $conn->exec("insert into lignecommande(id_cmd,id_user,ref_prod,qte)values('$ligCmd->id_cmd',$ligCmd->idUser,'$ligCmd->ref_prod',$ligCmd->qte) ") or die(print_r($conn->errorInfo()));
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
