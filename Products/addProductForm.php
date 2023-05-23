<?php




include("../connexion/connection.php");
if (isset($_POST["add_product"]) == 1) {

    $images = $_FILES["product_image"]["tmp_name"];
    if ($images[0] == '') {
        $message[] = "fill out the form ...!";
    } else {

        if (
            !empty($_POST["product_ref"]) &&  !empty($_POST["product_desc"]) && !empty($_POST["product_name"]) &&
            !empty($_POST["product_price"]) && !empty($_POST["sexe"]) && $images[0] != ''
        ) {
            $validationExtensions = array('jpg', 'jpeg', 'png');
            $ref = $_POST["product_ref"];
            $uploadDir = "../uploaded_Images/";
            $description = $_POST["product_desc"];
            $name = $_POST["product_name"];
            $price = $_POST["product_price"];
            $sexe = $_POST["sexe"];

            /******************Plusieurs Images********************* */
            foreach ($images as $imagekey => $imageValue) {
                $image = $_FILES["product_image"]["name"][$imagekey];
                $image_temp = $_FILES["product_image"]["tmp_name"][$imagekey];
                $imageType = pathinfo($uploadDir . $image, PATHINFO_EXTENSION);

                //Get Image new name

                $imageNewName = uniqid() . "." . $imageType;
                if (!empty($image) && !in_array($imageType, $validationExtensions)) {
                    $message[] = 'File must be an Image ...!';
                } else {
                    /***************Ajout du produit ************* */
                    try {
                        $rep = $conn->exec("insert into produit values('$name' , '$description ' , '$ref' , $price ,'$sexe')") or die(print_r($conn->errorInfo()));
                    } catch (PDOException $e) {
                        if ($e->getCode() == 23000) {
                            $message[] = "Product already exists";
                        } else {
                            $message[] = $e->getMessage();
                        }
                    }
                    $store = move_uploaded_file($image_temp, $uploadDir . $imageNewName);
                    $rep2 = $conn->exec("insert into images_produit values('$ref','$imageNewName')") or die(print_r($conn->errorInfo()));
                }
            }
        } else {
            $message[] = "fill out the form ...!";
        }
    }
}
if (!empty($_GET['delete'])) {
    $id = $_GET['delete'];

    $rep = $conn->exec("delete from produit where ref  like '$id'") or die(print_r($conn->errorInfo()));
    if ($rep > 0) {
        $message[] = "Product deleted successfully";
    }
};
if (!empty($_GET['edit'])) {
    $id = $_GET['edit'];
    $req = "select * from produit where ref  like '$id'";
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
};


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

            <div class=" product-display">
                <?php if (isset($message)) {
                    foreach ($message as $msg) {
                        echo "<span class='error'> <h3>" . $msg . "</h3></span><br>";
                    }
                } ?>
                <table class="product-display-table" id="product-display-table" name="tab">
                    <thead>
                        <tr>
                            <th>product image</th>
                            <th>product name</th>
                            <th>product price</th>
                            <th>Gender</th>
                            <th>Actions</th>


                        </tr>
                        <?php
                        include("../connexion/connection.php");
                        $req = "select * from produit";

                        $resultat = $conn->query($req);
                        $resultat->setFetchMode(PDO::FETCH_BOTH);

                        $rows = $resultat->fetchAll();

                        foreach ($rows as $p) {
                            $req2 = "select * from images_produit where ref_prod = '" . $p["ref"] . "' ;";
                            $resultat2 = $conn->query($req2);
                            $resultat2->setFetchMode(PDO::FETCH_BOTH);

                            $rows2 = $resultat2->fetchAll();
                            echo "<tr value=" . $p["ref"] . "> <td><img height = \"100\" src=\"../uploaded_Images/" . $rows2[0]['imageName'] . "\"></td><td>" . $p["nom"] . "</td> <td> " . $p["prix"] . "DT</td><td>" . $p["sexe"] . "</td><td><a href='edit-product.php?edit=" . $p["ref"] . "' class='btn'><i class=\"fas fa-edit\"> </i></a><a class='btn' href='addProductForm.php?delete=" . $p["ref"] . "'><i class='fas fa-trash'> </i></a></td></tr>";
                        }

                        ?>
                    </thead>

                </table>
            </div>
            <!--The form to add a product-->
            <div class="admin-product-form-container">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="f1" id="myForm" enctype="multipart/form-data">
                    <h3>Add new product</h3>

                    <label class="label" for="ref">Product reference <span class="required">*</span></label>
                    <input type="text" placeholder="Enter product reference" name="product_ref" class="box" id="product_ref" value="<?php if (isset($_POST['product_ref'])) echo $_POST['product_ref'] ?>">

                    <label class="label" for="name">Product Name <span class="required">*</span></label>
                    <input type="text" placeholder="Enter product name" name="product_name" class="box" id="product_name" value="<?php if (isset($_POST['product_name'])) echo $_POST['product_name'] ?>">

                    <label class="label" for="product_desc">Product Description <span class="required">*</span></label>
                    <textarea placeholder="Enter product Description" name="product_desc" class="box" id="product_desc" style="resize:none" rows="6" cols="50"><?php if (isset($_POST['product_desc'])) echo $_POST['product_desc'] ?></textarea>


                    <label class="label" for="Price">Product Price <span class="required">*</span></label>
                    <input type="number" placeholder="Enter product price" name="product_price" class="box" id="product_price" value="<?php if (isset($_POST['product_price'])) echo $_POST['product_price'] ?>">

                    <label for=" Sexe" class="label">Gender <span class="required">*</span></label><br>
                    <input type="radio" name="sexe" value="women" checked><span class="sexe">Women</span>
                    <input type="radio" name="sexe" value="men"><span class="sexe">Men</span>
                    <input type="radio" name="sexe" value="kid"><span class="sexe">Kid</span>
                    <br>
                    <br>

                    <input type="file" id="inputFile" accept="image/*" name="product_image[]" multiple><br>

                    <input type="submit" class="btn" name="add_product" value="Save">

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