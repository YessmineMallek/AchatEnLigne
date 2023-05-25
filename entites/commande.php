<?php
class Commande
{
    private $idCmd;
    private $email;
    private $adresse;
    private $ville;
    private $telephone;
    private $lignesCmd;
    private $id_user;


    function __construct($id, $email, $adresse, $ville, $telephone, $id_user, $lignesCmd)
    {

        $this->idCmd = $id;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->telephone = $telephone;
        $this->id_user = $id_user;
        $this->lignesCmd = $lignesCmd;
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
    public static function addCommande($cmd)
    {
        try {
            include("connection.php");
            $rep =  $conn->exec("insert into commande(idcmd, email,adresse,ville,telephone,id_user)values('$cmd->idCmd','$cmd->email','$cmd->adresse','$cmd->ville',$cmd->telephone,'$cmd->id_user') ") or die(print_r($conn->errorInfo()));
            if ($rep > 0)
                foreach ($cmd->lignesCmd as $ligne) {
                    LigneCommande::addLigneCommande($ligne);
                }
            return $rep;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
