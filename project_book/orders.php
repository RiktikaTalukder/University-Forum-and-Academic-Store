<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:/blogBook/project_blog/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

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
   <h3>your orders</h3>
   <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-orders">
   <h1 class="title">order history</h1>
   <div class="box-container">
      <?php
         $order_query = mysqli_query($conn, "
            SELECT o.*, 
                   p.name AS product_name, 
                   s.name AS seller_name 
            FROM `orders` o
            JOIN `products` p ON o.product_id = p.id
            JOIN `seller` s ON o.seller_id = s.seller_id
            WHERE o.user_id = '$user_id'
         ") or die('query failed');

         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Product : <span><?php echo $fetch_orders['product_name']; ?></span> </p>
         <p> Seller : <span><?php echo $fetch_orders['seller_name']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Collection Time : <span><?php echo $fetch_orders['pickup_time']; ?></span> </p>
         <p> Collection Point : <span><?php echo $fetch_orders['pickup_place']; ?></span> </p>
         <p> Payment Method : <span><?php echo ucfirst($fetch_orders['method']); ?></span> </p>
         <p> Items : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total Amount : <span>৳<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no orders placed yet!</p>';
         }
      ?>
   </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>