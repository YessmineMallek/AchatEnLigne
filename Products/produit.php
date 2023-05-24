<?php

class Produit
{
    private $ref;
    private $nom;
    private $description;
    private $prix;
    private $sexe;
    private $qte;
    function __construct($ref, $nom, $description, $prix, $sexe, $qte)
    {

        $this->ref = $ref;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->sexe = $sexe;
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
    public static function findAllByGender($gender)
    {
        include("../connexion/connection.php");
        $resultat = $conn->query("select * from produit where sexe='$gender'");
        $rows = $resultat->fetchAll();
        $listeProduits = [];
        foreach ($rows as $prd) {
            $m = new Produit($prd['ref'], $prd['nom'], $prd['descrip'], $prd['prix'], $prd['sexe'], $prd['qte']);
            $listeProduits[] = $m;
        }
        return $listeProduits;
    }
}
