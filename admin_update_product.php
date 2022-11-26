<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $barcode = mysqli_real_escape_string($conn, $_POST['barcode']);
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $specifications = mysqli_real_escape_string($conn, $_POST['specifications']);
   $type = mysqli_real_escape_string($conn, $_POST['type']);
   $manufacturingDate = mysqli_real_escape_string($conn, $_POST['manufacturingDate']);
   $tradePrice = mysqli_real_escape_string($conn, $_POST['tradePrice']);
   $retailPrice = mysqli_real_escape_string($conn, $_POST['retailPrice']);
   $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
   $warranty = mysqli_real_escape_string($conn, $_POST['warrantyAvailability']);


   mysqli_query($conn, "UPDATE `products` SET
   barcode = '$barcode', name = '$name', specifications = '$specifications',
   type = '$type', manufacturingDate = '$manufacturingDate', tradePrice = '$tradePrice',
   retailPrice = '$retailPrice', quantity = '$quantity', warrantyAvailability = '$warranty'
   
   WHERE barcode = '$update_p_id'") or die('query failed');

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['update_p_image'];
   
   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE barcode = '$update_p_id'") or die('query failed');
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('uploaded_img/'.$old_image);
         $message[] = 'image updated successfully!';
      }
   }

   $message[] = 'product updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="update-product">

<?php

   $update_id = $_GET['update'];
   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE barcode = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>

<form action="" method="post" enctype="multipart/form-data">
   <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image"  alt="">
   <input type="hidden" value="<?php echo $fetch_products['barcode']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
   
   <br>
   <label>Product Bar Code No.: </label>
   <input type="text" class="box" value="<?php echo $fetch_products['barcode']; ?>" required placeholder="update barcode" name="barcode">

   <label>Product Name: </label>
   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="update product name" name="name">
   
   <label>Product Specifications: </label>
   <textarea name="specifications" class="box" required placeholder="update product details" cols="30" rows="10"><?php echo $fetch_products['specifications']; ?></textarea>

   <label>Product Type: </label>
            <select name="type" id="product_type" class="box" placeholder="--Select the type of product--" required>
                <option value="Laptop">Laptop</option>
                <option value="Computer">Computer</option>
                <option value="Monitor">Monitor</option>
                <option value="Mouse">Mouse</option>
                <option value="Keyboard">Keyboard</option>
                <option value="Accessories">Accessories</option>
                <option value="Others">Others</option>
            </select>

   <label>Product Manufacturing Date: </label>
   <input type="date" class="box" value="<?php echo $fetch_products['manufacturingDate']; ?>" required name="manufacturingDate">
   
   <label>Trade Price: </label>
   <div class="slidercontainer">
      <input type="range" name="tradePrice" id="product_tradePrice" min="1" max="100" value="<?php echo $fetch_products['tradePrice']; ?>" class="slider" required></input>
      <span name="tradePrice_display" id="tradePrice_display" class="count" value=""></span>
   </div>
   
   <label>Retail Price: </label>
   <div class="slidercontainer">
      <input type="range" name="retailPrice" id="product_retailPrice" min="1" max="100" value="<?php echo $fetch_products['retailPrice']; ?>" class="slider" required></input>
      <span name="retailPrice_display" id="retailPrice_display" class="count" value=""></span>
   </div>

   <label>Product Quantity: </label>
      <div class="slidercontainer">
         <input type="range" name="quantity" id="product_quantity" min="1" max="20" value="<?php echo $fetch_products['quantity']; ?>" class="slider" required></input>
         <span name="quantity_display" id="quantity_display" class="count" value=""></span>
      </div>

   <label>Warranty Availability: </label>
      <div class="box radiocontainer">
         <input type="radio" name="warrantyAvailability" id="radio_btn"
         class="radio" value="1" required <?php echo ($fetch_products['warrantyAvailability'] == "1" ?'checked="checked"': ''); ?>>Yes</input>
         <input type="radio" name="warrantyAvailability" id="radio_btn"
         class="radio" value="0" <?php echo ($fetch_products['warrantyAvailability'] == "0" ? 'checked="checked"': ''); ?>>No</input>
      </div>
   
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
   <input type="submit" value="update product" name="update_product" class="btn">
   <a href="admin_products.php" class="option-btn">go back</a>
</form>

<?php
      }
   }else{
      echo '<p class="empty">no update product select</p>';
   }
?>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>