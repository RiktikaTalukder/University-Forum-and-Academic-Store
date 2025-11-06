<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:../project_book/login.php');
   exit;
}

if (isset($_POST['delete_comment'])) {
   $comment_id = filter_var($_POST['comment_id'], FILTER_SANITIZE_STRING);

   // Make sure the comment belongs to the user's post
   $check = $conn->prepare("SELECT c.id FROM comments c 
                            JOIN posts p ON c.post_id = p.id 
                            WHERE c.id = ? AND p.user_id = ?");
   $check->execute([$comment_id, $user_id]);

   if ($check->rowCount() > 0) {
      $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
      $delete_comment->execute([$comment_id]);
      $message[] = 'Comment deleted!';
   } else {
      $message[] = 'Unauthorized deletion attempt!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Comments</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- user style -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'user_profile_header.php'; ?>

<section class="comments">

   <h1 class="heading">Post Comments</h1>
   <p class="comment-title">Comments on your posts</p>

   <div class="box-container">
   <?php
   $select_comments = $conn->prepare("SELECT c.* FROM comments c 
                                      JOIN posts p ON c.post_id = p.id 
                                      WHERE p.user_id = ?");
   $select_comments->execute([$user_id]);

   if ($select_comments->rowCount() > 0) {
      while ($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)) {
   ?>
      <?php
      $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
      $select_posts->execute([$fetch_comments['post_id']]);
      while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
      ?>
         <div class="post-title">
            from: <span><?= $fetch_posts['title']; ?></span>
            <a href="my_posts.php?post_id=<?= $fetch_posts['id']; ?>">view post</a>
         </div>
      <?php } ?>

      <div class="box">
         <div class="user">
            <i class="fas fa-user"></i>
            <div class="user-info">
               <span><?= $fetch_comments['user_name']; ?></span>
               <div><?= $fetch_comments['date']; ?></div>
            </div>
         </div>
         <div class="text"><?= $fetch_comments['comment']; ?></div>
         <form action="" method="POST">
            <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
            <button type="submit" class="inline-delete-btn" name="delete_comment" onclick="return confirm('Delete this comment?');">delete comment</button>
         </form>
      </div>

   <?php
      }
   } else {
      echo '<p class="empty">No comments on your posts yet!</p>';
   }
   ?>
   </div>

</section>

<!-- user js -->
<script src="../js/script.js"></script>

</body>
</html>
