<?php

if (isset($_POST['submit'])){
   $name = $_POST["firstname"];
   $email = $_POST["lastname"];
   $commentaire = $_POST["subject"];
    // extract($_POST);
    if (!empty($name ) and !empty($email) and !empty($commentaires)){
         require_once('<commentaire>dp_commentaires.php');
         $req=$dp->prepare('INSERT INTO comm (IDcomm,name,email,message,date)) VALUES (?,?,?,?,NOW())');
         $req->execute(array($name,$email,$commentaire));
    
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleAboutUs.css">
    <link rel="stylesheet" href="serviceStyle.css">
    <link rel="stylesheet" href="styleHome.css">

    <link rel="stylesheet" href="contactUsStyle.css">
    <link rel="stylesheet" href="productReview.css">
    <link rel="stylesheet" href="partner.css">
    <link rel="stylesheet" href="footer.css">


    <!--Font awsome links-->
    <script src="https://kit.fontawesome.com/514c1af453.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" href="images/logo.png">

    <title>Home Page</title>
</head>

<body>
    <!--Heder section starts -->
        <img width="130px" src="images/logo.png" id="logo" onmouseover="hover()" onmouseleave="small()">

        <div class="navBar">

            <a href="">Home</a>
            <a href="#about">About</a>
            <a href="#ContactUsSection">Contact us</a>
            <a href="#Product-review">Product review</a>



        </div>
        <div class="navBar2">
            <a id="panier"><img class="cart" src="images/cart.png"></a>

            <span id="logInBtn"><a class="fa fa-sign-in" style="font-size:24px" href="sign up.html"></a></span>
            <a class="fa fa-sign-out" style="font-size:24px" onclick="LogOut()"></a>

        </div>
    </header>
    <!--Heder section ends -->

    <!--Home section starts-->
    <section class="home" id="home">
        <div class="content">

            <div class="row">

                <div class="col">
                    <a id="product" href="Products/addProductForm.php" class="btn">Add Product</a>
                    <h1>You should always feel pretty</h1>
                    <p id="displayData"></p>
                    <div class="arrow-icons">
                        <input type="image" onclick="back()" style=" height: 50px;width: 50px;"
                            src="images/back-arrow.png">
                        <input type="image" style=" height: 50px;width: 50px;padding-left: 5px;" onclick="next()"
                            src="images/next-arrow.png">

                    </div>

                </div>
                <div class="col">
                    <a id="lienFemme">
                        <div class="card card1">
                            <h3>Womens</h3>
                        </div>
                    </a>
                    <a id="lienHomme">
                        <div class="card card2">
                            <h3>Mens</h3>
                        </div>
                    </a>
                    <a id="lienEnfant">
                        <div class="card card3">
                            <h3>Kids</h3>
                        </div>
                    </a>



                </div>




            </div>
        </div>
        <div class="social-links">
            <a href="https://www.facebook.com/">FACEBOOK</a>
            <a href="https://www.instagram.com/">INSTAGRAM</a>
        </div>
    </section>

    <!--Home section ends-->
    <!---Product review starts-->
    <section id="Product-review">
        <h1 class="heading">
            <span>
                Product
            </span>
            Review
        </h1>
        <div class="container2">
            <div class="ProductReview">
                <div class="skill">

                    <div class="outer">
                        <div class="inner">
                            <div id="number">
                            </div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
                        <defs>
                            <linearGradient id="GradientColor">
                                <stop offset="0%" stop-color="#e91e63" />
                                <stop offset="100%" stop-color="#673ab7" />
                            </linearGradient>
                        </defs>
                        <circle id="circle1" cx="80" cy="80" r="70" stroke-linecap="round" />
                    </svg>
                    <br>
                    <div class="topixText2">Men's Collection</div>




                </div>
                <!--Skill 2--->
                <div class="skill">

                    <div class="outer">
                        <div class="inner">
                            <div id="number2">
                            </div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
                        <defs>
                            <linearGradient id="GradientColor">
                                <stop offset="0%" stop-color="#e91e63" />
                                <stop offset="100%" stop-color="#673ab7" />
                            </linearGradient>
                        </defs>
                        <circle id="circle2" cx="80" cy="80" r="70" stroke-linecap="round" />
                    </svg>
                    <br>
                    <div class="topixText2">Women's Collection</div>


                </div>
                <!--Skill 3--->
                <div class="skill">

                    <div class="outer">
                        <div class="inner">
                            <div id="number3">
                            </div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
                        <defs>
                            <linearGradient id="GradientColor">
                                <stop offset="0%" stop-color="#e91e63" />
                                <stop offset="100%" stop-color="#673ab7" />
                            </linearGradient>
                        </defs>
                        <circle id="circle3" cx="80" cy="80" r="70" stroke-linecap="round" />
                    </svg>
                    <br>
                    <div class="topixText2">Kid's Collection</div>

                </div>

            </div>
        </div>
    </section>

    <!-----Product review END----->



    <!--About section starts-->
    <section class="about" id="about">
        <h1 class="heading">
            <span>
                About
            </span>
            us
        </h1>
        <div class="row">
            <div class="video-container">
                <video src="images/video.mp4" loop autoplay muted></video>

                <h3>Best Clothes sellers</h3>
            </div>
            <div class="content">
                <h3>Why choose us ? </h3>
                <p>Choose our online clothing store for high-quality clothing from top brands, fast and reliable
                    shipping, easy returns and exchanges, and competitive prices. Our website is user-friendly,
                    providing detailed descriptions and images to help you make informed purchases. We prioritize
                    customer satisfaction and are committed to providing a convenient and enjoyable shopping experience.
                    Shop with us and elevate your style with our trendy and affordable clothing options.</p>
                <br>
                <br><br><br>
                <br><br>
                <audio controls>

                    <source src="sounds.mp3" type="audio/mpeg">
                </audio>

            </div>





        </div>

    </section>

    <!--About section ends-->


    <!--Contacts us starts-->
    <section id="ContactUsSection">
        <h1 class="heading">
            <span>
                Contact
            </span>
            us
        </h1>
        <div class="container1">
            <div class="contactUs">
                <div class="left-side">
                    <div class="adresse details">
                        <a href="wheretofindus.html"> <i class="fas fa-map-marker-alt"></i></a>
                        <div class="topic">Address</div>
                        <div class="text-one">Campus Universitaire de Manouba </div>

                    </div>
                    <div class="phone details">
                        <i class="fas fa-phone-alt"></i>
                        <div class="topic">Phone</div>
                        <div class="text-one">+216 70 000 000</div>
                        <div class="text-two">+216 70 000 000</div>

                    </div>
                    <div class="Email details">
                        <i class="fas fa-envelope"></i>
                        <div class="topic">Email</div>
                        <div class="text-one"><a href="mailto:Jeasmine@gmail.Com">Jeasmine@gmail.Com</a></div>
                        <div class="text-two"><a href="mailto:info@gmail.Com">info@gmail.Com</a></div>

                    </div>

                </div>
                <div class="right-side">

                    <div class="topixText">Give us Comment </div>
                    <form  name="checkout" id="idForm" method="post" action="" enctype="application/x-www-form-urlencoded">
                        <span id="fname-error"></span>
                        <div class="inputBox">
                            <input type="text" id="fname" name="firstname" placeholder="Enter Your name.." required="" 
                                 id="contact-fname" onkeyup="validateFName()">
                        </div>
                        <span id="lname-error"></span>
                        <div class="inputBox">
                            <input type="text" id="lname" name="lastname" placeholder="Enter you Email.."  required=""
                                id="contact-lname" onkeyup="validateLName()">
                        </div>
                        <span id="message-error"></span>
                        <div class="inputBox"> <textarea id="subject" name="subject" placeholder="Write message.." required=""
                                onkeyup="validateMessage()"></textarea></div>

                        <input class="btnn" type="submit" value="Submit" name="Submit"  onclick="return validateForm()">
                        <input style="margin-left: 60%;" class="btnn" type="button" value="Examples"
                            onclick='window.location.href="avis.html"'>
                        <span id="submit-error"></span>
                    </form>

                </div>

            </div>
        </div>
    </section>
    <!--Contacts us ends-->
    <!--Parteners starts-->
    <section id="Partners">
        <h1 class="heading">
            <span>
                Partners
            </span>

        </h1>
        <div class="container3">
            <div class="slider">
                <div class="slide-track">
                    <div class="slide"><img src="images/partner/adidas.png" height="150" width="150" alt=""></div>
                    <div class="slide"><img src="images/partner/facebook.png" height="150" width="150" alt=""></div>
                    <div class="slide"><img src="images/partner/google.png" height="150" width="150" alt=""></div>

                    <div class="slide"><img src="images/partner/instagram.png" height="150" width="150" alt=""></div>
                    <div class="slide"><img src="images/partner/nike.png" height="150" width="150" alt=""></div>
                    <div class="slide"><img src="images/partner/twitter.png" height="150" width="150" alt=""></div>
                    <div class="slide"><img src="images/partner/uber.png" height="150" width="150" alt=""></div>
                    <div class="slide"><img src="images/partner/youtube.png" height="150" width="150" alt=""></div>




                </div>

            </div>
        </div>
    </section>
    <!-- Parteners ends-->
    <!--Service section starts-->
    <section class="service">

        <div class="box-container">

            <div class="box">
                <div class="rotate"> <i class="fas fa-shipping-fast"></i></div>
                <h3>fast delivery</h3>
                <p>Fast delivery services typically prioritize speed over cost, so they may be more expensive
                    than
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
                <p>Having 24 X 7 support can be beneficial for customers as it allows them to quickly resolve
                    any
                    issues
                    or problems they may encounter.</p>
            </div>
            <div class="box">
                <div class="rotate"><i class="fa fa-dollar"></i></div>
                <h3>We Accept</h3>
                <ul style="list-style-image:URL(images/payement/money2.png);">
                    <li><img src="images/payement/Visa_Logo.png" style="width: small;"></li>
                    <li><img src="images/payement/MasterCard_logo.png" style="width: small;"></li>


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
    var productsBtn = document.getElementById("product");
    var lienHom = document.getElementById("lienHomme");
    var lienFem = document.getElementById("lienFemme");
    var lienEn = document.getElementById("lienEnfant");
    var lienAutre = document.getElementById("lienAll");
    var lienPanier = document.getElementById("panier");
    var i = 1;
    const quotes = [
        "Clothes that are sure to heat up your winter.",
        "Fashion is about dressing according to what's fashionable.",
        "Style is a way to say who you are without having to speak.",
        "Fashion is the armor to survive the reality of everyday life.",
        "Fashion is the armor to survive the reality of everyday life.",

        "Style is a way to say who you are without having to speak.",
        "Clothes that are sure to heat up your winter.",
        "Fashion is about dressing according to what's fashionable.",
        "Style is a way to say who you are without having to speak.",
        "Fashion is the armor to survive the reality of everyday life.",
        "Fashion is the armor to survive the reality of everyday life.",

        "Style is a way to say who you are without having to speak.",

    ];
    var place = document.getElementById("displayData");
    var texte = document.createTextNode(quotes[0]);
    place.appendChild(texte);
    var role = localStorage.getItem("role");


    function LogOut() {
        localStorage.clear();
        window.location.href = "sign up.html"
    }

    function back() {

        if (i > 0) {
            i--;

            document.getElementById("displayData").innerHTML = "";
            var texte = document.createTextNode(quotes[i]);
            place.appendChild(texte);
        }
    }
    function next() {
        if (i < quotes.length) {
            document.getElementById("displayData").innerHTML = "";
            var texte = document.createTextNode(quotes[i]);
            place.appendChild(texte);
            i++;

        }
    }
    window.setInterval(next, 2000)
    if (role != "admin") {
        productsBtn.hidden = true;
    } else {
        productsBtn.hidden = false;

    }
    var logInBtn = document.getElementById("logInBtn");

    if (role != null) {
        lienHom.setAttribute("href", "homme/homme.php");
        lienFem.setAttribute("href", "femme/femme.php");
        lienEn.setAttribute("href", "enfant/kid.php");
        lienPanier.setAttribute("href", "panier.html");
        logInBtn.hidden = true;

    } else {


        lienHom.setAttribute("href", "sign up.html");
        lienFem.setAttribute("href", "sign up.html");
        lienEn.setAttribute("href", "sign up.html");
        lienPanier.setAttribute("href", "sign up.html");
    }

    //Javascript Form Validation 
    var fnameError = document.getElementById('fname-error')
    var lnameError = document.getElementById('lname-error')
    var messageError = document.getElementById('message-error')
    var submitError = document.getElementById('submit-error')

    function validateFName() {
        var name = document.getElementById('fname').value;
        if (name.length == 0) {
            fnameError.innerHTML = 'First Name is required ';
            return false;
        }
        if (name.length < 3) {
            fnameError.innerHTML = 'First Name has to be at least 3 characters ';
            return false;
        }
        fnameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }
    function validateLName() {
        var Lname = document.getElementById('lname').value;
        if (Lname.length == 0) {
            lnameError.innerHTML = 'Last Name is required ';
            return false;
        }
        if (Lname.length < 3) {
            lnameError.innerHTML = 'Last Name has to be at least 3 characters ';
            return false;
        }
        lnameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }
    function validateMessage() {
        var message = document.getElementById('subject').value;
        var required = 30;
        var left = required - message.length;

        if (left > 0) {
            messageError.innerHTML = left + ' more characters required';
            return false;
        }
        messageError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }
    function validateForm() {
        if (!validateFName() || !validateLName() || !validateMessage()) {
            submitError.innerHTML = 'please fix error to submit';
            return false;
        }
    }
    var numb1 = document.getElementById("number");

    let counter = 0;
    setInterval(() => {
        if (counter == 60) {
            clearInterval();
        } else {
            counter += 1;
            numb1.textContent = counter + "%";
        }
    }, 30);
    var numb2 = document.getElementById("number2");

    let counter2 = 0;
    setInterval(() => {
        if (counter2 == 90) {
            clearInterval();
        } else {
            counter2 += 1;
            numb2.textContent = counter2 + "%";
        }
    }, 25);
    var numb3 = document.getElementById("number3");

    let counter3 = 0;
    setInterval(() => {
        if (counter3 == 70) {
            clearInterval();
        } else {
            counter3 += 1;
            numb3.textContent = counter3 + "%";
        }
    }, 30);
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