<?php

class Produit
{
    private $ref;
    private $nom;
    private $description;
    private $prix;
    private $sexe;
    function __construct($ref, $nom, $description, $prix, $sexe)
    {

        $this->ref = $ref;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->sexe = $sexe;
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
}
