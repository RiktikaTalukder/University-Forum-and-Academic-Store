<?php
include 'config.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Handle "Add to Cart" only if user is logged in
if (isset($_POST['add_to_cart'])) {
   if (!$user_id) {
      // Redirect to login page and return back to home after login
      header('Location: /blogBook/project_blog/login.php?redirect=/blogBook/project_book/home.php');
      exit();
   }

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'resource added to cart!';
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UniHub Store</title>


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

   <!--==================== HOME ====================-->
   <section class="home section" id="home">
      <div class="home__container container grid">
         <div class="home__data">
            <h1 class="home__title">
               Browse & <br>
               Find Academic Resources
            </h1>

            <p class="home__description">
               Access IIUC course materials, textbooks,
               and study resources at unbeatable prices—enjoy
               exclusive student discounts, peer-to-peer
               exchanges, and faculty-approved content all
               in one place.
            </p>

            <a href="shop.php" class="button">Explore Now</a>
         </div>

         <div class="home__images">
            <div class="home__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="home__article swiper-slide">
                     <div class="book-3d-container">
                        <img src="images/home-book-1.png" alt="image" class="home__img">
                     </div>
                  </article>

                  <article class="home__article swiper-slide">
                     <div class="book-3d-container">
                        <img src="images/home-book-2.png" alt="image" class="home__img">
                     </div>
                  </article>

                  <article class="home__article swiper-slide">
                     <div class="book-3d-container">
                        <img src="images/home-book-3.png" alt="image" class="home__img">
                     </div>
                  </article>

                  <article class="home__article swiper-slide">
                     <div class="book-3d-container">
                        <img src="images/home-book-4.png" alt="image" class="home__img">
                     </div>
                  </article>
               </div>
               <!-- Add these if you want navigation arrows -->
               <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div>
            </div>
         </div>
      </div>
   </section>

   <!--==================== SERVICES ====================-->
   <section class="services section">
      <div class="services__container container grid">
         <article class="services__card">
            <i class="ri-truck-line"></i>
            <h3 class="services__title">Campus Delivery</h3>
            <p class="services__description">Free pickup locations</p>
         </article>

         <article class="services__card">
            <i class="ri-lock-2-line"></i>
            <h3 class="services__title">Secure Payment</h3>
            <p class="services__description">Trusted IIUC transaction</p>
         </article>

         <article class="services__card">
            <i class="ri-customer-service-2-line"></i>
            <h3 class="services__title">Student Support</h3>
            <p class="services__description">Academic hours assistance</p>
         </article>
      </div>
   </section>

   <!--==================== DISCOUNT ====================-->
   <section class="discount section" id="discount">
      <div class="discount__container container grid">
         <div class="discount__data">
            <h2 class="discount__title section__title">
               Student Discounts Available
            </h2>

            <p class="discount__description">
               Save big on academic materials with special
               student pricing in the IIUC marketplace—buy
               directly from fellow students and enjoy bigger
               savings the more you shop!
            </p>

            <a href="shop.php" class="button">Browse Marketplace</a>
         </div>

         <div class="discount__images">
            <img src="images/discount-book-1.png" alt="" class="discount__img-1">
            <img src="images/discount-book-2.png" alt="" class="discount__img-2">
         </div>
      </div>
   </section>

   <!--==================== NEW BOOKS ====================-->
   <section class="new section" id="new">
      <h2 class="section__title">
         Latest Book Arrivals
      </h2>

      <div class="new__container container">
         <div class="new__swiper swiper">
            <div class="swiper-wrapper">
               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-1.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Data Communications & Networking (Indian Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳450</span>
                        <span class="new__price">৳500</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-2.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Naval Architecture (6th Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳460</span>
                        <span class="new__price">৳500</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-3.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Human Psychology</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳390</span>
                        <span class="new__price">৳450</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-4.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">The Design of a Microprocesser</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳400</span>
                        <span class="new__price">৳480</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-5.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Algorithms and Data Structures</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳470</span>
                        <span class="new__price">৳520</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-6.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Principles of Microeconomics</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳290</span>
                        <span class="new__price">৳370</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-7.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Primary Hematology</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳460</span>
                        <span class="new__price">৳520</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-8.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Pharmaceutical Biotechnology (Fourth Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳450</span>
                        <span class="new__price">৳500</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-9.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Introductions to Algorithms (Fourth Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳410</span>
                        <span class="new__price">৳480</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-10.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Orthodontics for Dental Students (Third Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳370</span>
                        <span class="new__price">৳450</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>
            </div>
         </div>

         <div class="new__swiper swiper">
            <div class="swiper-wrapper">
               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-10.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Orthodontics for Dental Students (Third Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳370</span>
                        <span class="new__price">৳450</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-9.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Introductions to Algorithms (Fourth Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳410</span>
                        <span class="new__price">৳480</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-8.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Pharmaceutical Biotechnology (Fourth Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳450</span>
                        <span class="new__price">৳500</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-7.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Primary Hematology</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳460</span>
                        <span class="new__price">৳520</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-6.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Principles of Microeconomics</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳290</span>
                        <span class="new__price">৳370</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-5.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Algorithms and Data Structures</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳470</span>
                        <span class="new__price">৳520</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-4.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">The Design of a Microprocesser</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳400</span>
                        <span class="new__price">৳480</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-3.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Human Psychology</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳390</span>
                        <span class="new__price">৳450</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-2.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Naval Architecture (6th Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳460</span>
                        <span class="new__price">৳500</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>

               <a href="shop.php" class="new__card swiper-slide">
                  <img src="images/book-1.png" alt="image" class="new__img">

                  <div>
                     <h2 class="new__title">Data Communications & Networking (Indian Edition)</h2>
                     <div class="new__prices">
                        <span class="new__discount">৳450</span>
                        <span class="new__price">৳500</span>
                     </div>

                     <div class="new__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </div>
               </a>
            </div>
         </div>
      </div>
   </section>

   <section class="products">

      <h1 class="title">Latest Study Resources</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="price">৳<?php echo $fetch_products['price']; ?>/-</div>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn">View More Resources</a>
      </div>

   </section>

   <section class="home-contact">

      <div class="content">
         <h3>Need academic assistance?</h3>
         <p>Have questions about course materials or the marketplace? Our IIUC support team is here to help fellow students.</p>
         <a href="contact.php" class="white-btn">Contact Support</a>
      </div>

   </section>


   <?php include 'footer.php'; ?>

   <!--=============== SCROLLREVEAL ===============-->
   <script src="https://unpkg.com/scrollreveal@4.0.9/dist/scrollreveal.min.js"></script>

   <!--=============== SWIPER JS ===============-->
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>