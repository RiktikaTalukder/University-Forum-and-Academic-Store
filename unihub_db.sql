-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unihub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `user_name`, `comment`, `date`) VALUES
(19, 11, 16, 'Riktika Talukder', 'Totally agree, solving simple logic puzzles helped me too!', '2025-06-28'),
(21, 13, 17, 'Meheri Monir', 'First experiment is about using Vernier Calipers and Micrometer. Pretty basic!', '2025-06-28'),
(22, 11, 17, 'Meheri Monir', 'Thanks, this course was driving me up the wall, this helps!', '2025-06-28'),
(23, 12, 15, 'Farhana Akhter', 'Got mine from Central, used but works well. Saved 10k!', '2025-06-28'),
(24, 15, 15, 'Farhana Akhter', 'Might be able to help with UI but not sure about the timeline...', '2025-06-28'),
(25, 13, 15, 'Farhana Akhter', 'I’ve got the PDF from last semester. DMing you now.', '2025-06-28'),
(26, 16, 18, 'Saifuddin Ahmed', 'Check out Abdul Bari’s YouTube videos. Clear explanations!', '2025-06-28'),
(27, 11, 18, 'Saifuddin Ahmed', 'Thanks for the tip! Anyone has past question sets for Spring 2023? I can share mine from Fall. Let’s build a Google Drive maybe?', '2025-06-28'),
(28, 14, 18, 'Saifuddin Ahmed', 'Wish they added a session on mobile app development too. But yesss, will be attending', '2025-06-28'),
(29, 17, 19, 'Tariq Hasan', 'I usually chill at the library or grab coffee near the front gate.', '2025-06-28'),
(30, 12, 19, 'Tariq Hasan', 'Try ASUS VivoBook or Dell Inspiron. I use one and it&#39;s fine for basics.', '2025-06-28'),
(31, 16, 19, 'Tariq Hasan', 'I’d join a group. Let’s sync up after class tomorrow?', '2025-06-28'),
(32, 11, 19, 'Tariq Hasan', 'Underrated tip: Pair programming with a friend in labs helped me understand the code, not just write it.', '2025-06-28'),
(33, 18, 20, 'Fatima Chowdhury', 'PC finally turned on 5 mins before lab ended. Beautiful timing.', '2025-06-28'),
(34, 15, 20, 'Fatima Chowdhury', 'I’m pretty solid with React, and I’m in Section B. DMing you.', '2025-06-28'),
(35, 19, 21, 'Nashit Rahman', 'I use ChatGPT sometimes to brainstorm report structures.', '2025-06-28'),
(36, 18, 21, 'Nashit Rahman', 'Could not agree more lolol', '2025-06-28'),
(37, 21, 22, 'Zara Hossain', 'Shuttle’s okay before 8AM. After that, prepare for delays lolol', '2025-06-28'),
(38, 20, 22, 'Zara Hossain', 'Bus is okay before 8AM. After that, prepare for delays.', '2025-06-28'),
(39, 13, 22, 'Zara Hossain', 'Hey I accidentally made an extra copy when printing it out for myself, could give it to you?', '2025-06-28'),
(40, 15, 22, 'Zara Hossain', 'Hey, do you still need a partner? This post is older so...', '2025-06-28'),
(41, 20, 16, 'Riktika Talukder', 'Group study for theory, solo for problem solving. Works for me.', '2025-06-28'),
(42, 22, 16, 'Riktika Talukder', 'Bring back the ৳20 shingara era 😭', '2025-06-28'),
(43, 22, 15, 'Farhana Akhter', 'I now rate food based on cost per bite', '2025-06-28'),
(44, 18, 15, 'Farhana Akhter', 'Once waited so long I learned how to meditate 🙏', '2025-06-28'),
(45, 23, 19, 'Tariq Hasan', 'I brought an umbrella and left with trench foot. What is this weather 😭', '2025-06-28'),
(46, 23, 16, 'Riktika Talukder', 'Central Library feels like Venice. Where&#39;s the IIUC gondola service?', '2025-06-28'),
(47, 24, 16, 'Riktika Talukder', 'YouTube Premium + YouTube playlists = gold for CSE crash courses.', '2025-06-28'),
(48, 25, 15, 'Farhana Akhter', 'One full day off. No guilt. Then I plan light tasks for the next 3 days.', '2025-06-28'),
(49, 24, 15, 'Farhana Akhter', 'Try TickTick for daily task tracking. Has a great free version', '2025-06-28'),
(50, 23, 15, 'Farhana Akhter', 'I saw a first-year using their class notes to cover a puddle. Respect', '2025-06-28'),
(52, 26, 17, 'Meheri Monir', 'Change partners. Or charge them rent.', '2025-06-28'),
(53, 27, 22, 'Zara Hossain', 'We have a CP group on campus. Will DM the link.', '2025-06-28'),
(54, 28, 22, 'Zara Hossain', 'Mine has one shoe, two USBs and a sandwich from last month', '2025-06-28'),
(55, 26, 22, 'Zara Hossain', 'Tell them it’s 2 marks per wire connected. Watch them wake up.', '2025-06-28'),
(56, 29, 20, 'Fatima Chowdhury', 'More plug points and shaded seating would really help in summer.', '2025-06-28'),
(57, 28, 20, 'Fatima Chowdhury', 'You&#39;re not a student unless your bag has at least one mystery item.', '2025-06-28'),
(58, 27, 20, 'Fatima Chowdhury', 'Codeforces for problem-solving speed. LeetCode for interview prep.', '2025-06-28'),
(59, 30, 19, 'Tariq Hasan', 'Wish the library stayed open later during exam weeks.', '2025-06-28'),
(60, 31, 18, 'Saifuddin Ahmed', 'Helps reduce multitasking. I stick to one subject per block.', '2025-06-28'),
(61, 30, 18, 'Saifuddin Ahmed', 'Online journal access through IIUC domain is very useful. Not many know.', '2025-06-28'),
(62, 31, 21, 'Nashit Rahman', 'Yes! Google Calendar + color coding works wonders.', '2025-06-28'),
(63, 27, 21, 'Nashit Rahman', 'There’s an IIUC CP group forming ICPC teams, let me know if you want to join our weekly practice sessions!', '2025-06-28'),
(64, 32, 21, 'Nashit Rahman', 'Glad someone said it! I always tell my cousins that IIUC isn’t just study–the people and the moments here are what stay with you.', '2025-06-28'),
(65, 32, 22, 'Zara Hossain', 'The community really shines during Ramadan, but honestly, even on normal days it’s so easy to find people to study or chill with here.', '2025-06-28'),
(66, 33, 22, 'Zara Hossain', 'Lowkey thought uni would be like ‘you’re on your own’ mode, but nah. I had sir actually help me prep for an inter-university hackathon outside syllabus.', '2025-06-28'),
(67, 32, 17, 'Meheri Monir', 'Yesss and don’t forget those iftar packet distributions! The way people share and look out for each other during that time is something else.', '2025-06-28'),
(68, 34, 17, 'Meheri Monir', 'You’re not alone. I transferred too and didn’t expect to enjoy it this much. People here really do make space for you, not just tolerate you.', '2025-06-28'),
(69, 34, 16, 'Riktika Talukder', 'IIUC dorm life also makes a huge difference tbh. Movie nights, tea breaks, even football arguments — all of it makes you feel part of something.', '2025-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(12, 16, 11),
(13, 17, 11),
(16, 15, 11),
(17, 15, 16),
(18, 18, 11),
(21, 18, 16),
(22, 18, 15),
(23, 18, 14),
(24, 19, 11),
(27, 19, 16),
(28, 19, 15),
(29, 19, 14),
(30, 19, 17),
(31, 19, 18),
(32, 20, 11),
(35, 20, 14),
(36, 20, 15),
(37, 20, 16),
(38, 20, 19),
(39, 20, 18),
(40, 20, 17),
(41, 21, 11),
(42, 21, 12),
(44, 21, 16),
(45, 21, 15),
(46, 21, 14),
(47, 21, 17),
(48, 21, 18),
(49, 21, 19),
(51, 21, 21),
(52, 22, 11),
(53, 22, 12),
(55, 22, 15),
(56, 22, 16),
(57, 22, 17),
(58, 22, 19),
(59, 22, 21),
(61, 22, 20),
(62, 22, 22),
(63, 16, 12),
(65, 16, 15),
(66, 16, 14),
(67, 16, 16),
(68, 16, 17),
(69, 16, 18),
(70, 16, 19),
(71, 16, 22),
(72, 16, 21),
(73, 16, 20),
(74, 15, 12),
(76, 15, 14),
(77, 15, 15),
(78, 15, 21),
(79, 15, 22),
(80, 15, 20),
(81, 21, 23),
(82, 19, 24),
(83, 19, 23),
(84, 16, 25),
(85, 16, 24),
(86, 16, 23),
(87, 15, 23),
(88, 15, 24),
(89, 15, 25),
(90, 15, 26),
(91, 17, 26),
(92, 17, 27),
(93, 17, 28),
(94, 17, 24),
(95, 17, 25),
(96, 17, 23),
(97, 17, 20),
(98, 17, 21),
(99, 17, 22),
(100, 17, 19),
(101, 22, 29),
(102, 22, 27),
(103, 22, 28),
(104, 22, 26),
(105, 22, 23),
(106, 22, 13),
(107, 20, 30),
(108, 20, 13),
(109, 20, 29),
(110, 20, 28),
(111, 20, 26),
(112, 20, 24),
(113, 19, 31),
(114, 19, 30),
(115, 19, 29),
(116, 19, 28),
(117, 19, 26),
(118, 18, 31),
(119, 18, 30),
(120, 18, 29),
(121, 18, 28),
(122, 18, 27),
(123, 18, 26),
(124, 18, 13),
(125, 21, 30),
(126, 21, 31),
(127, 21, 29),
(128, 21, 13),
(129, 21, 26),
(130, 21, 28),
(131, 15, 32),
(132, 21, 33),
(133, 21, 32),
(134, 22, 34),
(135, 22, 33),
(136, 22, 32),
(137, 17, 34),
(138, 17, 33),
(139, 17, 32),
(140, 16, 33),
(141, 16, 34),
(142, 16, 13),
(143, 16, 32),
(144, 16, 29),
(145, 16, 27);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `seller_id`, `name`, `email`, `number`, `message`) VALUES
(15, 15, 'c223256', 'Farhana Akhter', 'c223265@ugrad.iiuc.ac.bd', '01617787455', 'Hi, is the DBMS project fully working or does it need any extra setup? Like database import or config changes?'),
(16, 21, 'c223261', 'Nashit Rahman', 'c542272@ugrad.iiuc.ac.bd', '01293369112', 'Does the practice sheet include any of Sir Imran’s style of MCQs? His pattern is different!'),
(17, 19, 'c223265', 'Tariq Hasan', 'c774321@ugrad.iiuc.ac.bd', '01703371962', 'Can you bundle your math and physics notes together at a discount?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `pickup_time` varchar(100) NOT NULL,
  `pickup_place` varchar(100) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `seller_id`, `product_id`, `name`, `number`, `email`, `method`, `pickup_time`, `pickup_place`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(29, 19, 'c223265', 22, 'Tariq Hasan', '01603976288', 'c774321@ugrad.iiuc.ac.bd', 'Cash on delivery', '11:00AM', 'IIUC Admin Building', 'Pharmaceutical Biotechnology (4th Edition) (x1), Data Communications and Networking (Indian Edition) (x1), Oracle SQL Setup + Screenshot Walkthrough (x1)', 960, '28-Jun-2025', 'pending'),
(30, 19, 'c223261', 26, 'Tariq Hasan', '01603976288', 'c774321@ugrad.iiuc.ac.bd', 'Cash on delivery', '11:00AM', 'IIUC Admin Building', 'PHY3201 notes – Spring 2025 (x1)', 200, '28-Jun-2025', 'completed'),
(31, 19, 'c223256', 38, 'Tariq Hasan', '01653889262', 'c774321@ugrad.iiuc.ac.bd', 'Cash on delivery', '9:00AM', 'IIUC Main Gate', 'Software Engineering (x1), Introduction to Modern Statistics (x1)', 940, '28-Jun-2025', 'pending'),
(32, 19, 'c223261', 25, 'Tariq Hasan', '01653889262', 'c774321@ugrad.iiuc.ac.bd', 'Cash on delivery', '9:00AM', 'IIUC Main Gate', 'CSE1101 notes – Fall 2023 (x1), Critical Analysis of Science Textbooks (x1), Academic Portfolio for BBA Students – Canva File (x1)', 540, '28-Jun-2025', 'pending'),
(33, 15, 'c223261', 25, 'Farhana Akhter', '0175339162', 'c223265@ugrad.iiuc.ac.bd', 'Cash on delivery', '9:30AM', 'IIUC Cafeteria', 'CSE1101 notes – Fall 2023 (x1), The Design of a Microprocessor (x1)', 560, '28-Jun-2025', 'pending'),
(34, 15, 'c223256', 31, 'Farhana Akhter', '0175339162', 'c223265@ugrad.iiuc.ac.bd', 'Cash on delivery', '9:30AM', 'IIUC Cafeteria', 'Primary Hematology (x1), Introduction to Algorithms (x1), Turbo C++ Full Installer + Windows 11 Guide (x1)', 980, '28-Jun-2025', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `name`, `title`, `content`, `image`, `date`, `status`) VALUES
(11, 15, 'Farhana Akhter', 'How I Managed to Get an A+ in CSE1101 (Intro to Programming)', 'Assalamu Alaikum! I wanted to share my experience with CSE1101, as I know many of you are struggling with it. My biggest advice is to focus on problem-solving skills rather than memorizing syntax. Use platforms like HackerRank and LeetCode daily—even 30 mins helps. Also, never skip lab classes, they give a practical grip on concepts. Finally, get past question sets from seniors. Let’s help each other!', 'pexels-cottonbro-5473298.jpg', '2025-06-28', 'active'),
(12, 16, 'Riktika Talukder', 'Suggest a Laptop for CSE Under ৳50,000?', 'I’m a 1st-year CSE student looking to buy a laptop that’ll last at least 3 years. My budget is under ৳50,000 and I mainly need it for Python, VS Code, maybe some light machine learning later. What are you guys using? Anyone tried refurbished ones from Chittagong Computer City? I’d love real feedback from fellow students, not just shopkeeper hype.', 'pexels-morningtrain-18105.jpg', '2025-06-28', 'active'),
(13, 16, 'Riktika Talukder', 'Anyone Got a Soft Copy of PHY1101 Lab Manual?', 'Hey everyone, I missed the orientation week and didn’t receive the Physics I (PHY1101) lab manual. If anyone has a PDF or scanned version, could you please share it here or send it via UniHub DMs? I don’t want to fall behind before labs even start. Would also appreciate if someone could briefly explain what the first experiment is about.', 'pexels-cottonbro-7858287.jpg', '2025-06-28', 'active'),
(14, 17, 'Meheri Monir', ' Anyone Joining IIUC TechFest This Weekend?', 'Super excited about the upcoming IIUC TechFest! I heard there’ll be workshops on UI/UX, Robotics, and even a quick coding challenge. I’m especially interested in the team project showcase — great way to learn what seniors are building. Is anyone else attending? Might be fun to connect before the event.', 'pexels-myburgh-1102797.jpg', '2025-06-28', 'active'),
(15, 17, 'Meheri Monir', 'Need a Partner for Software Engineering Lab – Preferably Frontend Skilled', 'Hey! I’m still looking for a partner for the Software Engineering Lab project. I’m comfortable with backend (Node.js, Firebase) but I struggle with UI and frontend frameworks. If anyone from Section B is interested and good with React or basic HTML/CSS, let’s team up. The deadline is approaching fast, and it’ll be smoother to divide the work now.', 'pexels-tranmautritam-326514.jpg', '2025-06-28', 'active'),
(16, 15, 'Farhana Akhter', 'Anyone Else Struggling with CSE2213 Algorithms?', 'We just started CSE2213 (Algorithms) this term and I’m already finding the lectures hard to follow. The topics like recursion and divide-and-conquer are completely new to me. Anyone else in the same boat? Would be great to form a small peer study group or even share online resources that helped. Don’t want to fall behind like I did in Data Structures last term.', 'pexels-madeon08-102061.jpg', '2025-06-28', 'active'),
(17, 18, 'Saifuddin Ahmed', 'How Do You Manage Long Breaks Between Classes?', 'Some days I have 3-hour gaps between classes, and it’s honestly exhausting waiting around. I usually try to study or watch tutorials but the environment isn’t always ideal. Do you all go to the library, mosque, cafeteria — or just leave campus and return later? Curious how other students make productive use of these awkward gaps.', 'pexels-gabby-k-6238011.jpg', '2025-06-28', 'active'),
(18, 19, 'Tariq Hasan', 'Nothing Ages You Faster Than a 3-Hour Lab with a PC That Won’t Boot', 'Sir: “Open the software and run the code.”\r\nMe: Still waiting for Windows to start after 25 minutes\r\nAlso me: submits lab manually with tears\r\nPC labs at IIUC need therapy. And maybe RAM.', 'pexels-mikhail-nilov-9159052.jpg', '2025-06-28', 'active'),
(19, 20, 'Fatima Chowdhury', 'Free Tools I Use for Assignments & Reports', 'I thought I’d share a few tools I use that have saved me tons of time:\r\n\r\n1. Notion – for class notes\r\n2. Grammarly – for polishing reports\r\n3. Zotero – reference manager for term papers\r\n4. Overleaf – if you need to write any LaTeX-based docs\r\n\r\nIf you have other tools that help with uni work, drop them below. Would love to try new ones.', 'pexels-cottonbro-7439127.jpg', '2025-06-28', 'active'),
(20, 21, 'Nashit Rahman', 'What’s Your Study Method During Midterms?', 'Midterms are coming and I’m still figuring out a solid study strategy. I tried the Pomodoro method but keep getting distracted. Do you guys study solo, with friends, or go into full cram mode the night before? I’d love to hear how others in IIUC are prepping — especially how to stay focused with multiple subjects overlapping.', 'pexels-diimejii-2325729.jpg', '2025-06-28', 'active'),
(21, 21, 'Nashit Rahman', 'Is the University Bus Reliable?', 'I’ve been commuting from Chawkbazar using the bus service. Some days it&#39;s on time, other days it&#39;s a nightmare. Anyone else using it regularly? Wondering if it’s better to take local transport or stick to the uni bus. Also, are there any lesser-known routes that help avoid the evening traffic jam after 5 PM?', 'pexels-nicolas-langellotti-28179636-30534083.jpg', '2025-06-28', 'active'),
(22, 22, 'Zara Hossain', 'One Chicken Roll + One Chaa = Financial Ruin', 'Today’s lunch: 1 chicken roll, 1 tea\r\nTotal: ৳85\r\nNext day: Accountant me checking if I can eat or buy printer ink for assignments.\r\nUniversity cafeteria is just vibes and empty wallets.', 'pexels-hashtag-melvin-1163687-29037265.jpg', '2025-06-28', 'active'),
(23, 21, 'Nashit Rahman', 'Welcome to IIUC: Now With Bonus Flooding!', 'Rainy season + uneven pavements = obstacle course.\r\nLost a shoe near CCE building.\r\nA duck swam past me, a cow mooed.\r\nSend help.', 'pexels-jyjyjyjy-32699558.jpg', '2025-06-28', 'active'),
(24, 19, 'Tariq Hasan', 'Must-Have Android Apps for Students?', 'What are your go-to apps that genuinely make student life easier? Not just the hype ones, but ones you actually use. For me:\r\n• CamScanner for quick PDF scans\r\n• Forest to stay focused\r\n• Notion for organizing class notes\r\nWould love to hear your list — especially if you have any offline-friendly apps or tools for group study.', 'pexels-cottonbro-4064840.jpg', '2025-06-28', 'active'),
(25, 16, 'Riktika Talukder', 'How Do You Reset After a Bad Week?', 'Sometimes I have a totally unproductive week—missed deadlines, forgot tasks, zero focus. Curious how others bounce back after that kind of burnout. Do you take a full break? Plan a reset weekend? Rearrange your calendar? I need tips for getting back on track mentally and academically without feeling overwhelmed.', 'pexels-energepic-com-27411-313690.jpg', '2025-06-28', 'active'),
(26, 15, 'Farhana Akhter', 'My Lab Partner Just Watches Me Do Everything Like It&#39;s Netflix', 'Shoutout to my lab partner for providing moral support, strong eye contact, and zero actual contribution. I feel like I’m doing a one-man show in every lab. How do you politely say “do something or I dropkick the circuit board”?', 'pexels-cottonbro-4709363.jpg', '2025-06-28', 'active'),
(27, 17, 'Meheri Monir', 'Where Do You Practice Coding Outside of Class?', 'We cover basics in class, but I feel like I need more structured practice. What platforms do you use — LeetCode, HackerRank, Codeforces? Also curious if anyone here has done team coding or participated in ICPC-style problems. Let’s share resources and maybe form a group?', 'pexels-mikhail-nilov-7988114.jpg', '2025-06-28', 'active'),
(28, 17, 'Meheri Monir', 'My Backpack Has Turned Into a Portable Trash Bin', 'Why do I have three empty chip packets, five pens with no ink, and a calculator I haven’t used since 2023? I think my bag is evolving into its own ecosystem. Anyone else here carrying emotional damage and half-dead notebooks?', 'pexels-craytive-1478476.jpg', '2025-06-28', 'active'),
(29, 22, 'Zara Hossain', 'IIUC Campus Infrastructure – What Can Be Improved?', 'As students, I think we all have ideas about what would make the campus experience smoother. Whether it’s more study zones, improved bus routes, or better cafeteria variety — what realistic changes should IIUC consider implementing? Let’s use this post as constructive feedback.', 'pexels-pixabay-159213.jpg', '2025-06-28', 'active'),
(30, 20, 'Fatima Chowdhury', 'Are We Underusing Our University Library?', 'I recently explored the IIUC library and found journals, magazines, and e-resources I didn’t even know we had access to. Do you think students are missing out by not using these more? What resources or improvements would encourage more use?', 'pexels-tima-miroshnichenko-6550407.jpg', '2025-06-28', 'active'),
(31, 19, 'Tariq Hasan', 'Anyone Use Time Blocking Instead of To-Do Lists?', 'To-do lists keep growing and never seem to end. I read about time blocking — assigning fixed time slots to tasks rather than vague checklists. Has anyone tried this method for managing coursework, reading, or projects? Curious if it helps with procrastination.', 'pexels-michaela-87369-295826.jpg', '2025-06-28', 'active'),
(32, 15, 'Farhana Akhter', '5 Benefits of IIUC&#39;s Learning Environment', 'Beyond the classrooms, IIUC truly surprised me with its vibrant and welcoming student community. From spontaneous group study sessions in the library corners to the buzz of clubs hosting events around the year, there&#39;s always something happening. I especially love the peaceful study spots tucked away across the campus — perfect for unwinding or catching up on assignments. And during Ramadan, the campus transforms completely. There’s this beautiful sense of togetherness — everyone sharing iftar, late-night tarawih prayers in the mosque, and that extra calm in the air. It’s these little things that make student life here feel more like a family than just a university.', 'post-1.jpg', '2025-06-28', 'active'),
(33, 21, 'Nashit Rahman', 'Faculty Spotlights: Meet Our Professors', 'What surprised me most was how accessible our teachers are - from late-night email responses to mentoring beyond coursework. When I joined IIUC, I expected the usual student-teacher formality: classes, attendance, exams, repeat. But honestly, what surprised me most was how accessible our faculty actually are.\r\n\r\nIt’s not just about lectures. I’ve had teachers respond to emails late at night before an exam, hop on quick Zoom calls to explain something again, and even guide students through project ideas that aren’t technically part of the course. Some even follow up after the semester just to ask how we’re doing in other subjects or competitions.\r\n\r\nIt creates this support system that feels like mentorship rather than just instruction. I’ve personally grown more confident asking questions and taking on extra work because I know there’s someone willing to guide me if I get stuck.', 'post-2.jpg', '2025-06-28', 'active'),
(34, 22, 'Zara Hossain', 'Finding My Community at IIUC', 'As someone who really struggled to fit in at my previous university, transferring to IIUC was nerve-wracking. I thought I’d just keep my head down, attend classes, and leave. But honestly, the environment here surprised me in the best way.\r\n\r\nFrom day one, people actually talked to me. My classmates invited me to group chats, helped me catch up on missed topics, and even dragged me (nicely) into club meetings and campus events. It wasn’t just surface-level friendliness — people genuinely wanted to help each other out.\r\n\r\nWhat really made the difference were the student-led initiatives. Whether it was peer study circles, tech clubs, language meetups, or just random movie nights in the dorm lounge, there was always something going on — and students were the ones organizing it. That sense of student ownership over the community made it way easier to participate without feeling like an outsider.\r\n\r\nNow, I’ve got people to study with, chill with, and even plan small projects with. IIUC isn’t just where I go for classes — it’s where I found my rhythm again.', 'post-3.jpg', '2025-06-28', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `price`, `image`) VALUES
(21, 'c223265', 'Algorithms and Data Structures (Basic Toolbox)', 470, 'book-5.png'),
(22, 'c223265', 'Pharmaceutical Biotechnology (4th Edition)', 450, 'book-8.png'),
(23, 'c223265', 'Property Law (2022-2023 Edition)', 400, 'discount-book-1.png'),
(24, 'c223265', 'Data Communications and Networking (Indian Edition)', 450, 'book-1.png'),
(25, 'c223261', 'CSE1101 notes – Fall 2023', 160, 'istockphoto-482541996-612x612.jpg'),
(26, 'c223261', 'PHY3201 notes – Spring 2025', 200, 'hq720.jpg'),
(27, 'c223261', 'Physics Lab Final Viva Questions – All Semesters', 70, '11.jpg'),
(28, 'c223261', 'CSE1101 Past Questions + Solved MCQs (2019–2024)', 80, '55.jpg'),
(29, 'c223261', 'The Design of a Microprocessor', 400, 'book-4.png'),
(30, 'c223261', 'Critical Analysis of Science Textbooks', 290, 'book-6.png'),
(31, 'c223256', 'Primary Hematology', 460, 'book-7.png'),
(32, 'c223256', 'Naval Architecture (6th Edition)', 460, 'book-2.png'),
(33, 'c223256', 'Introduction to Algorithms', 410, 'book-9.png'),
(34, 'c223256', 'Turbo C++ Full Installer + Windows 11 Guide', 110, '124.jpg'),
(35, 'c223256', 'XAMPP & MySQL Setup Pack for DBMS Course', 80, 'tao-mysql-xampp-2.jpg'),
(36, 'c223256', 'EEE Concepts Simplified – Screen Recording', 40, 'maxresdefault.jpg'),
(37, 'c223256', 'Principles of Criminal Law', 350, 'home-book-4.png'),
(38, 'c223256', 'Software Engineering', 510, 'home-book-1.png'),
(39, 'c223261', 'Academic Portfolio for BBA Students – Canva File', 90, '84.jpg'),
(40, 'c223261', 'Private Math Tutor – MTH1101 (1:1 Support) [hour rate]', 2800, 'aj-math-tutor.jpg'),
(41, 'c223261', 'Orthodontics for Dental Students (3rd Edition)', 370, 'book-10.png'),
(42, 'c223265', 'CSE4201 Lecture Slides Printed – Full Semester', 230, '2-231208051019-11cbf66e-thumbnail.jpg'),
(43, 'c223265', 'C Programming Syntax Cheat Sheet (Colorful PDF)', 40, '544.jpg'),
(44, 'c223265', 'Oracle SQL Setup + Screenshot Walkthrough', 60, 'gs_admin_consl.jpg'),
(45, 'c223256', 'Human Psychology', 390, 'book-3.png'),
(46, 'c223256', 'Principles of Agricultural Economics', 340, 'economic.jpg'),
(47, 'c223256', 'The Architecture Book', 490, 'home-book-2.png'),
(48, 'c223256', 'History of Modern Architecture', 410, 'history_of_modern_architecture.jpg'),
(49, 'c223265', 'Networking Protocols Diagram – PDF Poster', 130, '2550484627_6b8b62f943.jpg'),
(50, 'c223265', '1-on-1 Database Coaching – Concept Revision [hour rate]', 1900, 'One-on-One-Professional-Coaching.jpg'),
(51, 'c223265', 'Theory of Computation', 430, '61nojsDH3zL._UF1000,1000_QL80_.jpg'),
(52, 'c223265', 'Internship CV Template – IIUC CSE Students', 150, 'Research-Intern-Resume-Sample.jpg'),
(53, 'c223265', 'BBA 2nd Year – Business Statistics Short Notes', 210, 'mini_magick20190114-15597-vds88c.png'),
(54, 'c223261', 'Artificial Intelligence: A Modern Approach (2nd Edition)', 390, '27543.jpg'),
(55, 'c223261', 'CSE Coding Interview Basics – Practice Sheet', 110, 'ezgif.com-webp-to-jpg-converter.jpg'),
(56, 'c223256', 'Introduction to Modern Statistics', 430, '0_TTH2gBCW3QbMSyj-.png');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(100) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `seller_id`, `name`, `email`, `password`) VALUES
(9, 'c223265', 'Farhana Akhter', 'c223265@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0'),
(10, 'c223261', 'Meheri Monir', 'c223261@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0'),
(11, 'c223256', 'Riktika Talukder', 'c223256@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(15, 'Farhana Akhter', 'c223265@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(16, 'Riktika Talukder', 'c223256@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(17, 'Meheri Monir', 'c223261@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(18, 'Saifuddin Ahmed', 'c992831@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(19, 'Tariq Hasan', 'c774321@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(20, 'Fatima Chowdhury', 'c983374@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(21, 'Nashit Rahman', 'c542272@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user'),
(22, 'Zara Hossain', 'c881624@ugrad.iiuc.ac.bd', '10e40df3fa1e340e3ffeda257df2afa0', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
