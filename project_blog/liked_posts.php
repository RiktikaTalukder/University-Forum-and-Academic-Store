<?php

include 'components/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:home.php');
   exit;
}

$user_id = $_SESSION['user_id'];

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liked Posts</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/liked_post.css">
   
</head>
<body>

<body>

<div class="main-container">
   <?php include 'user_profile_header.php'; ?>

   <div class="content-area">
      <section class="liked-posts-container">

         <h1 class="heading">Your Liked Posts</h1>
         

         <div class="user-comments-container liked-posts-box-container">
            <!-- LOOP STARTS HERE -->
            <?php
            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $select_likes->execute([$user_id]);

            if ($select_likes->rowCount() > 0) {
               while ($fetch_likes = $select_likes->fetch(PDO::FETCH_ASSOC)) {
                  $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND status = 'active'");
                  $select_posts->execute([$fetch_likes['post_id']]);

                  if ($select_posts->rowCount() > 0) {
                     $fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC);
                     $post_id = $fetch_posts['id'];

                     $count_post_comments = $conn->prepare("SELECT COUNT(*) FROM `comments` WHERE post_id = ?");
                     $count_post_comments->execute([$post_id]);
                     $total_post_comments = $count_post_comments->fetchColumn();

                     $count_post_likes = $conn->prepare("SELECT COUNT(*) FROM `likes` WHERE post_id = ?");
                     $count_post_likes->execute([$post_id]);
                     $total_post_likes = $count_post_likes->fetchColumn();

                     $confirm_like = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
                     $confirm_like->execute([$user_id, $post_id]);
            ?>
            <div class="show-comments">
               <div class="post-title">
                  <span><?= $fetch_posts['title']; ?></span>
                  <a href="view_post.php?post_id=<?= $post_id; ?>">view post</a>
               </div>

               <?php if ($fetch_posts['image'] != '') { ?>
                  <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="" style="max-width: 100%; height: auto; margin-top: 1rem;">
               <?php } ?>

               <div class="comment-box"><?= $fetch_posts['content']; ?></div>

               <form method="post" class="flex-btn">
                  <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                  <input type="hidden" name="user_id" value="<?= $fetch_posts['user_id']; ?>">
                  <button type="submit" name="like_post" class="inline-btn">
                     <i class="fas fa-heart" style="<?= $confirm_like->rowCount() > 0 ? 'color:red;' : ''; ?>"></i>
                     <span>(<?= $total_post_likes; ?>)</span>
                  </button>
                  <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-option-btn">
                     <i class="fas fa-comment"></i>
                     <span>(<?= $total_post_comments; ?>)</span>
                  </a>
               </form>
            </div>
            <?php
                  }
               }
            } else {
               echo '<p class="empty">You haven\'t liked any posts yet!</p>';
            }
            ?>
         </div>

      </section>
   </div>
</div>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>

</body>

</html>
