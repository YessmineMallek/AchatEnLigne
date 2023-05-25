<?php
//include_once ('connexion/connection.php');
include("../../conn/connection.php");

$id = uniqid();
$name = $_POST["firstname"];
$email = $_POST["lastname"];
$commentaire = $_POST["subject"];
$dt = time();
// extract($_POST);
if (!empty($name) && !empty($email) && !empty($commentaire)) {
    $req = $conn->exec("insert into commentaire values('$id' , '$name ' , '$email' , '$commentaire' ,'$dt')") or
        die(print_r($conn->errorInfo()));
    echo "merci pour votre commentaires";
    header('Location: ../home/home.html');
    // $req=$con->prepare('INSERT INTO commentaire(IDcomm,name,email,message,date) VALUES (?,?,?,?,NOW())');
    //$req->execute(array($name,$email,$commentaire));

}
