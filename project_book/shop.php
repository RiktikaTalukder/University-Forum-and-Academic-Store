<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:/blogBook/project_blog/login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_quantity = $_POST['product_quantity'];

   // Get product info with seller_id
   $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');
   $fetch_product = mysqli_fetch_assoc($select_product);

   $product_name = $fetch_product['name'];
   $product_price = $fetch_product['price'];
   $product_image = $fetch_product['image'];
   $seller_id = $fetch_product['seller_id'];

   // Check for duplicate
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' AND product_id = '$product_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, seller_id, product_id, name, price, quantity, image) VALUES('$user_id', '$seller_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!--=============== REMIXICONS ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@500&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>our shop</h3>
   <p> <a href="home.php">home</a> / shop </p>
</div>

<section class="products">

   <h1 class="title">Available Resources</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM products") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">৳<?php echo $fetch_products['price']; ?>/-</div>
         <div class="seller-id">Seller ID: <?php echo $fetch_products['seller_id']; ?></div>
         <input type="number" min="1" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>

      <?php
         }
      }else{
         echo '<p class="empty">No resources available yet. Check back soon!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>