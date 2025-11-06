<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">Admin Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $total_orders = $select_orders->rowCount();
            
            $pending_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'pending'");
            $pending_orders->execute();
            $total_pending = $pending_orders->rowCount();
         ?>
         <h3><?= $total_orders; ?></h3>
         <p>Total Orders</p>
         
         <a href="view_orders.php" class="btn">View Orders</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $total_users = $select_users->rowCount();
         ?>
         <h3><?= $total_users; ?></h3>
         <p>Total Users</p>
         <a href="view_users.php" class="btn">View Users</a>
      </div>

      <div class="box">
         <?php
            $select_sellers = $conn->prepare("SELECT * FROM `seller`");
            $select_sellers->execute();
            $total_sellers = $select_sellers->rowCount();
         ?>
         <h3><?= $total_sellers; ?></h3>
         <p>Total Sellers</p>
         <a href="view_sellers.php" class="btn">View Sellers</a>
      </div>

      <div class="box">
         <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts`");
            $select_posts->execute();
            $total_posts = $select_posts->rowCount();
         ?>
         <h3><?= $total_posts; ?></h3>
         <p>Total Posts</p>
         <a href="view_posts.php" class="btn">View Posts</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $total_products = $select_products->rowCount();
         ?>
         <h3><?= $total_products; ?></h3>
         <p>Total Products</p>
         <a href="view_products.php" class="btn">View Products</a>
      </div>

      <div class="box">
         <?php
            $select_comments = $conn->prepare("SELECT * FROM `comments`");
            $select_comments->execute();
            $total_comments = $select_comments->rowCount();
         ?>
         <h3><?= $total_comments; ?></h3>
         <p>Total Comments</p>
         <a href="view_comments.php" class="btn">View Comments</a>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>