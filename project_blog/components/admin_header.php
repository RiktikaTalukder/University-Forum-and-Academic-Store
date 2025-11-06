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

   <a href="home.php" class="logo">admin<span>Panel</span></a>

   <div class="profile">
      <?php
         
         include 'connect.php';

         $admin_id = $_SESSION['admin_id'] ?? null;

         if (!$admin_id) {
            header('location:../project_blog/login.php');
            exit;
         }

         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">Update Profile</a>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>Home</span></a>
      <a href="../components/admin_logout.php" style="color:var(--red);" onclick="return confirm('Logout from the website?');"><i class="fas fa-right-from-bracket"></i><span>Logout</span></a>
   </nav>


</header>

<div id="menu-btn" class="fas fa-bars"></div>
