<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_barcode = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE barcode = '$delete_barcode'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE barcode = '$delete_barcode'") or die('Unable to delete from products');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pbarcode = '$delete_barcode'") or die('Unable to delete from wishlist');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pbarcode = '$delete_barcode'") or die('Unable to delete from cart');
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
      <div class="stockcount">Stock count: <?php echo $fetch_products['quantity']; ?></div>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="name"><?php echo $fetch_products['barcode']; ?></div>
         <div class="details">Product Type: <?php echo $fetch_products['type']; ?></div>
         <div class="details">Retail Price: $<?php echo $fetch_products['retailPrice']; ?></div>
         <div class="details">Trade Price: $<?php echo $fetch_products['tradePrice']; ?></div>
         
         <div class="details">Specifications:<br><?php echo nl2br($fetch_products['specifications']); ?></div>
         <div class="details">Manufacturing date: <?php echo $fetch_products['manufacturingDate']; ?></div>
         
         <div class="details">Warranty availability:
            <?php
               $warranty = $fetch_products['warrantyAvailability'];
               
               if($warranty=='1'){
                  echo "Yes";
               } else {
                  echo "No";
               }
            ?>
         </div>


         <a href="admin_update_product.php?update=<?php echo $fetch_products['barcode']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['barcode']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>
   

</section>












<script src="js/admin_script.js"></script>

</body>
</html>