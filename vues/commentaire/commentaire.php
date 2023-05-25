<?php
//include_once ('connexion/connection.php');
   $id=uniqid();
   $name = $_POST["firstname"];
   $email = $_POST["lastname"];
   $commentaire = $_POST["subject"];
   $dt = time();
    // extract($_POST);
    if (!empty($name ) and !empty($email) and !empty($commentaire)){
        include_once ('C:/xampp/htdocs/AchatEnLigne/connexion/connection.php');
        $req = $conn->exec("insert into commentaire values('$id' , '$name ' , '$email' , '$commentaire' ,'$dt')") or
         die(print_r($conn->errorInfo()));
         echo"merci pour votre commentaires"
        // $req=$con->prepare('INSERT INTO commentaire(IDcomm,name,email,message,date) VALUES (?,?,?,?,NOW())');
         //$req->execute(array($name,$email,$commentaire));
    
    }