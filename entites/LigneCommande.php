<?php
class LigneCommande
{
    private $idCmd;
    private $refProd;
    private $qte;
    function __construct($idCmd, $refProd, $qte)
    {

        $this->idCmd = $idCmd;
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
            include("connection.php");
            $rep =  $conn->exec("insert into lignecommande(idCmd ,refProd ,qte)values('$ligCmd->idCmd','$ligCmd->refProd',$ligCmd->qte) ") or die(print_r($conn->errorInfo()));
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
