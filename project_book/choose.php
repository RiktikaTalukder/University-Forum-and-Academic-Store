<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Choose Action</title>
   
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

   <link rel="stylesheet" href="css/style.css"> <!-- Use your existing CSS -->
   <style>
    .choice-container {
        max-width: 600px;
        margin: 100px auto;
        text-align: center;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 12px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .choice-container h2 {
        margin-bottom: 20px;
        font-family: 'Montserrat', sans-serif;
    }
    .choice-btn {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background-color: var(--purple);
        color: var(--white);
        border-radius: 0.5rem;
        font-size: 1.6rem;
        font-weight: 500;
        margin: 1rem;
        transition: all 0.3s ease;
        border: 2px solid var(--purple);
        font-family: 'Montserrat', sans-serif;
        text-decoration: none;
    }
    .choice-btn:hover {
        background-color: transparent;
        color: var(--purple);
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
</head>
<body>

<div class="choice-container">
   <h2>What would you like to do?</h2>
   <a href="home.php" class="choice-btn">Buy Resources</a>
   <a href="seller_login.php" class="choice-btn">Sell Resources</a>
</div>

</body>
</html>
