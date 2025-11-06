<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniHub - Home</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@500&family=Montserrat:wght@400;500;600&family=Rubik:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/book_welcome.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Additional custom styles */


        .header {
            position: relative;
            z-index: 1000;
        }

        .header-1 {
            background: linear-gradient(90deg, var(--purple), var(--light-bg));
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-1 .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .header-1 .share a {
            font-size: 1.8rem;
            margin-right: 1.5rem;
            color: var(--white);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.2);
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .header-1 .share a:hover {
            background: var(--white);
            color: var(--purple);
            transform: translateY(-3px);
        }

        .header-1 p {
            font-size: 1.6rem;
            color: var(--white);
        }

        .header-1 p a {
            color: var(--white);
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 0.5rem;
        }

        .header-1 p a:hover {
            background: rgba(255, 255, 255, 0.2);
            text-decoration: none;
        }

        .header-2 {
            background-color: var(--white);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header-2 .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem 2rem;
            position: relative;
        }

        .logo {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--purple);
            font-family: 'Montagu Slab', serif;
            display: flex;
            align-items: center;
        }

        .logo::before {
            content: '';
            display: inline-block;
            width: 2.5rem;
            height: 2.5rem;
            background: var(--purple);
            margin-right: 1rem;
            border-radius: 50%;
            position: relative;
        }

        .logo::after {
            content: '';
            display: inline-block;
            width: 1rem;
            height: 1rem;
            background: var(--orange);
            margin-left: 0.5rem;
            border-radius: 50%;
        }

        .navbar {
            display: flex;
            align-items: center;
        }

        .navbar a {
            margin: 0 1.2rem;
            font-size: 1.8rem;
            color: var(--light-color);
            position: relative;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }

        .navbar a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--purple);
            transition: width 0.3s ease;
        }

        .navbar a:hover {
            color: var(--purple);
            text-decoration: none;
        }

        .navbar a:hover::after {
            width: 100%;
        }

        .navbar a.active {
            color: var(--purple);
            font-weight: 500;
        }

        .navbar a.active::after {
            width: 100%;
        }

        .icons>* {
            font-size: 2.5rem;
            color: var(--black);
            cursor: pointer;
            margin-left: 1.5rem;
            transition: all 0.3s ease;
        }

        .icons>*:hover {
            color: var(--purple);
            transform: scale(1.1);
        }

        .user-box {
            position: absolute;
            top: 120%;
            right: 2rem;
            background-color: var(--white);
            border-radius: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            width: 25rem;
            display: none;
            animation: fadeIn 0.3s ease;
            z-index: 1000;
        }

        .user-box.active {
            display: block;
        }

        .user-box p {
            font-size: 1.8rem;
            color: var(--light-color);
            margin-bottom: 1.5rem;
        }

        .user-box p span {
            color: var(--purple);
            font-weight: 500;
        }

        /* Header animations */
        @keyframes headerSlideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .header-1 {
            animation: headerSlideDown 0.5s ease-out;
        }

        .header-2 {
            animation: headerSlideDown 0.5s ease-out 0.1s forwards;
            opacity: 0;
        }

        /* Mobile menu styles */
        @media (max-width: 768px) {
            #menu-btn {
                display: inline-block;
            }

            .navbar {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--white);
                border-top: var(--border);
                border-bottom: var(--border);
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
                flex-direction: column;
                padding: 2rem;
                transition: all 0.3s ease;
            }

            .navbar.active {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }

            .navbar a {
                margin: 1rem 0;
                font-size: 2rem;
                width: 100%;
                text-align: center;
                padding: 1rem;
            }

            .navbar a::after {
                display: none;
            }

            .logo {
                font-size: 2.4rem;
            }
        }


        .hero-cta {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Featured Posts Container */
        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Featured Post Box */
        .box.featured-post {
            background: var(--white);
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        /* Image Styles */
        .box.featured-post .image {
            width: 100%;
            height: 25rem;
            object-fit: cover;
            display: block;
        }

        /* Content Container */
        .box.featured-post>div {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Description and Button */
        .box.featured-post .description {
            flex-grow: 1;
            margin-bottom: 1.5rem;
            font-size: 1.6rem;
            /* Added for better readability */
        }

        .box.featured-post .btn {
            align-self: flex-start;
            margin-top: auto;
            padding: 1rem 2rem;
            /* Added for better button sizing */
        }

        .featured-post {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .featured-post:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .alumni-card {
            position: relative;
            overflow: hidden;
        }

        .alumni-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(142, 68, 173, 0.1), rgba(142, 68, 173, 0.3));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .alumni-card:hover::before {
            opacity: 1;
        }

        .stats-section {
            background-color: var(--purple);
            color: white;
            padding: 5rem 0;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 1.8rem;
            opacity: 0.9;
        }

        .newsletter-form {
            display: flex;
            max-width: 600px;
            margin: 0 auto;
            gap: 1rem;
        }

        .newsletter-form input {
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .newsletter-form {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="header">
        <div class="header-1">
            <div class="flex">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="https://www.linkedin.com/school/international-islamic-university-chittagong/" class="fab fa-linkedin"></a>
                </div>
                <p>
                    <?php
                    // Blog link
                    if (isset($_SESSION['user_logged_in'])) {
                        echo '<a href="home.php">Campus Forum</a>';
                    } else {
                        echo '<a href="login.php">Campus Forum</a>';
                    }
                    ?>
                    |
                    <?php
                    // Book Store link
                    if (isset($_SESSION['user_logged_in'])) {
                        echo '<a href="../project_book/home.php">Marketplace</a>';
                    } else {
                        echo '<a href="../project_book/choose.php">Marketplace</a>';
                    }
                    ?>
                </p>
            </div>
        </div>

        <div class="header-2">
            <div class="flex">
                <a href="#" class="logo">
                    <img src="assets/img/logo.png" style="height: 50px; width: auto;">
                </a>

                

                <div class="user-box" id="user-box">
                    <p>Welcome, <span id="username">Guest</span></p>
                    <a href="login.php" class="btn" id="login-btn">Login</a>
                    <!-- You can hide/show logout later if needed -->
                </div>

            </div>
        </div>
    </header>

    <!-- Hero Banner Section -->
    <section class="home" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/img/cover.jpg') no-repeat; background-size: cover; background-position: center;">
    <div class="content animate__animated animate__fadeIn">
        <h3>Welcome to UniHub!</h3>
        <p>Your gateway to academic discussions, peer-to-peer resources, and campus life. Connect with fellow students, access study materials, and stay updated.</p>
        <div class="hero-cta">
            <?php
            if (isset($_SESSION['user_logged_in'])) {
                echo '<a href="home.php" class="btn animate__animated animate__pulse animate__infinite animate__slower">Explore Forum</a>';
            } else {
                echo '<a href="login.php" class="btn animate__animated animate__pulse animate__infinite animate__slower">Explore Forum</a>';
            }

            if (isset($_SESSION['user_logged_in'])) {
                echo '<a href="../project_book/home.php" class="btn animate__animated animate__pulse animate__infinite animate__slower" style="background-color: var(--orange);">Visit Marketplace</a>';
            } else {
                echo '<a href="../project_book/choose.php" class="btn animate__animated animate__pulse animate__infinite animate__slower" style="background-color: var(--orange);">Visit Marketplace</a>';
            }
            ?>
        </div>
    </div>
</section>

    <!-- University Stats Section -->
    <section class="stats-section">
        <div class="box-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr)); gap: 2rem;">
            <div class="stat-item animate__animated animate__fadeInUp">
                <div class="stat-number">10,000+</div>
                <div class="stat-label">IIUC Students</div>
            </div>

            <div class="stat-item animate__animated animate__fadeInUp animate__delay-2s">
                <div class="stat-number">50+</div>
                <div class="stat-label">Degree Programs</div>
            </div>
            <div class="stat-item animate__animated animate__fadeInUp animate__delay-3s">
                <div class="stat-number">25+</div>
                <div class="stat-label">Student Clubs</div>
            </div>
        </div>
    </section>

    <!-- Featured Posts Section -->
    <section class="products">
        <h1 class="title animate__animated animate__fadeIn">Featured Posts</h1>

        <div class="box-container">
            <!-- Post 1 -->
            <div class="box featured-post animate__animated animate__fadeInLeft">
                <img src="assets/img/post-1.jpg" alt="Campus Life" class="image">
                <div class="name">5 Benefits of IIUC's Learning Environment</div>
                <div class="meta" style="font-size: 1.4rem; color: var(--purple); margin: 1rem 0;">
                    <span><i class="fas fa-user"></i> Current CSE Student</span> ——
                    <span><i class="fas fa-calendar"></i> March 2024</span>
                </div>
                <p class="description" style="font-size: 1.6rem; color: var(--light-color); padding: 1rem;">
                    "Beyond the classrooms, IIUC surprised me with its vibrant student community, peaceful study spots, and the way campus comes alive during Ramadan..."
                </p>
                <?php
                if (isset($_SESSION['user_logged_in'])) {
                    echo '<a href="home.php" class="btn">Read More..<i class="fas fa-arrow-right"></i></a>';
                } else {
                    echo '<a href="login.php" class="btn">Read More..<i class="fas fa-arrow-right"></i></a>';
                }
                ?>
            </div>

            <!-- Post 2 -->
            <div class="box featured-post animate__animated animate__fadeInUp">
                <img src="assets/img/post-2.jpg" alt="Faculty" class="image">
                <div class="name">Faculty Spotlights: Meet Our Professors</div>
                <div class="meta" style="font-size: 1.4rem; color: var(--purple); margin: 1rem 0;">
                    <span><i class="fas fa-user"></i> Law Department</span> ——
                    <span><i class="fas fa-calendar"></i> February 2024</span>
                </div>
                <p class="description" style="font-size: 1.6rem; color: var(--light-color); padding: 1rem;">
                    "What surprised me most was how accessible our teachers are - from late-night email responses to mentoring beyond coursework..."
                </p>
                <?php
                if (isset($_SESSION['user_logged_in'])) {
                    echo '<a href="home.php" class="btn">Read More..<i class="fas fa-arrow-right"></i></a>';
                } else {
                    echo '<a href="login.php" class="btn">Read More..<i class="fas fa-arrow-right"></i></a>';
                }
                ?>
            </div>

            <!-- Post 3 -->
            <div class="box featured-post animate__animated animate__fadeInRight">
                <img src="assets/img/post-3.jpg" alt="Community" class="image">
                <div class="name">Finding My Community at IIUC</div>
                <div class="meta" style="font-size: 1.4rem; color: var(--purple); margin: 1rem 0;">
                    <span><i class="fas fa-user"></i> Transfer Student</span> ——
                    <span><i class="fas fa-calendar"></i> January 2024</span>
                </div>
                <p class="description" style="font-size: 1.6rem; color: var(--light-color); padding: 1rem;">
                    "As someone who struggled to fit in at my previous university, IIUC's welcoming environment and student-led initiatives made all the difference. This is how..."
                </p>
                <?php
                if (isset($_SESSION['user_logged_in'])) {
                    echo '<a href="home.php" class="btn">Read More..<i class="fas fa-arrow-right"></i></a>';
                } else {
                    echo '<a href="login.php" class="btn">Read More..<i class="fas fa-arrow-right"></i></a>';
                }
                ?>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <?php
            if (isset($_SESSION['user_logged_in'])) {
                echo '<a href="home.php" class="btn animate__animated animate__pulse" style="background-color: var(--orange);">View All Student Blogs</a>';
            } else {
                echo '<a href="login.php" class="btn animate__animated animate__pulse" style="background-color: var(--orange);">View All Student Blogs</a>';
            }
            ?>
        </div>
    </section>

    <!-- Success Stories Section -->
    <section class="reviews" style="background-color: var(--light-bg);">
        <h1 class="title">IIUC Alumni Achievements</h1>

        <div class="box-container">
            <div class="box alumni-card animate__animated animate__fadeInLeft">
                <img src="assets/img/pic-1.jpg" alt="Alumni">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>""IIUC's balanced curriculum prepared me for both professional success and personal growth in my Islamic values."</p>
                <h3>- Ayesha Siddiqua, Class of 2018</h3>
            </div>

            <div class="box alumni-card animate__animated animate__fadeInUp">
                <img src="assets/img/pic-2.jpg" alt="Alumni">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>"The balanced curriculum at IIUC allowed me to excel in both secular and religious studies. I'm now pursuing my PhD abroad."</p>
                <h3>- Mohammad Rahman, Class of 2015</h3>
            </div>

            <div class="box alumni-card animate__animated animate__fadeInRight">
                <img src="assets/img/pic-3.jpg" alt="Alumni">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>"IIUC's emphasis on character building along with education shaped me into who I am today. The campus environment is truly inspiring."</p>
                <h3>- Fatima Begum, Class of 2020</h3>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Quick Links</h3>
                <a href="welcome_page.php"> <i class="fas fa-angle-right"></i> Home</a>
                <?php
                if (isset($_SESSION['user_logged_in'])) {
                    echo '<a href="home.php"> <i class="fas fa-angle-right"></i> Campus Forum</a>';
                } else {
                    echo '<a href="login.php"> <i class="fas fa-angle-right"></i> Campus Forum</a>';
                }

                if (isset($_SESSION['user_logged_in'])) {
                    echo '<a href="../project_book/home.php"> <i class="fas fa-angle-right"></i> Marketplace</a>';
                } else {
                    echo '<a href="../project_book/choose.php"> <i class="fas fa-angle-right"></i> Marketplace</a>';
                }
                ?>
                <a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
                <a href="contact.php"> <i class="fas fa-angle-right"></i> Contact</a>
            </div>

            <div class="box">
                <h3>IIUC Resources</h3>
                <a href="#"> <i class="fas fa-angle-right"></i> Central Library</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Research</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Courses</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Faculty</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Calendar</a>
            </div>

            <div class="box">
                <h3>Contact IIUC</h3>
                <a href="#"> <i class="fas fa-phone"></i> +880 31-62615</a>
                <a href="#"> <i class="fas fa-envelope"></i> info@iiuc.ac.bd</a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> Kumira, Chattogram</a>
            </div>

            <div class="box">
                <h3>Connect With Us</h3>
                <a href="https://www.facebook.com/IIUChyOfficial"> <i class="fab fa-facebook-f"></i> Facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
                <a href="https://www.linkedin.com/school/international-islamic-university-chittagong/"> <i class="fab fa-linkedin"></i> LinkedIn </a>
            </div>
        </div>

        <div class="credit"> &copy; <?php echo date('Y'); ?> UniHub - IIUC Academic Platform | Developed by UniHub Team <span>(RaspberryPies)</span> </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Enhanced Header Script
        document.addEventListener('DOMContentLoaded', function() {
            // User box toggle
            const userBtn = document.getElementById('user-btn');
            const userBox = document.querySelector('.user-box');

            userBtn.addEventListener('click', function() {
                userBox.classList.toggle('active');
            });

            // Mobile menu toggle
            const menuBtn = document.getElementById('menu-btn');
            const navbar = document.querySelector('.navbar');

            menuBtn.addEventListener('click', function() {
                navbar.classList.toggle('active');
                menuBtn.classList.toggle('fa-times');
            });

            // Active link highlighting
            const navLinks = document.querySelectorAll('.navbar a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    // Close mobile menu if open
                    if (navbar.classList.contains('active')) {
                        navbar.classList.remove('active');
                        menuBtn.classList.remove('fa-times');
                    }
                });
            });

            // Sticky header on scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.header-2');
                if (window.scrollY > 100) {
                    header.classList.add('sticky');
                } else {
                    header.classList.remove('sticky');
                }
            });

            // Close user box when clicking outside
            document.addEventListener('click', function(e) {
                if (!userBtn.contains(e.target) && !userBox.contains(e.target)) {
                    userBox.classList.remove('active');
                }
            });

            // Login/logout functionality
            const loginBtn = document.getElementById('login-btn');
            const logoutBtn = document.getElementById('logout-btn');
            const usernameSpan = document.getElementById('username');

            loginBtn.addEventListener('click', function(e) {
                e.preventDefault();
                usernameSpan.textContent = 'Student';
                loginBtn.style.display = 'none';
                logoutBtn.style.display = 'inline-block';
                userBox.classList.remove('active');
            });

            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                usernameSpan.textContent = 'Guest';
                loginBtn.style.display = 'inline-block';
                logoutBtn.style.display = 'none';
                userBox.classList.remove('active');
            });
        });
        // Simple script for user login/logout toggle
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('login-btn');
            const logoutBtn = document.getElementById('logout-btn');
            const userBox = document.querySelector('.user-box');
            const usernameSpan = document.getElementById('username');
            const userBtn = document.getElementById('user-btn');

            // Toggle user box
            userBtn.onclick = () => {
                userBox.classList.toggle('active');
            };

            // Mock login functionality
            loginBtn.onclick = (e) => {
                e.preventDefault();
                // In a real implementation, this would trigger GSuite OAuth
                usernameSpan.textContent = 'Student';
                loginBtn.style.display = 'none';
                logoutBtn.style.display = 'inline-block';
                userBox.classList.remove('active');
            };

            // Logout functionality
            logoutBtn.onclick = (e) => {
                e.preventDefault();
                usernameSpan.textContent = 'Guest';
                loginBtn.style.display = 'inline-block';
                logoutBtn.style.display = 'none';
                userBox.classList.remove('active');
            };

            // Mobile menu toggle
            const menuBtn = document.getElementById('menu-btn');
            const navbar = document.querySelector('.navbar');

            menuBtn.onclick = () => {
                navbar.classList.toggle('active');
                menuBtn.classList.toggle('fa-times');
            };

            // Sticky header on scroll
            window.onscroll = () => {
                navbar.classList.remove('active');
                menuBtn.classList.remove('fa-times');
                userBox.classList.remove('active');

                if (window.scrollY > 60) {
                    document.querySelector('.header .header-2').classList.add('active');
                } else {
                    document.querySelector('.header .header-2').classList.remove('active');
                }
            };

            // Animate elements when they come into view
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate__animated');

                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementPosition < windowHeight - 100) {
                        const animationClass = element.classList[1];
                        element.classList.add(animationClass);
                    }
                });
            };

            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Run once on page load
        });
    </script>
</body>

</html>