<?php
$message = [];

include("../../conn/connection.php");
if (isset($_POST["add_product"]) == 1) {
    $error = false;
    $images = $_FILES["product_image"]["tmp_name"];
    if ($images[0] == '') {
        $error = true;
        array_push($message, "fill out the form ...!");
    }
    if (empty($_POST["product_ref"])) {
        $error = true;
        array_push($message, "Product should have a reference...!");
    }
    if (empty($_POST["product_desc"])) {
        $error = true;
        array_push($message, "Product should have a description ...!");
    }
    if (empty($_POST["product_name"])) {
        $error = true;
        array_push($message, "Product should have a name ...!");
    }
    if (empty($_POST["product_price"])) {
        $error = true;
        array_push($message, "Product should have a price ...!");
    }

    if (empty($_POST["sexe"])) {
        $error = true;
        array_push($message, "Product should have a gender ...!");
    }
    if (empty($_POST["product_quantity"])) {
        $error = true;
        array_push($message, "Product should have a Quantity ...!");
    }
    if (!empty($_POST["product_quantity"]) && $_POST["product_quantity"] < 0) {
        $error = true;
        array_push($message, "Product Quantity should be positive...!");
    }
    if ($error == false) {
        $validationExtensions = array('jpg', 'jpeg', 'png');
        $ref = $_POST["product_ref"];
        $uploadDir = "../../uploaded_Images/";
        $description = $_POST["product_desc"];
        $name = $_POST["product_name"];
        $price = $_POST["product_price"];
        $sexe = $_POST["sexe"];
        $qte = $_POST["product_quantity"];


        /***************Ajout du produit ************* */
        try {
            $rep = $conn->exec("insert into produit(nom, descrip, ref, prix, sexe,qte) values('$name' , '$description ' , '$ref' , $price ,'$sexe',$qte)") or die(print_r($conn->errorInfo()));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                array_push($message, "Product already exists");
            } else {
                array_push($message,  $e->getMessage());
            }
        }
        /******************Plusieurs Images********************* */
        foreach ($images as $imagekey => $imageValue) {
            $image = $_FILES["product_image"]["name"][$imagekey];
            $image_temp = $_FILES["product_image"]["tmp_name"][$imagekey];
            $imageType = pathinfo($uploadDir . $image, PATHINFO_EXTENSION);
            //Get Image new name
            $imageNewName = uniqid() . "." . $imageType;
            if (!empty($image) && !in_array($imageType, $validationExtensions)) {
                array_push($message,  'File must be an Image ...!');
            } else {
                try {
                    $store = move_uploaded_file($image_temp, $uploadDir . $imageNewName);
                    $rep2 = $conn->exec("insert into images_produit values('$ref','$imageNewName')") or die(print_r($conn->errorInfo()));
                    if ($rep2 > 0) {
                        $_POST["product_ref"] = "";
                        $_POST["product_desc"] = "";
                        $_POST["product_name"] = "";
                        $_POST["product_price"] = 0;
                        $_POST["sexe"] = "";
                        $_POST["product_quantity"] = 0;
                    }
                } catch (PDOException $e) {
                    array_push($message,  $e->getMessage());
                }
            }
        }
    }
}
if (!empty($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $rep = $conn->exec("delete from produit where ref = '$id'");
        if ($rep > 0) {
            echo  "<script> alert('Product deleted successfully');</script>";
        }
    } catch (PDOException $e) {
        print_r($e->getMessage());
        if ($e->getCode() == 23000) {
            array_push($message,  "The product has orders...!");
        }
    }
};



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleHome.css">
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
            <a href="../home/home.html">Home</a>
        </div>
        <div class="navBar2">
            <a class="fa fa-sign-out" style="font-size:24px" onclick="LogOut()"></a>

        </div>
    </header>

    <section class="home">

        <div class="content">

            <div class=" product-display">

                <table class="product-display-table" id="product-display-table" name="tab">
                    <thead>
                        <tr>
                            <th>product image</th>
                            <th>product name</th>
                            <th>product price</th>
                            <th>product quantity</th>
                            <th>Gender</th>
                            <th>Actions</th>


                        </tr>
                        <?php
                        include("../../entites/produit.php");

                        $rows = Produit::findAll();
                        foreach ($rows as $p) {
                            echo $p->afficherProd();
                        }

                        ?>
                    </thead>

                </table>
            </div>
            <!--The form to add a product-->
            <div class="admin-product-form-container">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="f1" id="myForm" enctype="multipart/form-data">
                    <h3>Add new product</h3>
                    <?php if (isset($message)) {
                        foreach ($message as $msg) {
                            echo "<span class='error'> " . $msg . "</span><br>";
                        }
                    } ?>
                    <label class="label" for="ref">Product reference <span class="required">*</span></label>
                    <input type="text" placeholder="Enter product reference" name="product_ref" class="box" id="product_ref" value="<?php if (isset($_POST['product_ref'])) echo $_POST['product_ref'] ?>">

                    <label class="label" for="name">Product Name <span class="required">*</span></label>
                    <input type="text" placeholder="Enter product name" name="product_name" class="box" id="product_name" value="<?php if (isset($_POST['product_name'])) echo $_POST['product_name'] ?>">

                    <label class="label" for="product_desc">Product Description <span class="required">*</span></label>
                    <textarea placeholder="Enter product Description" name="product_desc" class="box" id="product_desc" style="resize:none" rows="6" cols="50"><?php if (isset($_POST['product_desc'])) echo $_POST['product_desc'] ?></textarea>


                    <label class="label" for="Price">Product Price <span class="required">*</span></label>
                    <input type="number" placeholder="Enter product price" name="product_price" class="box" id="product_price" value="<?php if (isset($_POST['product_price'])) echo $_POST['product_price'] ?>">


                    <label class="label" for="Price">Product quantity <span class="required">*</span></label>
                    <input type="number" placeholder="Enter product quantity" name="product_quantity" class="box" id="product_quantity" value="<?php if (isset($_POST['product_quantity'])) echo $_POST['product_quantity'] ?>">



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