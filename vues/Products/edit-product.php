<?php
include("../connexion/connection.php");
if (!empty($_GET['edit'])) {
    $ref = $_GET['edit'];
    $req = "select * from produit where ref  like '$ref'";
    $resultat = $conn->query($req);
    $resultat->setFetchMode(PDO::FETCH_BOTH);

    $rows = $resultat->fetchAll();
    foreach ($rows as $prod) {
        $ref = $prod["ref"];
        $description = $prod["descrip"];
        $name = $prod["nom"];
        $price = $prod["prix"];
        $gender = $prod["sexe"];
    }
}




if (isset($_POST["edit_product"])) {
    $description = $_POST["product_desc"];
    $name = $_POST["product_name"];
    $price = $_POST["product_price"];
    $sexe = $_POST["sexe"];

    $req = "update produit set nom='$name' ,descrip= '$description' ,prix='$price' ,sexe='$sexe' where ref  like '$ref'";
    $rep = $conn->exec($req);
    if ($rep > 0) {
        session_destroy();
        header('location:addProductForm.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styleHome.css">
    <link rel="stylesheet" href="productStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" href="../images/logo.png">


    <title>Add Product</title>
</head>

<body>
    <!--Heder section starts -->

    <header>
        <img width="130px" src="../images/logo.png" id="logo" onmouseover="hover()" onmouseleave="small()">

        <div class="navBar">
            <a href="../home.html">Home</a>
        </div>
        <div class="navBar2">
            <a class="fa fa-sign-out" style="font-size:24px" onclick="LogOut()"></a>

        </div>
    </header>

    <section class="home">

        <div class="content">


            <!--The form to add a product-->
            <div class="admin-product-form-container">

                <form action="" method="POST" name="f1" id="myForm" enctype="multipart/form-data">
                    <h3>Edit product</h3>

                    <label class="label" for="ref">Product reference <span class="required">*</span></label>
                    <input type="text" placeholder="Enter product reference" name="product_ref" class="box" id="product_ref" disabled value="<?php if ($ref != "") echo $ref ?>">

                    <label class="label" for="name">Product Name <span class="required">*</span></label>
                    <input type="text" placeholder="Enter product name" name="product_name" class="box" id="product_name" value="<?php if ($name != "") echo $name ?>">

                    <label class="label" for="product_desc">Product Description <span class="required">*</span></label>
                    <textarea placeholder="Enter product Description" name="product_desc" class="box" id="product_desc" style="resize:none" rows="6" cols="50"><?php if ($description != "") echo $description ?></textarea>


                    <label class="label" for="Price">Product Price <span class="required">*</span></label>
                    <input type="number" placeholder="Enter product price" name="product_price" class="box" id="product_price" value="<?php if ($price != "") echo $price ?>">

                    <label for=" Sexe" class="label">Gender <span class="required">*</span></label><br>
                    <input type="radio" name="sexe" value="women" <?php if ($gender == 'women') echo 'checked' ?>><span class="sexe">Women</span>
                    <input type="radio" name="sexe" value="men" <?php if ($gender == 'men') echo 'checked' ?>><span class="sexe">Men</span>
                    <input type="radio" name="sexe" value="kid" <?php if ($gender == 'kid') echo 'checked' ?>><span class="sexe">Kid</span>
                    <br>
                    <br>

                    <input type="file" id="inputFile" accept="image/*" name="product_image[]" multiple><br>

                    <input type="submit" class="btn" name="edit_product" value="Edit">

                    <input type="reset" class="btn" value="Reset" style="align-items: center;">

                </form>
            </div>

        </div>
    </section>
</body>


</html>


<script>
    function LogOut() {
        localStorage.clear();
        window.location.href = "../sign up.html"
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