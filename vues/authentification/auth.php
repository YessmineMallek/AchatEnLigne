<?php
$errors = array();
function verifyInputs($email, $password)
{
    $errors = array();
    // Verify email input
    if (empty($email)) {
        array_push($errors, "Email is required");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format");
    }

    // Verify address input
    if (empty($password)) {
        array_push($errors,  "password is required");
    }


    return $errors;
}
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $errors = verifyInputs($email, $pass);
    if (count($errors) == 0) {


        include("../../entites/user.php");
        $users = Utilisateur::FindByEmail($_POST['email']);
        if (count($users) > 0) {
            foreach ($users as $user)
                if (password_verify($pass, $user->password)) {

                    if ($email == 'admin@gmail.com') {
                        echo "<script>localStorage.setItem('role','admin');
                        localStorage.setItem('panier', JSON.stringify([])); 
                        localStorage.setItem('userId','" . $email . "');
                        window.location.href = '../home/home.html';</script>";
                    } else {
                        echo "<script>localStorage.setItem('role','autre');
                        localStorage.setItem('panier', JSON.stringify([])); 
                        localStorage.setItem('userId','" . $email . "');
                        window.location.href = '../home/home.html';</script>";
                    }
                } else {
                    array_push($errors, "Incorrect password ...!");
                }
        } else {
            array_push($errors, "Incorrect User email ...!");
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/signUp.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Sign in and sign up form </title>
    <script src="https://kit.fontawesome.com/514c1af453.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../images/logo.png">

</head>

<body>
    <div class="container">
        <!--Heder section starts -->
        <header>
            <img width="130px" src="../images/logo.png" id="logo" onmouseover="hover()" onmouseleave="small()">

            <div class="navBar">


                <a href="../home/home.html">Home</a>
                <a href="../home/home.html">About</a>
                <a href="../home/home.html">Contact Us</a>


            </div>


        </header>
        <!--Heder section ends -->
        <div class="main">
            <div class="form-box">
                <h1 id="title">Sign In </h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <?php if (isset($errors)) {
                        foreach ($errors as $msg) {
                            echo "<span class='signup-error'> " . $msg . "</span><br>";
                        }
                    } ?>
                    <div class="input-group">


                        <div class="input-field">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" onkeyup="validateEmail()">
                            <span id="email-error"></span>
                        </div>

                        <div class="input-field">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" placeholder="Password" name="password" id="password" onkeyup="validatePassword()">
                            <span id="password-error"></span>

                        </div>
                        <p>I don't have an account <a href="signUp.php">Click here ! </a></p>
                    </div>
                    <div class="btn-field">
                        <button type="submit" name='signIn' id="signinBtn">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="social-links">
            <a href="">FACEBOOK</a>
            <a href="">INSTAGRAM</a>



        </div>
    </div>
    <script>
        let signupBtn = document.getElementById("signupBtn");
        let signinBtn = document.getElementById("signinBtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");


        //Javascript Form Validation 
        var nameError = document.getElementById('name-error')
        var emailError = document.getElementById('email-error')
        var passwordError = document.getElementById('password-error')
        var signupError = document.getElementById('signup-error')
        var signinError = document.getElementById('signin-error')

        function validateName() {
            var name = document.getElementById('contact-name').value;
            if (name.length == 0) {
                nameError.innerHTML = 'Name is required ';
                return false;
            }
            if (name.length < 3) {
                nameError.innerHTML = 'Name is at least 3 characters';
                return false;
            }
            nameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
            return true;
        }

        function validateEmail() {
            var email = document.getElementById('email').value;

            if (email.length == 0) {
                emailError.innerHTML = 'Email is required';
                return false;
            }
            if (!email.match(/^[A-Za-z\._\-[0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)) {
                emailError.innerHTML = 'Email Invalid';
                return false;
            }
            emailError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
            return true;
        }

        function validatePassword() {
            var password = document.getElementById('password').value;

            if (password.length == 0) {
                passwordError.innerHTML = 'Password is required';
                return false;
            }
            if (password.length < 6) {
                passwordError.innerHTML = 'Password has to be at least 6 characters';
                return false;
            }
            passwordError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
            return true;
        }

        function validateFormup() {
            if (!validateName() || !validateEmail() || !validatePassword()) {
                signupError.innerHTML = 'please fix error to submit';
                return false;
            }
        }

        function validateFormin() {
            if (!validateEmail() || !validatePassword()) {
                signinError.innerHTML = 'please fix error to submit';
                return false;
            }
            return true;
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