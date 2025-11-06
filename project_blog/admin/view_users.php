<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete->execute([$delete_id]);
   header('location:view_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Users</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
   
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

   <style>
     /* Container styling */

     @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap');

* {
   font-family: 'Montserrat', sans-serif;
}


     
.accounts {
   padding: 2rem;
   max-width: 1200px;
   margin: 0 auto;
}

.accounts .heading {
   font-size: 2.2rem;
   margin-bottom: 2rem;
   color: #333;
   text-align: center;
}

/* Table styling */
#users-table {
   width: 100%;
   border-collapse: collapse;
   background: #fff;
   box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
   border-radius: 10px;
   overflow: hidden;
}

#users-table thead {
   background-color: #5e35b1;
   color: white;
}

#users-table th, #users-table td {
   padding: 1rem;
   text-align: left;
   font-size: 1rem;
}

#users-table tbody tr {
   border-bottom: 1px solid #eee;
}

#users-table tbody tr:hover {
   background-color: #f9f9f9;
}

.home-btn {
         display: inline-block;
         margin-bottom: 2rem;
         background-color: #5e35b1;
         color: white;
         padding: 0.7rem 1.5rem;
         border-radius: 6px;
         text-decoration: none;
         font-size: 1rem;
         transition: all 0.3s ease;
      }

      .home-btn:hover {
         background-color: #4527a0;
         transform: translateY(-2px);
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         text-decoration: none;
      }

      .home-btn i {
         margin-right: 8px;
      }

/* Delete button styling */
.delete-btn {
   background-color: #f44336;
   color: white;
   padding: 0.5rem 1rem;
   border: none;
   border-radius: 6px;
   text-decoration: none;
   font-size: 0.95rem;
   transition: background-color 0.3s ease;
}

.delete-btn:hover {
   background-color: #d32f2f;
   text-decoration: none;
}

/* Responsive tweak */
@media (max-width: 768px) {
   #users-table thead {
      display: none;
   }

   #users-table tbody td {
      display: block;
      text-align: right;
      padding-left: 50%;
      position: relative;
   }

   #users-table tbody td::before {
      content: attr(data-label);
      position: absolute;
      left: 0;
      width: 50%;
      padding-left: 1rem;
      font-weight: bold;
      text-align: left;
   }
}

  </style>



</head>
<body>



<section class="accounts">
   <a href="dashboard.php" class="home-btn">
      <i class="fas fa-home"></i> Back to Home
   </a>
   <h1 class="heading">Registered Users</h1>
   <div class="box-container">
      <table id="users-table" class="display">
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               
               <th>Actions</th>
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
                  <a href="view_users.php?delete=<?= $fetch_user['id']; ?>" 
                     class="delete-btn" onclick="return confirm('Delete this user?');">
                     Delete
                  </a>
               </td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#users-table').DataTable();
});
</script>
<script src="../js/admin_script.js"></script>
</body>
</html>