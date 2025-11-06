<?php
session_start();
include 'config.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    // Logged in: fetch cart from DB
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    $cart_items = [];
    while($row = mysqli_fetch_assoc($select_cart)) {
        $cart_items[] = $row;
    }
} else {
    // Guest user: fetch cart from session
    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}

// Now handle update_cart, delete, delete_all for logged in users and guests

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    if ($user_id) {
        // update DB cart
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id' AND user_id = '$user_id'") or die('query failed');
    } else {
        // update session cart
        if(isset($_SESSION['cart'][$cart_id])) {
            $_SESSION['cart'][$cart_id]['quantity'] = $cart_quantity;
        }
    }
    $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    if ($user_id) {
        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id' AND user_id = '$user_id'") or die('query failed');
    } else {
        unset($_SESSION['cart'][$delete_id]);
    }
    header('location:cart.php');
    exit;
}

if(isset($_GET['delete_all'])){
    if ($user_id) {
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    } else {
        unset($_SESSION['cart']);
    }
    header('location:cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

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
   <h3>shopping cart</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Added Resources</h1>

   <div class="box-container">
      <?php
      $grand_total = 0;

      if ($user_id) {
          // Fetch from database
          $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select_cart) > 0){
              while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $sub_total = $fetch_cart['quantity'] * $fetch_cart['price'];
                  $grand_total += $sub_total;
                  ?>
                  <div class="box">
                      <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
                      <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                      <div class="name"><?php echo $fetch_cart['name']; ?></div>
                      <div class="price">৳<?php echo $fetch_cart['price']; ?>/-</div>
                      <div class="seller-id">Seller ID: <?php echo $fetch_cart['seller_id']; ?></div>
                      <form action="" method="post">
                          <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                          <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                          <input type="submit" name="update_cart" value="update" class="option-btn">
                      </form>
                      <div class="sub-total"> Subtotal : <span>৳<?php echo $sub_total; ?>/-</span> </div>
                  </div>
                  <?php
              }
          } else {
              echo '<p class="empty">your cart is empty</p>';
          }
      } else {
          // Guest cart from session
          if (!empty($_SESSION['cart'])) {
              foreach($_SESSION['cart'] as $id => $item){
                  $sub_total = $item['quantity'] * $item['price'];
                  $grand_total += $sub_total;
                  ?>
                  <div class="box">
                      <a href="cart.php?delete=<?php echo $id; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
                      <img src="uploaded_img/<?php echo $item['image']; ?>" alt="">
                      <div class="name"><?php echo $item['name']; ?></div>
                      <div class="price">$<?php echo $item['price']; ?>/-</div>
                      <div class="seller-id">Seller ID: <?php echo $item['seller_id'] ?? 'N/A'; ?></div>
                      <form action="" method="post">
                          <input type="hidden" name="cart_id" value="<?php echo $id; ?>">
                          <input type="number" min="1" name="cart_quantity" value="<?php echo $item['quantity']; ?>">
                          <input type="submit" name="update_cart" value="update" class="option-btn">
                      </form>
                      <div class="sub-total"> sub total : <span>৳<?php echo $sub_total; ?>/-</span> </div>
                  </div>
                  <?php
              }
          } else {
              echo '<p class="empty">your cart is empty</p>';
          }
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>৳<?php echo $grand_total; ?>/-</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">continue shopping</a>
         <!-- Check login before proceeding -->
         <?php if($grand_total > 0): ?>
            <a href="<?php echo ($user_id) ? 'checkout.php' : '/blogBook/project_blog/login.php?redirect=checkout.php'; ?>" class="btn">proceed to checkout</a>
         <?php else: ?>
            <a href="#" class="btn disabled">proceed to checkout</a>
         <?php endif; ?>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
