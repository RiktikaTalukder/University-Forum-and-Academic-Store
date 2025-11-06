<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

// Delete functionality
if(isset($_GET['delete'])){
   $delete_type = $_GET['type'];
   $delete_id = $_GET['id'];
   
   switch($delete_type){
      case 'user':
         $delete = $conn->prepare("DELETE FROM `users` WHERE id = ?");
         break;
      case 'seller':
         $delete = $conn->prepare("DELETE FROM `sellers` WHERE id = ?");
         break;
      case 'post':
         $delete = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
         break;
      case 'comment':
         $delete = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
         break;
      case 'product':
         $delete = $conn->prepare("DELETE FROM `products` WHERE id = ?");
         break;
   }
   
   $delete->execute([$delete_id]);
   header('location:dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <!-- datatable css -->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">Admin Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Update Profile</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $total_users = $select_users->rowCount();
         ?>
         <h3><?= $total_users; ?></h3>
         <p>Total Users</p>
         <a href="#users-section" class="btn">View Users</a>
      </div>

      <div class="box">
         <?php
            $select_sellers = $conn->prepare("SELECT * FROM `seller`");
            $select_sellers->execute();
            $total_sellers = $select_sellers->rowCount();
         ?>
         <h3><?= $total_sellers; ?></h3>
         <p>Total Sellers</p>
         <a href="#sellers-section" class="btn">View Sellers</a>
      </div>

      <div class="box">
         <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts`");
            $select_posts->execute();
            $total_posts = $select_posts->rowCount();
         ?>
         <h3><?= $total_posts; ?></h3>
         <p>Total Posts</p>
         <a href="#posts-section" class="btn">View Posts</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $total_products = $select_products->rowCount();
         ?>
         <h3><?= $total_products; ?></h3>
         <p>Total Products</p>
         <a href="#products-section" class="btn">View Products</a>
      </div>

      <div class="box">
         <?php
            $select_comments = $conn->prepare("SELECT * FROM `comments`");
            $select_comments->execute();
            $total_comments = $select_comments->rowCount();
         ?>
         <h3><?= $total_comments; ?></h3>
         <p>Total Comments</p>
         <a href="#comments-section" class="btn">View Comments</a>
      </div>

   </div>

</section>

<!-- Data Tables Sections -->

<section class="data-tables">

   <!-- Users Section -->
   <div class="section" id="users-section">
      <h2 class="sub-heading">Registered Users</h2>
      <div class="table-container">
         <table id="users-table" class="display">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_users = $conn->prepare("SELECT * FROM `users`");
                  $select_users->execute();
                  while($fetch_user = $select_users->fetch(PDO::FETCH_ASSOC)){
               ?>
               <tr>
                  <td><?= $fetch_user['id']; ?></td>
                  <td><?= $fetch_user['name']; ?></td>
                  <td><?= $fetch_user['email']; ?></td>
                  
                  <td>
                     <a href="admin_dashboard.php?delete=1&type=user&id=<?= $fetch_user['id']; ?>" 
                        class="delete-btn" onclick="return confirm('Delete this user?');">
                        Delete
                     </a>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

   <!-- Sellers Section -->
   <div class="section" id="sellers-section">
      <h2 class="sub-heading">Registered Sellers</h2>
      <div class="table-container">
         <table id="sellers-table" class="display">
            <thead>
               <tr>
                  <th>Seller ID</th>
                  <th>Business Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_sellers = $conn->prepare("SELECT * FROM `seller`");
                  $select_sellers->execute();
                  while($fetch_seller = $select_sellers->fetch(PDO::FETCH_ASSOC)){
               ?>
               <tr>
                  <td><?= $fetch_seller['seller_id']; ?></td>
                  <td><?= $fetch_seller['name']; ?></td>
                  <td><?= $fetch_seller['email']; ?></td>
                  
                  <td>
                     <a href="admin_dashboard.php?delete=1&type=seller&id=<?= $fetch_seller['id']; ?>" 
                        class="delete-btn" onclick="return confirm('Delete this seller?');">
                        Delete
                     </a>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

   <!-- Posts Section -->
   <div class="section" id="posts-section">
      <h2 class="sub-heading">Posts</h2>
      <div class="table-container">
         <table id="posts-table" class="display">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Likes</th>
                  
                  
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_posts = $conn->prepare("SELECT p.*, u.name as author_name, 
                                                 (SELECT COUNT(*) FROM likes WHERE post_id = p.id) as like_count 
                                                 FROM `posts` p LEFT JOIN `users` u ON p.user_id = u.id");
                  $select_posts->execute();
                  while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){
               ?>
               <tr>
                  <td><?= $fetch_post['id']; ?></td>
                  <td><?= $fetch_post['title']; ?></td>
                  <td><?= $fetch_post['author_name']; ?></td>
                  <td><?= $fetch_post['like_count']; ?></td>
                  <td>
                     <a href="admin_dashboard.php?delete=1&type=post&id=<?= $fetch_post['id']; ?>" 
                        class="delete-btn" onclick="return confirm('Delete this post?');">
                        Delete
                     </a>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

   <!-- Products Section -->
   <div class="section" id="products-section">
      <h2 class="sub-heading">Products</h2>
      <div class="table-container">
         <table id="products-table" class="display">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Seller</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Added On</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_products = $conn->prepare("SELECT pr.*, s.name 
                                                    FROM `products` pr 
                                                    LEFT JOIN `seller` s ON pr.seller_id = s.id");
                  $select_products->execute();
                  while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
               ?>
               <tr>
                  <td><?= $fetch_product['id']; ?></td>
                  <td><?= $fetch_product['seller_id']; ?></td>
                  <td><?= $fetch_product['name']; ?></td>
                  
                  <td>$<?= $fetch_product['price']; ?></td>
                  
                  <td>
                     <a href="admin_dashboard.php?delete=1&type=product&id=<?= $fetch_product['id']; ?>" 
                        class="delete-btn" onclick="return confirm('Delete this product?');">
                        Delete
                     </a>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

   <!-- Comments Section -->
   <div class="section" id="comments-section">
      <h2 class="sub-heading">Comments</h2>
      <div class="table-container">
         <table id="comments-table" class="display">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Content</th>
                  <th>User</th>
                  <th>Post</th>
                  
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_comments = $conn->prepare("SELECT c.*, u.name as user_name, p.title as post_title 
                                                   FROM `comments` c 
                                                   LEFT JOIN `users` u ON c.user_id = u.id 
                                                   LEFT JOIN `posts` p ON c.post_id = p.id");
                  $select_comments->execute();
                  while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
               ?>
               <tr>
                  <td><?= $fetch_comment['id']; ?></td>
                  <td><?= substr($fetch_comment['comment'], 0, 50); ?>...</td>
                  <td><?= $fetch_comment['user_name']; ?></td>
                  <td><?= $fetch_comment['post_title']; ?></td>
                  
                  <td>
                     <a href="admin_dashboard.php?delete=1&type=comment&id=<?= $fetch_comment['id']; ?>" 
                        class="delete-btn" onclick="return confirm('Delete this comment?');">
                        Delete
                     </a>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

</section>

<!-- admin dashboard section ends -->

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#users-table').DataTable();
    $('#sellers-table').DataTable();
    $('#posts-table').DataTable();
    $('#products-table').DataTable();
    $('#comments-table').DataTable();
});
</script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>