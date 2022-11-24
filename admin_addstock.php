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
    $image_folter = 'uploaded_img/'.$image;

    $tradeprice = mysqli_real_escape_string($conn, $_POST['tradePrice']);
    $retailprice = mysqli_real_escape_string($conn, $_POST['retailPrice']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $warranty = mysqli_real_escape_string($conn, $_POST['warranty']);

    $select_barcode = mysqli_query($conn, "SELECT productBarCodeNum FROM `stocks` 
    WHERE productBarCodeNum = '$barcode'") or die('query failed');

    if(mysqli_num_rows($select_barcode) > 0){
        $message[] = 'product barcode already exist!';
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `stocks`
        (productBarCodeNum, productName, productSpecifications, productType, productManufacturingDate,
        productImage, productTradePrice, productRetailPrice, productQuantity, productWarranty) 
        VALUES('$barcode', '$name', '$specifications', '$product_type', '$manufacturingdate', '$image',
        '$tradeprice', '$retailprice', '$quantity', '$warranty')") or die('query failed');

        if($insert_product){
            if($image_size > 2000000){
                $message[] = 'image size is too large!';
            }else{
                move_uploaded_file($image_tmp_name, $image_folter);
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
            <input type="text" class="box" required placeholder="enter barcode num" name="barcode">

            <label>Product Name: </label>
            <input type="text" class="box" required placeholder="enter product name" name="name">
            
            <label>Product Specifications: </label>
            <textarea class="box" required placeholder="enter product specifications" cols="30" rows="10" name="specifications"></textarea>

            <label>Product Type: </label>
            <select name="product_type" id="product_type" class="box" placeholder="--Select the type of product--" required>
                <option value="laptop">Laptop</option>
                <option value="computer">Computer</option>
                <option value="monitor">Monitor</option>
                <option value="mouse">Mouse</option>
                <option value="keyboard">Keyboard</option>
                <option value="accessories">Accessories</option>
                <option value="others">Others</option>
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
                <input type="radio" name="warranty" id="radio_btn" class="radio" value="True" required>Yes</input>
                <input type="radio" name="warranty" id="radio_btn" class="radio" value="False">No</input>
            </div>

            <input type="submit" value="add product" name="add_product" class="btn">

        </form>
        </section>
        <script src="js/admin_script.js"></script>
    </body>
</html>