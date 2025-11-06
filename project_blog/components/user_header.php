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

<!-- In your <head> section -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  
   .bookstore-btn {
      display: inline-block;
      padding: 12px 20px; 
      margin-left: 20px; 
      background-color: var(--purple); 
      color: white;
      border-radius: 5px;
      font-weight: 600;
      font-size: 1.1rem;
      text-decoration: none;
      transition: all 0.3s ease;
      height: auto; 
      line-height: 1.5;
      gap: 8px;
   }
   
   .bookstore-btn:hover {
      background-color: var(--black); 
      transform: translateY(-2px); 
   }
   
   .share {
      display: flex;
      align-items: center; 
      gap: 20px; 
   }

</style>

<header class="header">
   <section class="flex">
      <div class="share">
         <a href="home.php" class="logo">
            <img src="assets/img/logo.png" style="height: 50px; width: auto;">
         </a>
         <a href="../project_book/choose.php" class="bookstore-btn">
            <i class="fas fa-door-open"></i>
            <span>Marketplace</span>
         </a>
      </div>
      
      <form action="search.php" method="POST" class="search-form">
         <input type="text" name="search_box" class="box" maxlength="100" placeholder="Search for blogs" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         if (isset($user_id) && !empty($user_id)) {
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);

            if ($select_profile->rowCount() > 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
               <p class="name"><?= $fetch_profile['name']; ?></p>
               <a href="user_profile.php" class="btn">View Profile</a>
               <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
            <?php
            }
         } else {
            ?>
            <p class="name">please login first!</p>
            <div class="flex-btn">
               <a href="../project_blog/login.php" class="option-btn">Login</a>
               <a href="../project_blog/register.php" class="option-btn">Register</a>
            </div>
         <?php
         }
         ?>
      </div>
   </section>
</header>