<?php
session_start();
include 'config.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
   header('location:/blogBook/project_blog/login.php');
   exit;
}

// Fetch cart items from database
$cart_items = [];
$grand_total = 0;
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed: ' . mysqli_error($conn));
if (mysqli_num_rows($select_cart) > 0) {
   while ($row = mysqli_fetch_assoc($select_cart)) {
      $cart_items[] = $row;
      $grand_total += $row['quantity'] * $row['price'];
   }
}

if (isset($_POST['place_order'])) {
   // Validate inputs
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pickup_time = mysqli_real_escape_string($conn, $_POST['pickup_time']);
   $pickup_place = mysqli_real_escape_string($conn, $_POST['pickup_place']);

   // Validate IIUC email
   if (!preg_match('/@ugrad\.iiuc\.ac\.bd$/', $email)) {
      $message[] = 'Please use your IIUC provided email (must end with @iiuc.ac.bd)';
   }
   // Validate pickup time (8:00AM - 4:00PM)
   elseif (!preg_match('/^(8|9|10|11|12|1|2|3):[0-5][0-9](AM|PM)$/', $pickup_time)) {
      $message[] = 'Pickup time must be between 8:00AM and 4:00PM';
   }
   // Validate pickup place contains "IIUC"
   elseif (stripos($pickup_place, 'IIUC') === false) {
      $message[] = 'Pickup place must be inside IIUC premises';
   } else {
      // Process the order
      $placed_on = date('d-M-Y');
      $method = 'Cash on delivery';
      $payment_status = 'pending';

      // Group cart items by seller
      $orders_by_seller = [];
      foreach ($cart_items as $item) {
          $orders_by_seller[$item['seller_id']][] = $item;
      }

      // Start transaction
      mysqli_begin_transaction($conn);

      try {
          // Process each seller's items as a separate order
          foreach ($orders_by_seller as $seller_id => $seller_items) {
              // Calculate total for this seller's items
              $seller_total = 0;
              $product_names = [];
              $product_ids = [];
              
              foreach ($seller_items as $item) {
                  $product_names[] = $item['name'] . " (x" . $item['quantity'] . ")";
                  $product_ids[] = $item['product_id'];
                  $seller_total += $item['quantity'] * $item['price'];
              }
              
              $total_products = implode(', ', $product_names);
              $first_product_id = $product_ids[0]; // For reference

              // Insert order for this seller
              $insert_order = mysqli_query($conn, "INSERT INTO `orders`(
                  user_id, 
                  seller_id, 
                  product_id, 
                  name, 
                  number, 
                  email, 
                  method, 
                  total_products, 
                  total_price, 
                  placed_on, 
                  payment_status,
                  pickup_time,
                  pickup_place
              ) VALUES(
                  '$user_id',
                  '$seller_id',
                  '$first_product_id',
                  '$name',
                  '$number',
                  '$email',
                  '$method',
                  '$total_products',
                  '$seller_total',
                  '$placed_on',
                  '$payment_status',
                  '$pickup_time',
                  '$pickup_place'
              )") or throw new Exception('Error inserting order: ' . mysqli_error($conn));
          }

          // Clear the cart
          mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or throw new Exception('Error clearing cart: ' . mysqli_error($conn));

          // Commit transaction
          mysqli_commit($conn);

          $_SESSION['message'] = 'Order placed successfully!';
          header('location:orders.php');
          exit;
          
      } catch (Exception $e) {
          // Rollback transaction on error
          mysqli_rollback($conn);
          $message[] = 'Error processing order: ' . $e->getMessage();
      }
   }
}
?>


<!-- Rest of your HTML form remains the same -->

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>


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


   <style>
      .checkout .order-section {
         margin-bottom: 3rem;
         padding: 2rem;
         background-color: var(--white);
         border-radius: .5rem;
         box-shadow: var(--box-shadow);
         border: var(--border);
      }

      .checkout .order-section h3 {
         font-size: 2.2rem;
         color: var(--black);
         margin-bottom: 1.5rem;
         padding-bottom: 1rem;
         border-bottom: var(--border);
         text-transform: uppercase;
      }

      .checkout .order-item {
         margin-bottom: 1.5rem;
         padding-bottom: 1.5rem;
         border-bottom: 1px solid #eee;
      }

      .checkout .order-item:last-child {
         border-bottom: none;
      }

      .checkout .order-item span {
         display: block;
         font-size: 1.7rem;
         color: var(--light-color);
         margin-bottom: .5rem;
      }

      .checkout .order-item input {
         width: 100%;
         padding: 1.2rem 1.4rem;
         font-size: 1.7rem;
         color: var(--black);
         background-color: var(--light-bg);
         border: var(--border);
         border-radius: .5rem;
         margin-bottom: 1rem;
      }

      .checkout .order-item input[readonly] {
         background-color: #f9f9f9;
         color: var(--light-color);
      }

      .checkout .order-summary {
         margin-top: 3rem;
         padding: 2rem;
         background-color: var(--white);
         border-radius: .5rem;
         box-shadow: var(--box-shadow);
         border: var(--border);
      }

      .checkout .order-summary h3 {
         font-size: 2.2rem;
         color: var(--black);
         margin-bottom: 1.5rem;
         padding-bottom: 1rem;
         border-bottom: var(--border);
         text-transform: uppercase;
      }

      .checkout .order-summary .grand-total {
         font-size: 2rem;
         color: var(--black);
         margin-top: 2rem;
         padding-top: 1rem;
         border-top: var(--border);
      }

      .checkout .order-summary .grand-total span {
         color: var(--purple);
         font-weight: bold;
      }

      .checkout small {
         display: block;
         font-size: 1.4rem;
         color: var(--light-color);
         margin-top: -.5rem;
         margin-bottom: 1rem;
      }
   </style>
</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>checkout</h3>
      <p> <a href="home.php">home</a> / checkout </p>
   </div>

   <section class="checkout">

      <form action="" method="post">
         <h1 class="title">Confirm Your Purchase</h1>

         <div class="flex">
            <!-- Seller and Product Information -->
            <div class="order-section">
               <h3>---Product Information---</h3>
               <?php if (!empty($cart_items)): ?>
                  <?php foreach ($cart_items as $item): ?>
                     <div class="order-item">
                        <span>Seller ID:</span>
                        <input type="text" value="<?php echo $item['seller_id']; ?>" readonly>

                        <span>Product ID:</span>
                        <input type="text" value="<?php echo $item['product_id']; ?>" readonly>

                        <span>Product Name:</span>
                        <input type="text" value="<?php echo $item['name']; ?>" readonly>
                     </div>
                  <?php endforeach; ?>
               <?php else: ?>
                  <p class="empty">your cart is empty!</p>
               <?php endif; ?>
            </div>

            <!-- Student Information -->
            <div class="order-section">
               <h3>---Your Information---</h3>
               <div class="order-item">
                  <span>Your name:</span>
                  <input type="text" name="name" required placeholder="enter your name">

                  <!--<span>Student ID:</span>
               <input type="text" name="student_ID" required placeholder="e.g. C162230"> -->

                  <span>Your number:</span>
                  <input type="number" name="number" required placeholder="enter your number">

                  <span>Your email:</span>
                  <input type="email" name="email" required placeholder="email provided by IIUC">
                  <small>(Must end with @iiuc.ac.bd)</small>
               </div>
            </div>

            <!-- Pickup Information -->
            <div class="order-section">
               <h3>----Pickup Information----</h3>
               <div class="order-item">
                  <span>Payment method:</span>
                  <input type="text" value="Cash on delivery" readonly>

                  <span>Possible pick-up time:</span>
                  <input type="text" name="pickup_time" required placeholder="must be from 8:00AM - 4:00 PM">
                  <small>(Format: 9:00AM or 2:30PM)</small>

                  <span>Possible pick-up place:</span>
                  <select name="pickup_place" required class="form-select">
                     <option value="">Select a pickup location</option>
                     <option value="IIUC Main Gate">IIUC Main Gate</option>
                     <option value="IIUC Cafeteria">IIUC Cafeteria</option>
                     <option value="IIUC Library">IIUC Library</option>
                     <option value="IIUC Admin Building">IIUC Admin Building</option>
                     <option value="IIUC Female Campus">IIUC Computer Lab</option>
                  </select>
               </div>
            </div>
         </div>



         <input type="submit" value="Order Now" name="place_order" class="btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>" style="width: 100%; margin-top: 2rem;">
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>