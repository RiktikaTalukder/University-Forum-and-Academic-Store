<?php

include 'components/connect.php';
session_start();


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
   header('location: login.php');
   exit;
}
$user_id = $_SESSION['user_id'];

// Check if post ID exists
if (!isset($_GET['id'])) {
   header('location: my_posts.php');
   exit;
}
$post_id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

// Verify user owns this post
$check_owner = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND user_id = ?");
$check_owner->execute([$post_id, $user_id]);
if ($check_owner->rowCount() == 0) {
   header('location: my_posts.php');
   exit;
}

if (isset($_POST['save'])) {
   $post_id = $_GET['id'];
   $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
   $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
   $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

   // Remove category from the query
   $update_post = $conn->prepare("UPDATE `posts` SET title = ?, content = ?, status = ? WHERE id = ? AND user_id = ?");
   $update_post->execute([$title, $content, $status, $post_id, $user_id]);
   
   $message[] = 'Post updated!';

   $old_image = $_POST['old_image'];
   $image = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND user_id = ?");
   $select_image->execute([$image, $user_id]);

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'Image size is too large!';
      } elseif ($select_image->rowCount() > 0 && $image != '') {
         $message[] = 'Please rename your image!';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);
         $update_image = $conn->prepare("UPDATE `posts` SET image = ? WHERE id = ? AND user_id = ?");
         $update_image->execute([$image, $post_id, $user_id]);
         if ($old_image != $image && $old_image != '') {
            unlink('uploaded_img/' . $old_image);
         }
         $message[] = 'Image updated!';
      }
   }
}

if (isset($_POST['delete_post'])) {
   $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_STRING);

   $check_owner = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND user_id = ?");
   $check_owner->execute([$post_id, $user_id]);
   $fetch_delete_image = $check_owner->fetch(PDO::FETCH_ASSOC);

   if ($fetch_delete_image && $fetch_delete_image['image'] != '') {
      unlink('uploaded_img/' . $fetch_delete_image['image']);
   }

   $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ? AND user_id = ?");
   $delete_post->execute([$post_id, $user_id]);

   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
   $delete_comments->execute([$post_id]);

   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE post_id = ?");
   $delete_likes->execute([$post_id]);

   $message[] = 'Post deleted successfully!';
}

if (isset($_POST['delete_image'])) {
   $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_STRING);
   $empty_image = '';

   $select_post = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND user_id = ?");
   $select_post->execute([$post_id, $user_id]);
   $fetch_delete_image = $select_post->fetch(PDO::FETCH_ASSOC);

   if ($fetch_delete_image && $fetch_delete_image['image'] != '') {
      unlink('uploaded_img/' . $fetch_delete_image['image']);
   }

   $unset_image = $conn->prepare("UPDATE `posts` SET image = ? WHERE id = ? AND user_id = ?");
   $unset_image->execute([$empty_image, $post_id, $user_id]);

   $message[] = 'Image deleted successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Post</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- user css -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'user_profile_header.php'; ?>

   <section class="post-editor">

      <h1 class="heading">Edit Post</h1>

      <?php
      $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND user_id = ?");
      $select_posts->execute([$post_id, $user_id]);
      if ($select_posts->rowCount() > 0) {
         while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="edit_post.php?id=<?= $post_id ?>" method="post" enctype="multipart/form-data">
               <input type="hidden" name="old_image" value="<?= $fetch_posts['image']; ?>">
               <input type="hidden" name="post_id" value="<?= $fetch_posts['id']; ?>">

               <p>Post Status <span>*</span></p>
               <select name="status" class="box" required>
                  <option value="<?= $fetch_posts['status']; ?>" selected><?= $fetch_posts['status']; ?></option>
                  <option value="active">active</option>
                  <option value="deactive">deactive</option>
               </select>

               <p>Post Title <span>*</span></p>
               <input type="text" name="title" maxlength="100" required placeholder="Add post title" class="box" value="<?= $fetch_posts['title']; ?>">

               <p>Post Content <span>*</span></p>
               <textarea name="content" class="box" required maxlength="10000" placeholder="Write your content..." cols="30" rows="10"><?= $fetch_posts['content']; ?></textarea>

               <p>Post Image</p>
               <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">

               <?php if ($fetch_posts['image'] != '') { ?>
                  <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="image" alt="">
                  <input type="submit" value="Delete Image" class="inline-delete-btn" name="delete_image">
               <?php } ?>

               <div class="flex-btn">
                  <input type="submit" value="Save Post" name="save" class="btn">
                  <a href="my_posts.php" class="option-btn">Go Back</a>
                  <input type="submit" value="Delete Post" class="delete-btn" name="delete_post">
               </div>
            </form>
         <?php
         }
      } else {
         echo '<p class="empty">No posts found!</p>';
         ?>
         <div class="flex-btn">
            <a href="my_posts.php" class="option-btn">View Posts</a>
            <a href="add_post.php" class="option-btn">Add Post</a>
         </div>
      <?php
      }
      ?>

   </section>

   <!-- custom js -->
   <script src="../js/script.js"></script>

</body>

</html>