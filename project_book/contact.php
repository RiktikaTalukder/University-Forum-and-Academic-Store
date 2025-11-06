<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:/blogBook/project_blog/login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $seller_id = mysqli_real_escape_string($conn, $_POST['seller_id']);
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id = '$user_id' AND seller_id = '$seller_id' AND name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'This message was already sent!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, seller_id, name, email, number, message) VALUES('$user_id', '$seller_id', '$name', '$email', '$number', '$msg')");
      $message[] = 'Message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>


   <!--=============== REMIXICONS ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@500&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">


</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Contact</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Get in Touch</h3>
      <input type="text" name="seller_id" required placeholder="Enter Seller ID (CXXXXXX)" class="box">
      <input type="text" name="name" required placeholder="Your Full Name" class="box">
      <input type="email" name="email" required placeholder="Your IIUC Email (@ugrad.iiuc.ac.bd)" class="box">
      <input type="number" name="number" required placeholder="Mobile Number" class="box">
      <textarea name="message" class="box" placeholder="Your message or inquiry..." id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>