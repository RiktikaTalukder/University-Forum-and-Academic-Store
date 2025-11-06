<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/like_post.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UniHub Forum</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <style>
      .welcome-section {
         padding: 2rem;
         max-width: 1200px;
         margin: 0 auto;
      }

      .create-post-container {
         text-align: right;
         margin-bottom: 2rem;
      }

      .create-post-btn {
         display: inline-flex;
         align-items: center;
         gap: 0.5rem;
         padding: 1rem 2rem;
         background-color: var(--purple);
         /* Changed from --main-color */
         color: var(--white);
         border-radius: 0.5rem;
         font-size: 1.6rem;
         transition: all 0.3s ease;
         box-shadow: var(--box-shadow);
      }

      .create-post-btn:hover {
         background-color: var(--black);
         transform: translateY(-2px);
      }

      .welcome-box {
         background-color: var(--white);
         border-radius: 0.8rem;
         padding: 3rem;
         box-shadow: var(--box-shadow);
         border: var(--border);
      }

      .welcome-header h3 {
         font-size: 2.4rem;
         color: var(--black);
         margin-bottom: 0.5rem;
      }

      .welcome-header h3 span {
         color: var(--purple);
         /* Changed from --main-color */
      }

      .welcome-subtext {
         font-size: 1.6rem;
         color: var(--light-color);
         margin-bottom: 2rem;
      }

      .stats-container {
         display: flex;
         gap: 2rem;
         margin: 2rem 0;
      }

      .stat-item {
         display: flex;
         align-items: center;
         gap: 1rem;
         background-color: var(--light-bg);
         padding: 1.5rem;
         border-radius: 0.5rem;
         flex: 1;
         border: var(--border);
      }

      .stat-item i {
         font-size: 2.5rem;
         color: var(--purple);
         /* Changed from --main-color */
      }

      .stat-number {
         font-size: 2rem;
         font-weight: bold;
         color: var(--black);
         display: block;
      }

      .stat-label {
         font-size: 1.4rem;
         color: var(--light-color);
      }

      .action-buttons {
         margin-top: 2rem;
      }

      .profile-btn {
         display: inline-flex;
         align-items: center;
         gap: 0.5rem;
         padding: 1rem 2rem;
         background-color: var(--purple);
         /* Changed from --main-color */
         color: var(--white);
         border-radius: 0.5rem;
         font-size: 1.6rem;
         margin-bottom: 1.5rem;
         transition: all 0.3s ease;
      }

      .profile-btn:hover {
         background-color: var(--black);
      }

      .guest-welcome {
         text-align: center;
         padding: 2rem;
      }

      .guest-welcome h3 {
         font-size: 2.4rem;
         color: var(--black);
         margin-bottom: 1rem;
      }

      .guest-welcome p {
         font-size: 1.6rem;
         color: var(--light-color);
         margin-bottom: 2rem;
      }

      .flex-btn {
         display: flex;
         gap: 1rem;
         justify-content: center;
      }

      .option-btn {
         display: inline-flex;
         align-items: center;
         gap: 0.5rem;
      }

      @media (max-width: 768px) {
         .stats-container {
            flex-direction: column;
         }

         .flex-btn {
            flex-direction: column;
         }
      }
   </style>
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="welcome-section">
      <?php if (isset($_SESSION['user_id'])): ?>
         <div class="create-post-container">
            <a href="user_add_posts.php" class="create-post-btn">
               <i class="fas fa-plus"></i> Create New Discussion
            </a>
         </div>
      <?php endif; ?>

      <div class="home-grid">
         <div class="box-container">
            <div class="welcome-box">
               <?php
               $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_profile->execute([$user_id]);
               if ($select_profile->rowCount() > 0) {
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                  $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
                  $count_user_comments->execute([$user_id]);
                  $total_user_comments = $count_user_comments->rowCount();
                  $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
                  $count_user_likes->execute([$user_id]);
                  $total_user_likes = $count_user_likes->rowCount();
               ?>
                  <div class="welcome-header">
                     <h3>Welcome to UniHub <span><?= $fetch_profile['name']; ?></span>!</h3>
                     <p class="welcome-subtext">Here's your community engagement summary</p>
                  </div>

                  <div class="stats-container">
                     <div class="stat-item">
                        <i class="fas fa-comment"></i>
                        <div>
                           <span class="stat-number"><?= $total_user_comments; ?></span>
                           <span class="stat-label">Comments</span>
                        </div>
                     </div>

                     <div class="stat-item">
                        <i class="fas fa-heart"></i>
                        <div>
                           <span class="stat-number"><?= $total_user_likes; ?></span>
                           <span class="stat-label">Likes</span>
                        </div>
                     </div>
                  </div>

               <?php
               } else {
               ?>
                  <div class="guest-welcome">
                     <h3>Welcome to UniHub - IIUC's Academic Community</h3>
                     <p>Join your university forum to connect, discuss and share resources</p>
                     <div class="flex-btn">
                        <a href="login.php" class="option-btn">
                           <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="register.php" class="option-btn">
                           <i class="fas fa-user-plus"></i> Register
                        </a>
                     </div>
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </section>

   <section class="posts-container">

      <h1 class="heading">latest posts</h1>

      <div class="box-container">

         <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? LIMIT 6 ");
         $select_posts->execute(['active']);
         if ($select_posts->rowCount() > 0) {
            while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {

               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount();

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

               $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
               $confirm_likes->execute([$user_id, $post_id]);
         ?>
               <form class="box" method="post">
                  <input type="hidden" name="post_id" value="<?= $post_id; ?>">

                  <div class="post-admin">
                     <i class="fas fa-user"></i>
                     <div>
                        <a href="author_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a>
                        <div><?= $fetch_posts['date']; ?></div>
                     </div>
                  </div>

                  <?php
                  if ($fetch_posts['image'] != '') {
                  ?>
                     <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
                  <?php
                  }
                  ?>
                  <div class="post-title"><?= $fetch_posts['title']; ?></div>
                  <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
                  <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">read more</a>

                  <div class="icons">
                     <a href="view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
                     <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if ($confirm_likes->rowCount() > 0) {
                                                                                                echo 'color:var(--red);';
                                                                                             } ?>  "></i><span>(<?= $total_post_likes; ?>)</span></button>
                  </div>

               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no posts added yet!</p>';
         }
         ?>
      </div>

      <div class="more-btn" style="text-align: center; margin-top:1rem;">
         <a href="posts.php" class="inline-btn">view all posts</a>
      </div>

   </section>



















   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>