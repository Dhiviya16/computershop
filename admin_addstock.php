<?php
@include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['add_product'])){

    $barcode = mysqli_real_escape_string($conn, $_POST['barcode']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specifications = mysqli_real_escape_string($conn, $_POST['specifications']);
    $product_type = mysqli_real_escape_string($conn, $_POST['product_type']);
    $manufacturingdate = mysqli_real_escape_string($conn, $_POST['manufacturingDate']);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $tradeprice = mysqli_real_escape_string($conn, $_POST['tradePrice']);
    $retailprice = mysqli_real_escape_string($conn, $_POST['retailPrice']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $warranty = mysqli_real_escape_string($conn, $_POST['warranty']);

    $select_barcode = mysqli_query($conn, "SELECT barcode FROM `products` 
    WHERE barcode = '$barcode'") or die('query failed');

    if(mysqli_num_rows($select_barcode) > 0){
        $message[] = 'product barcode already exist!';
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `products`
        (barcode, name, specifications, type, manufacturingDate,
        image, tradePrice, retailPrice, quantity, warrantyAvailability) 
        VALUES('$barcode', '$name', '$specifications', '$product_type', '$manufacturingdate', '$image',
        '$tradeprice', '$retailprice', '$quantity', '$warranty')") or die('unable to update to database');

        if($insert_product){
            if($image_size > 2000000){
                $message[] = 'image size is too large!';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'product added successfully!';
            }
        }
    }

}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Add Stock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="css/admin_style.css">
    </head>

    <body>
    <?php @include 'admin_header.php'; ?>

    <section class="add-products">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Add Stock</h3>
            <label>Product Bar Code No.: </label>
            <input type="text" class="box" required placeholder="enter barcode num" maxlength=12 name="barcode">

            <label>Product Name: </label>
            <input type="text" class="box" required placeholder="enter product name" name="name">
            
            <label>Product Specifications: </label>
            <textarea class="box" required placeholder="enter product specifications" cols="30" rows="10" name="specifications"></textarea>

            <label>Product Type: </label>
            <select name="product_type" id="product_type" class="box" placeholder="--Select the type of product--" required>
                <option value="Laptop">Laptop</option>
                <option value="Computer">Computer</option>
                <option value="Monitor">Monitor</option>
                <option value="Mouse">Mouse</option>
                <option value="Keyboard">Keyboard</option>
                <option value="Accessories">Accessories</option>
                <option value="Others">Others</option>
            </select>

            <label>Product Manufacturing Date: </label>
            <input type="date" id="product_manufacturingDate" class="box" name="manufacturingDate" required></input>
            
            <label>Product Image: </label>
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
            
            <label>Trade Price: </label>
            <div class="slidercontainer">
                <input type="range" name="tradePrice" id="product_tradePrice" min="1" max="100" value="50" class="slider" required></input>
                <span name="tradePrice_display" id="tradePrice_display" class="count" value=""></span>
            </div>

            <label>Retail Price: </label>
            <div class="slidercontainer">
                <input type="range" name="retailPrice" id="product_retailPrice" min="1" max="100" value="50" class="slider" required></input>
                <span name="retailPrice_display" id="retailPrice_display" class="count" value=""></span>
            </div>

            <label>Product Quantity: </label>
            <div class="slidercontainer">
                <input type="range" name="quantity" id="product_quantity" min="1" max="20" value="10" class="slider" required></input>
                <span name="quantity_display" id="quantity_display" class="count" value=""></span>
            </div>

            <label>Warranty Availability: </label>
            <div class="box radiocontainer">
                <input type="radio" name="warranty" id="radio_btn" class="radio" value="1" required>Yes</input>
                <input type="radio" name="warranty" id="radio_btn" class="radio" value="0">No</input>
            </div>

            <input type="submit" value="add product" name="add_product" class="btn">

        </form>
        </section>
        <script src="js/admin_script.js"></script>
    </body>
</html>