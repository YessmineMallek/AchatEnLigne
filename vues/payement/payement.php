<?php
session_start();

if (isset($_GET["lignes"])) {
    $lignes =    $_GET["lignes"];
    $arrays = json_decode($lignes, true);
    $_SESSION['lignes'] = $arrays;
}


// Function to verify form inputs
function verifyInputs($name, $email, $address, $city, $phone)
{
    $errors = array();

    // Verify name input
    if (empty($name)) {
        array_push($errors, "Name is required");
    }

    // Verify email input
    if (empty($email)) {
        array_push($errors, "Email is required");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format");
    }

    // Verify address input
    if (empty($address)) {
        array_push($errors,  "Address is required");
    }

    // Verify city input
    if (empty($city)) {
        array_push($errors,  "City is required");
    }


    if (empty($phone)) {
        array_push($errors,  "Phone is required");
    }
    return $errors;
}

if (isset($_POST["envoyer"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $errors = verifyInputs($name, $email, $address, $city, $phone);
    $lesLignes;
    if (count($errors) == 0) {
        include('../../entites/commande.php');
        include('../../entites/LigneCommande.php');
        include('../../entites/user.php');
        $id_user = "";
        $id_cmd = uniqid();

        $users = Utilisateur::FindByEmail($email);
        if (count($users) > 0) {
            foreach ($users as $u) {
                $id_user = $u->id;
            }

            $arrays = $_SESSION['lignes'];
            $arrLignes = [];
            for ($i = 0; $i < count($arrays); $i++) {

                $l = new LigneCommande($id_cmd, $arrays[$i]["id"], $arrays[$i]["qte"]);
                array_push($arrLignes, $l);
            }
            $cmd = new Commande($id_cmd, $email, $address, $city, $phone, $id_user, $arrLignes);
            $rep = Commande::addCommande($cmd);
            if ($rep > 0) {
                array_push($errors, 'Order successfully added ');
                $_POST["name"] = "";
                $_POST["email"] = "";
                $_POST["address"] = "";
                $_POST["city"] = "";
                $_POST["phone"] = "";


                $to_email = "mallek.yessmin@gmail.com";
                $subject = "Confirmation formation";
                $body = " Salut,
                votre demande pour la formation est accepté
                merci pour votre participation";
                $headers = "From: sender\'s email";

                if (mail($to_email, $subject, $body)) {
                    echo "<script>alert ('Email successfully sent to $to_email...');</script>";
                } else {
                    print_r("------------------------");

                    print_r(error_get_last());
                    echo "<script>alert ('Email sending failed...');</script>";
                }
            }
        } else {
            array_push($errors, "Email address not available ...! ");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/footer.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Font awsome links-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" href="../images/logo.png">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/payement.css">
    <title>Payement</title>
    <style>
        body {
            background-image: url("background.png");
        }
    </style>


</head>

<body>
    <section>
        <div class="container1">
            <!--Heder section starts -->
            <header>
                <img width="130px" src="../images/logo.png" id="logo" onmouseover="hover()" onmouseleave="small()">

                <div class="navBar">

                    <a href="../home/home.html">Home</a>
                    <a href="../home/home.html">About</a>
                    <a href="../home/home.html">Contact Us</a>


                </div>
                <div class="navBar2">
                    <a id="panier" href="../panier/panier.html"><img class="cart" src="../images/cart.png"></a>


                    <a class="fa fa-sign-out" style="font-size:24px" onclick="LogOut()"></a>

                </div>
            </header>
            <!--Heder section ends -->
        </div>
    </section>
    <div class="container">


        <form name="checkout" id="idForm" method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="row">

                <div class="col">

                    <h3 class="title">billing address</h3>
                    <?php if (isset($errors)) {
                        foreach ($errors as $msg) {
                            echo "<span class='error'> " . $msg . "</span><br>";
                        }
                    } ?>
                    <div class="inputBox">
                        <span>full name :</span>
                        <input type="text" name="name" value=<?php if (!empty($_POST["name"])) echo $_POST["name"] ?>>
                    </div>
                    <div class="inputBox">
                        <span>email :</span>
                        <input type="email" name="email" value=<?php if (!empty($_POST["email"])) echo $_POST["email"] ?>>
                    </div>
                    <div class="inputBox">
                        <span>address :</span>
                        <input type="text" name="address" value=<?php if (!empty($_POST["address"])) echo $_POST["address"] ?>>
                    </div>

                    <div class="inputBox">
                        <span>city :</span>
                        <input type="text" name="city" value=<?php if (!empty($_POST["city"])) echo $_POST["city"] ?>>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>phone number</span>
                            <input type="text" name="phone" value=<?php if (!empty($_POST["phone"])) echo $_POST["phone"] ?>>
                        </div>

                    </div>

                </div>



            </div>

            <input name="envoyer" type="submit" value="proceed to checkout" class="submit-btn">

        </form>

    </div>
    <!--Footer starts-->
    <footer id="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>

        <ul class="social-icons">
            <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-envelope"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>

        </ul>
        <ul class="menu">
            <li>
                <a href="#">Home</a>
                <a href="#about">About Us</a>
                <a href="#ContactUsSection">Contact Us</a>
                <a href="#Reviews">Product Review</a>
            </li>
        </ul>

        <p>
            <i class="fa-regular fa-copyright"></i>2023 Jeasmine | All Rights Reserved
        </p>
    </footer>
    <!--Footer ends-->

</body>

</html>
<script>
    function LogOut() {
        localStorage.clear();
        window.location.href = "../authentification/auth.php"
    }
    var img = document.getElementById("logo");

    function hover() {
        img.width = "200";
        img.height = "200"

    }

    function small() {
        img.width = "130";
        img.height = "130"

    }
</script>