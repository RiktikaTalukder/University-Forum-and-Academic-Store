<?php
session_start();
include 'config.php';

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   // Check if email ends with @ugrad.iiuc.ac.bd
   if (!preg_match('/@ugrad.iiuc\.ac\.bd$/', $email)) {
      $message[] = 'Only IIUC student email addresses (@ugrad.iiuc.ac.bd) are allowed!';
   } else {
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('Query failed: ' . mysqli_error($conn));

      if (mysqli_num_rows($select_users) > 0) {
         $row = mysqli_fetch_assoc($select_users);

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('Location: home.php');
         exit();
      } else {
         $message[] = 'Incorrect email or password!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Remix Icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
   <link rel="stylesheet" href="assets/css/styles.css">
   <title>Login - IIUC Portal</title>
</head>

<body>
   <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
      <mask id="mask0" mask-type="alpha">
         <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
         0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
         591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
         167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />
      </mask>
      <g mask="url(#mask0)">
         <path d="... same blob path ..." />
         <image class="login__img" href="assets/img/login.jpg" />
      </g>
   </svg>

   <div class="login container grid">
      <div class="login__access">
         <h1 class="login__title">Log in to your account</h1>

         <?php if (!empty($errors)): ?>
            <div class="message">
               <?php foreach ($errors as $error): ?>
                  <p><?= $error ?></p>
               <?php endforeach; ?>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
         <?php endif; ?>

         <div class="login__area">
            <form action="" method="post" class="login__form">
               <div class="login__content grid">
                  <div class="login__box">
                     <input type="email" name="email" required placeholder=" " class="login__input">
                     <label for="email" class="login__label">Email (@ugrad.iiuc.ac.bd)</label>
                     <i class="ri-mail-fill login__icon"></i>
                  </div>

                  <div class="login__box">
                     <input type="password" name="password" required placeholder=" " class="login__input" id="loginPassword">
                     <label for="password" class="login__label">Password</label>
                     <i class="ri-eye-off-fill login__icon login__password"></i>
                  </div>
               </div>

               <a href="register.php" class="login__forgot">Forgot your password?</a>

               <button type="submit" name="submit" class="login__button">Login</button>
            </form>


            <p class="login__switch">
               Don't have an account?
               <a href="register.php" id="loginButtonRegister">Create Account</a>
            </p>
         </div>
      </div>
   </div>

   <script src="assets/js/main.js"></script>
</body>

</html>