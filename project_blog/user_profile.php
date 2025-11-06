<?php


include 'components/connect.php';

session_start();


if (!isset($_SESSION['user_id'])) {
   header('location: login.php');
   exit;
}
$user_id = $_SESSION['user_id'];

$count_comments_on_my_posts = $conn->prepare("
   SELECT COUNT(*) FROM comments 
   WHERE post_id IN (SELECT id FROM posts WHERE user_id = ?) AND user_id != ?
");
$count_comments_on_my_posts->execute([$user_id, $user_id]);
$total = $count_comments_on_my_posts->fetchColumn();



// Optional: fetch user profile if needed
$fetch_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$fetch_profile->execute([$user_id]);
$fetch_profile = $fetch_profile->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include 'user_profile_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">Your Profile</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update.php" class="btn">Update Profile</a>
      </div>

      <div class="box">
         <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ?");
            $select_posts->execute([$user_id]);
            $numbers_of_posts = $select_posts->rowCount();
         ?>
         <h3><?= $numbers_of_posts; ?></h3>
         <p>Your Posts</p>
         <a href="user_add_posts.php" class="btn">Add New Post</a>
      </div>

      <div class="box">
         <?php
            $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ? AND status = ?");
            $select_active_posts->execute([$user_id, 'active']);
            $numbers_of_active_posts = $select_active_posts->rowCount();
         ?>
         <h3><?= $numbers_of_active_posts; ?></h3>
         <p>Active Posts</p>
         <a href="my_posts.php" class="btn">See Posts</a>
      </div>

      <div class="box">
         <?php
            $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
            $select_comments->execute([$user_id]);
            $numbers_of_comments = $select_comments->rowCount();
         ?>
         <h3><?= $numbers_of_comments; ?></h3>
         <p>Your Comments</p>
         <a href="user_comments.php" class="btn">See Comments</a>
      </div>

      <div class="box">
         <?php
            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $select_likes->execute([$user_id]);
            $numbers_of_likes = $select_likes->rowCount();
         ?>
         <h3><?= $numbers_of_likes; ?></h3>
         <p>Posts You've Liked</p>
         <a href="liked_posts.php" class="btn">See Liked</a>
      </div>

      <div class="box">
         <?php
            $count_comments_on_my_posts = $conn->prepare("
               SELECT COUNT(*) FROM comments 
               WHERE post_id IN (SELECT id FROM posts WHERE user_id = ?) AND user_id != ?
            ");
            $count_comments_on_my_posts->execute([$user_id, $user_id]);
            $total_others_comments = $count_comments_on_my_posts->fetchColumn();
         ?>
         <h3><?= $total_others_comments; ?></h3>
         <p>Others' Comments</p>
         <a href="my_comments.php" class="btn">See Comments</a>
      </div>



   </div>

</section>

<!-- custom js file link -->
<script src="../js/script.js"></script>

</body>
</html>
