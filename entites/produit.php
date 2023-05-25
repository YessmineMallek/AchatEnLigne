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

    public static function findAll()
    {
        include("connection.php");

        $resultat = $conn->query("select * from produit");
        $rows = $resultat->fetchAll();
        $listeProduits = [];
        foreach ($rows as $prd) {
            $m = new Produit($prd['ref'], $prd['nom'], $prd['descrip'], $prd['prix'], $prd['sexe'], $prd['qte']);
            $listeProduits[] = $m;
        }
        return $listeProduits;
    }
    public static function findByRef($ref)
    {
        include("connection.php");
        $resultat = $conn->query("select * from produit where ref like '$ref'");
        $rows = $resultat->fetchAll();
        $listeProduits = [];
        foreach ($rows as $prd) {
            return  new Produit($prd['ref'], $prd['nom'], $prd['descrip'], $prd['prix'], $prd['sexe'], $prd['qte']);
        }
    }

    /****************FindByGender************* */
    public static function findByGender($gender)
    {
        include("connection.php");
        $resultat = $conn->query("select * from produit where sexe=$gender");
        $rows = $resultat->fetchAll();
        $listeProduits = [];
        foreach ($rows as $prd) {
            $m = new Produit($prd['ref'], $prd['nom'], $prd['descrip'], $prd['prix'], $prd['sexe'], $prd['qte']);
            $listeProduits[] = $m;
        }
        return $listeProduits;
    }

    public function _getImages()
    {
        include("connection.php");

        $req2 = "select * from images_produit where ref_prod = '" . $this->ref . "' ;";
        $resultat2 = $conn->query($req2);
        $resultat2->setFetchMode(PDO::FETCH_BOTH);
        $rows2 = $resultat2->fetchAll();
        return $rows2;
    }
    public function __toString()
    {

        $images = $this->_getImages();

        return "<div class=\"pro\" id='$this->ref' onclick='navigate(this.id)'> <img src='../../uploaded_Images/" . $images[0]['imageName'] . "'> 
        <div class=\"des\"><span>Jessamine</span>
            <h4>" . $this->nom . "</h4>
            <h5>" . $this->description . "</h5>

            <h5>" . $this->prix . "DT</h5>  

        </div>
        <i class=\"fas fa-shopping-cart	\"></i>    </div>";
    }
    public function afficherProd()
    {
        $images = $this->_getImages();
        return "<tr value=" . $this->ref . "> <td><img height = \"100\" src=\"../../uploaded_Images/" .  $images[0]['imageName'] . "\"></td><td>" . $this->nom . "</td> <td> " . $this->prix . "DT</td><td>" . $this->qte . "</td><td>" . $this->sexe . "</td><td><a href='edit-product.php?edit=" . $this->ref . "' class='btn'><i class=\"fas fa-edit\"> </i></a><a class='btn' href='addProductForm.php?delete=" . $this->ref . "'><i class='fas fa-trash'> </i></a></td></tr>";
    }
    public function afficherDetails()
    {
        $images = $this->_getImages();
        $ch = "";
        $ch .=  "
        <div class=\"single-pro-image\">
        <img alt='image' width='100%' id='MainImag'  src='../../uploaded_Images/" .  $images[0]['imageName'] . "'>";

        $ch .= "<div class='small-img-groupe'>";
        for ($i = 0; $i < count($images); $i++) {
            $ch .= "<div class='small-img-col'>
                <img width='100%'  onclick='changeImage($i)' class='small-img' alt='NOT AVAILABLE YET' id='small-img1' src='../../uploaded_Images/" .  $images[$i]['imageName'] . "'></div>";
        }
        $ch .= "</div></div>
    <div class='single-pro-details'>
    <h6>Kids / <span id='nameProduct'>$this->nom</span></h6>
        <h4>Kids' T Shirt</h4>
        <h3><span id='priceProduct'>$this->prix </span>dt</h3>
        <select>
            <option value='0'>select size </option>
            <option value='1'>XXXL </option>
            <option value='2'>XXL </option>
            <option value='3'>XL </option>
            <option value='4'>L </option>
            <option value='5'>M </option>
            <option value='6'>S </option>
            <option value='7'>XS </option>

        </select>
        <input type='number' value='1' id='qte'>
        <button class='bttn' onclick=addPanier()>add </button>
        <h4>details</h4>
        <span id='description'>$this->description</span>";
        return $ch;
    }
}
