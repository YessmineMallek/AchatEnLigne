<?php
class Commande
{
    private $idCmd;
    private $email;
    private $adresse;
    private $ville;
    private $telephone;
    private $lignesCmd;


    function __construct($id, $email, $adresse, $ville, $telephone, $lignesCmd)
    {

        $this->idCmd = $id;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->telephone = $telephone;
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
            $rep =  $conn->exec("insert into commande(idcmd, email,adresse,ville,telephone)values('$cmd->id_cmd',$cmd->Email,'$cmd->adresse','$cmd->ville',$cmd->telephone) ") or die(print_r($conn->errorInfo()));

            if ($rep > 0)
                foreach ($cmd->lignesCmd as $ligne) {
                    LigneCommande::addLigneCommande($ligne);
                }
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
