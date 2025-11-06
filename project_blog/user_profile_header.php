<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <a href="home.php" class="logo">User<span>Panel</span></a>

   <div class="profile">
      <?php
         
         include 'components/connect.php';

         $user_id = $_SESSION['user_id'] ?? null;

         if (!$user_id) {
            header('location:../project_book/login.php');
            exit;
         }

         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update.php" class="btn">Update Profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i> <span>Home</span></a>
      <a href="user_add_posts.php"><i class="fas fa-pen"></i> <span>Add Post</span></a>
      <a href="my_posts.php"><i class="fas fa-eye"></i> <span>View Posts</span></a>
      <a href="components/user_logout.php" style="color:var(--red);" onclick="return confirm('Logout from the website?');"><i class="fas fa-right-from-bracket"></i><span>Logout</span></a>
   </nav>

</header>

<div id="menu-btn" class="fas fa-bars"></div>
