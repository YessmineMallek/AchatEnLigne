<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="kid.css">
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="../css/footer.css">


    <title>kid Collection</title>
    <!--Font awsome links-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>

<body>
    <section>
        <div class="container">
            <!--Heder section starts -->
            <header>
                <img width="130px" src="../images/logo.png" id="logo" onmouseover="hover()" onmouseleave="small()">

                <div class="navBar">


                    <a href="../home/home.html">Home</a>
                    <a href="../home/home.html">About</a>
                    <a href="../home/home.html">Contact Us</a>


                </div>
                <div class="navBar2">
                    <a id="panier" href="../panier/panier.html"><img class="cart" src="cart.png"></a>

                    <span id="logInBtn"><a class="fa fa-sign-in" style="font-size:24px" href="../sign up.html"></a></span>
                    <a class="fa fa-sign-out" style="font-size:24px" onclick="LogOut()"></a>

                </div>
            </header>
            <!--Heder section ends -->
        </div>
    </section>
    <section class="women fashion">
        <div class="page-header">
            <h3>Summer Collection</h3>

            <p> "Adorable clothes for your little ones, because childhood is too precious to not be stylish 🥰 "</p>

        </div>
    </section>
    <div>
        <!-- <select onchange="val()" id="filter">
            <option>---</option>
            <option value="croissant">Lower to higher prices</option>
            <option value="Decroissant">Higher to Lower prices</option>

        </select>-->
        <section id="product">

            <div class="pro-container" id="pro-container">

                <?php
                include("../../entites/produit.php");
                $gender = $_GET['gender'];
                $rows = Produit::findByGender($gender);
                foreach ($rows as $p) {
                    echo $p;
                }
                ?>

            </div>
        </section>
    </div>
    <!--Service section starts-->
    <section class="service">

        <div class="box-container">

            <div class="box">
                <div class="rotate"> <i class="fas fa-shipping-fast"></i></div>
                <h3>fast delivery</h3>
                <p>Fast delivery services typically prioritize speed over cost, so they may be more expensive than
                    standard delivery options.</p>
            </div>

            <div class="box">
                <div class="rotate"> <i class="fas fa-undo"></i></div>
                <h3>10 days replacements</h3>
                <p>This policy is designed to give customers peace of mind when making purchases and ensure that
                    they
                    receive products that meet their expectations. </p>
            </div>

            <div class="box">
                <div class="rotate"> <i class="fas fa-headset"></i></div>
                <h3>24 x 7 support</h3>
                <p>Having 24 X 7 support can be beneficial for customers as it allows them to quickly resolve any
                    issues
                    or problems they may encounter.</p>
            </div>
            <div class="box">
                <div class="rotate"><i class="fa fa-dollar"></i></div>
                <h3>We Accept</h3>
                <ul style="list-style-image:URL(../images/payement/money2.png);">
                    <li><img src="../images/payement/Visa_Logo.png" style="width: small;"></li>
                    <li><img src="../images/payement/MasterCard_logo.png" style="width: small;"></li>


                </ul>
            </div>

        </div>

    </section>
    <!--Service section ends-->
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
        window.location.href = "../sign up.html"
    }

    function navigate(id) {

        window.location.href = 'articleDetail.php?ref=' + id;
        localStorage.setItem('idArt', id);
    }



    //logIn Button
    var role = localStorage.getItem("role");
    var logInBtn = document.getElementById("logInBtn");
    if (role != null) {
        logInBtn.hidden = true;

    }

    function val() {
        var filter = document.getElementById("filter");
        console.log(filter.value);
        if (filter.value == "croissant") {
            articlesKids =
                mapNumeriqueCroissant(articlesKids);
            document.getElementById("pro-container").innerHTML = ""
            articlesKids.forEach(afficher);
        } else if (filter.value == "Decroissant") {
            articlesKids =
                mapNumeriqueDeCroissant(articlesKids);
            document.getElementById("pro-container").innerHTML = ""
            articlesKids.forEach(afficher);

        } else {
            document.getElementById("pro-container").innerHTML = ""

            articlesKids.forEach(afficher);
        }
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