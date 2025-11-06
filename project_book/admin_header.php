<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="seller_page.php" class="logo">Seller<span>Panel</span></a>

      <nav class="navbar">
         <a href="seller_page.php">home</a>
         <a href="seller_products.php">products</a>
         <a href="seller_orders.php">orders</a>
         <!-- <a href="admin_users.php">users</a> -->
         <a href="seller_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <?php if (isset($_SESSION['seller_name']) && isset($_SESSION['seller_id'])): ?>
            <p>username : <span><?php echo $_SESSION['seller_name']; ?></span></p>
            <p>Seller ID : <span><?php echo $_SESSION['seller_id']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         <?php else: ?>
            <div>new <a href="/blogBook/project_blog/login.php">login</a> | <a href="/blogBook/project_blog/register.php">register</a></div>
         <?php endif; ?>
      </div>

   </div>

</header>

<script>
   let userBtn = document.querySelector('#user-btn');
   let accountBox = document.querySelector('.account-box');

   userBtn.onclick = () => {
      accountBox.classList.toggle('active');
   }

   // Optional: Close account box if you click anywhere else
   document.addEventListener('click', function(e) {
      if (!accountBox.contains(e.target) && !userBtn.contains(e.target)) {
         accountBox.classList.remove('active');
      }
   });
</script>