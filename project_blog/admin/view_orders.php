<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_status'])){
   $order_id = $_POST['order_id'];
   $status = $_POST['status'];
   
   $update_status = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
   $update_status->execute([$status, $order_id]);
   
   $message[] = 'Order status updated!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->

     <style>
   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap');

   * {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
   }

   body {
      background-color: #f4f4f4;
   }

   .orders {
      padding: 2rem;
      max-width: 1200px;
      margin: auto;
   }

   .heading {
      font-size: 2.2rem;
      color: #333;
      text-align: center;
      margin-bottom: 2rem;
   }

   .home-btn {
         display: inline-block;
         margin-bottom: 2rem;
         background-color: #5e35b1;
         color: white;
         padding: 0.7rem 1.5rem;
         border-radius: 6px;
         text-decoration: none;
         font-size: 1rem;
         transition: all 0.3s ease;
      }

      .home-btn:hover {
         background-color: #4527a0;
         transform: translateY(-2px);
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         text-decoration: none;
      }

      .home-btn i {
         margin-right: 8px;
      }

   .box-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 1.5rem;
   }

   .box {
      background: #fff;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s;
   }

   .box:hover {
      transform: translateY(-3px);
   }

   .box p {
      font-size: 1rem;
      margin: 0.6rem 0;
      color: #555;
   }

   .box span {
      color: #111;
      font-weight: 500;
   }

   .drop-down {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 0.5rem;
      font-size: 1rem;
      background-color: #f9f9f9;
   }

   .btn {
      background-color: #5e35b1;
      color: white;
      padding: 0.6rem 1.2rem;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-size: 0.95rem;
      transition: background-color 0.3s ease;
      cursor: pointer;
      display: inline-block;
      margin-top: 1rem;
   }

   .btn:hover {
      background-color: #4527a0;
   }

   .empty {
      text-align: center;
      font-size: 1.1rem;
      color: #999;
      margin-top: 2rem;
   }

   form {
      margin-top: 0.5rem;
   }

   @media (max-width: 600px) {
      .box p {
         font-size: 0.95rem;
      }

      .drop-down, .btn {
         font-size: 0.9rem;
      }
   }
   </style>

</head>
<body>


</head>
<body>


<!-- orders section starts  -->

<section class="orders">
    <a href="dashboard.php" class="home-btn">
      <i class="fas fa-home"></i> Back to Home
   </a>

   <h1 class="heading">Placed Orders</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY placed_on DESC");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <p>Order ID: <span><?= $fetch_order['id']; ?></span></p>
         <p>Placed On: <span><?= $fetch_order['placed_on']; ?></span></p>
         <p>Name: <span><?= $fetch_order['name']; ?></span></p>
         <p>Email: <span><?= $fetch_order['email']; ?></span></p>
         
         <p>Address: <span><?= $fetch_order['pickup_place']; ?></span></p>
         <p>Payment Method: <span><?= $fetch_order['method']; ?></span></p>
         <p>Total Products: <span><?= $fetch_order['total_products']; ?></span></p>
         <p>Total Price: <span>$<?= $fetch_order['total_price']; ?></span></p>
         <p>Status: 
            <form action="" method="post">
               <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
               <select name="status" class="drop-down">
                  <option value="pending" <?= $fetch_order['payment_status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                  
               </select>
            </form>
         </p>
         
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>

   </div>

</section>

<!-- orders section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>