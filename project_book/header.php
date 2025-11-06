<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

// Get user data from session
$user_id = $_SESSION['user_id'] ?? null;
$username = $_SESSION['user_name'] ?? 'Guest';
$email = $_SESSION['user_email'] ?? '';

// Optional: connect to DB if needed for cart count
if (!isset($conn)) {
   include 'config.php'; // this sets $conn
}

// Handle messages
if (isset($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="../project_blog/home.php" class="blog-btn">Go to Blog</a>

         </div>
         <?php if (!$user_id): ?>
            <p> new <a href="/blogBook/project_blog/login.php">login</a> | <a href="/blogBook/project_blog/register.php">register</a> </p>
         <?php else: ?>
            <p> Welcome back, <strong><?php echo $username; ?></strong> </p>
         <?php endif; ?>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">
            <img src="images/logo.png" style="height: 50px; width: auto;">
         </a>

         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>
            <a href="orders.php">Orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <!--<a href="admin_page.php" class="fas fa-archive"></a> -->

            <?php
            // ✅ Show cart count correctly for both guests and logged-in users
            $cart_count = 0;
            if ($user_id) {
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_count = mysqli_num_rows($select_cart_number);
            } elseif (isset($_SESSION['cart'])) {
               foreach ($_SESSION['cart'] as $item) {
                  $cart_count += $item['quantity'];
               }
            }
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_count; ?>)</span> </a>
         </div>

         <?php if ($user_id): ?>
            <div class="user-box">
               <p>username : <span><?php echo $username; ?></span></p>
               <p>email : <span><?php echo $email; ?></span></p>
               <a href="logout.php" class="delete-btn">logout</a>
            </div>
         <?php endif; ?>
      </div>
   </div>

</header>
