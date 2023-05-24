<?php
class Utilisateur
{
    private $login;
    private $password;
    private $email;
    function __construct($l, $pass, $email)
    {
        $this->login = $l;
        $this->password = $pass;
        $this->email = $email;
    }
    public function __get($attr)
    {
        if (!isset($this->$attr))
            return "erreur";
        else return ($this->$attr);
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
    public static function ajouter_Utilisateur($u)
    {
        try {
            include("connection.php");
            $id = uniqid();
            $rep = $conn->exec("insert into utilisateur(id_user,login,password,email) values('$id','$u->login','$u->password','$u->email');") or die(print_r($conn->errorInfo()));
            return $rep;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public static function FindByEmail($email)
    {
        include("connection.php");
        $selection = $conn->query("select * from utilisateur where email like '$email'") or die(print_r($conn->errorInfo()));
        $lesUtilisateur = [];
        foreach ($selection as $utili) {
            $u = new Utilisateur( $utili['login'], $utili['password'], $utili['email']);
            $lesUtilisateur[] = $u;
        }
        return $lesUtilisateur;
    }
}
