<?php
include 'config.php';

$errors = [];

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
   $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
   $pass = mysqli_real_escape_string($conn, md5($_POST['password'] ?? ''));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword'] ?? ''));

   // 🛡️ Step 1: Check if email is from iiuc.ac.bd
   if (!preg_match('/@ugrad\.iiuc\.ac\.bd$/', $email)) {
      $errors[] = 'Only IIUC email addresses are allowed!';
   } else {
      // ✅ Step 2: Check if user already exists
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

      if (mysqli_num_rows($select_users) > 0) {
         $errors[] = 'User already exists!';
      } else {
         // ✅ Step 3: Check if passwords match
         if ($pass != $cpass) {
            $errors[] = 'Confirm password not matched!';
         } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', 'user')") or die('query failed');
            $errors[] = 'Registered successfully!';
            header('location:login.php');
            exit;
         }
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
   <!-- Font Awesome for close icons in messages -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="assets/css/styles.css">
   <title>Register - IIUC Portal</title>
   <style>
      /* Additional styles for message boxes */
      .message {
         position: relative;
         padding: 15px;
         margin: 20px 0;
         border-radius: 5px;
         background: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .message.success {
         background: #d4edda;
         color: #155724;
         border-color: #c3e6cb;
      }

      .message i {
         cursor: pointer;
         margin-left: 10px;
      }
   </style>
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
         <h1 class="login__title">Create your account</h1>

         <?php if (!empty($errors)): ?>
            <div class="message <?php echo (end($errors) === 'Registered successfully!') ? 'success' : ''; ?>">
               <span><?php echo end($errors); ?></span>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
         <?php endif; ?>

         <div class="login__area">
            <form action="" method="post" class="login__form">
               <div class="login__content grid">
                  <div class="login__box">
                     <input type="text" name="name" required placeholder=" " class="login__input">
                     <label for="name" class="login__label">Full Name</label>
                     <i class="ri-user-fill login__icon"></i>
                  </div>

                  <div class="login__box">
                     <input type="email" name="email" required placeholder=" " class="login__input">
                     <label for="email" class="login__label">Email (@ugrad.iiuc.ac.bd)</label>
                     <i class="ri-mail-fill login__icon"></i>
                  </div>

                  <div class="login__box">
                     <input type="password" name="password" required placeholder=" " class="login__input" id="registerPassword">
                     <label for="password" class="login__label">Password</label>
                     <i class="ri-eye-off-fill login__icon login__password"></i>
                  </div>

                  <div class="login__box">
                     <input type="password" name="cpassword" required placeholder=" " class="login__input" id="registerConfirmPassword">
                     <label for="cpassword" class="login__label">Confirm Password</label>
                     <i class="ri-eye-off-fill login__icon login__password"></i>
                  </div>
               </div>

               <button type="submit" name="submit" class="login__button">Register</button>
            </form>

            <p class="login__switch">
               Already have an account?
               <a href="login.php" id="loginButtonRegister">Login</a>
            </p>
         </div>
      </div>
   </div>

   <script src="assets/js/main.js"></script>
</body>

</html>