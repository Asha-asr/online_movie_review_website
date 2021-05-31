-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 01:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_review_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(250) NOT NULL,
  `genre_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Comedy'),
(5, 'Drama'),
(6, 'Historical'),
(7, 'Horror'),
(8, 'Science fiction'),
(9, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `Id` int(100) NOT NULL,
  `movie_title` varchar(250) NOT NULL,
  `movie_year` int(250) NOT NULL,
  `movie_image` varchar(500) NOT NULL,
  `movie_genre` varchar(250) NOT NULL,
  `movie_director` varchar(250) NOT NULL,
  `movie_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`Id`, `movie_title`, `movie_year`, `movie_image`, `movie_genre`, `movie_director`, `movie_description`) VALUES
(10, 'PROJECT POWER', 2020, 'images/PROJECT POWER.jpg', '1', 'Henry Joost, Ariel Schulman', 'A former soldier teams up with a cop to find the source behind a dangerous pill that provides temporary superpowers.'),
(11, 'Monster Hunter', 2020, 'images/Monster Hunter.jpg', '2', 'Paul W. S. Anderson', 'Behind our world, there is another -- a world of dangerous and powerful monsters that rule their domain with deadly ferocity. When Lt. Artemis and her loyal soldiers are transported from our world to the new one, the unflappable lieutenant receives the shock of her life.'),
(12, 'Lord of the Rings The Fellowship of the Ring', 2002, 'images/Lord of the Rings The Fellowship of the Ring.jpg', '2', ' Peter Jackson', 'A young hobbit, Frodo, who has found the One Ring that belongs to the Dark Lord Sauron, begins his journey with eight companions to Mount Doom, the only place where it can be destroyed.'),
(13, 'SOUL', 2020, 'images/SOUL.jpg', '3', 'Pete Docter, Kemp Powers', 'A jazz musician, stuck in a mediocre job, finally gets his big break. However, when a wrong step takes him to the Great Before, he tries to help an infant soul in order to return to reality.'),
(14, 'Pacific Rim', 2013, 'images/Pacific Rim.jfif', '1', ' Guillermo del Toro, Steven S. DeKnight', 'The film is regarded as an homage to kaiju, mecha, and anime media. A sequel titled Pacific Rim: Uprising was released on March 23, 2018, with Universal Pictures distributing.'),
(18, 'Chathur Mukham', 2021, 'images/Chathur Mukham.jfif', '7', ' Ranjeet Kamala Sankar, Salil Menon', 'Chathurmukham opens with a murder caused by an unseen force. A smartphone lying next to the corpse empties its battery by itself. The film then moves on to the task of presenting its protagonist, Thejaswini (Manju Warrier), a selfie-obsessed woman who lives as though she was born with the gadget.'),
(20, 'Marakkar-Lion of the Arabian Sea', 2021, 'images/Marakkar-Lion of the Arabian Sea.jpg', '2', 'Priyadarshan', 'The story of the legendary Kunjali Marakkar IV and his epic warfare against the Portuguese.'),
(21, 'Onward', 2020, 'images/Onward.jpg', '3', 'Dan Scanlon', 'In a magical realm where technological advances have taken over, Ian and Barley, two elven brothers, set out on an epic adventure to resurrect their late father for a day.'),
(22, 'Trolls World Tour', 2020, 'images/Trolls World Tour.jpg', '3', 'Walt Dohrn', 'When Queen Barb of the Rock tribe decides to destroy all other genres of music by stealing their techno strings and bringing them under her rule, Queen Poppy sets out to thwart her evil plans.'),
(23, 'Drishyam 2', 2021, 'images/Drishyam 2.jfif', '9', 'Jeethu Joseph', 'Drishyam 2: The Resumption, or simply Drishyam 2, is a 2021 Indian Malayalam-language crime drama film written and directed by Jeethu Joseph and produced by Antony Perumbavoor through the company Aashirvad Cinemas.'),
(24, 'The Priest', 2021, 'images/The Priest.jfif', '7', 'Jofin T. Chacko', 'A priest and a police officer try to solve a set of mysterious suicides. As their investigation closes in, they discover another crime with even farther-reaching consequences.'),
(26, 'Barroz ', 2021, 'images/Barroz .jpg', '2', 'Mohanlal', 'Barroz: Nidhi Kaakkum Bhootham is an upcoming Indian Malayalam-language fantasy adventure film directed by Mohanlal in his directorial debut. '),
(27, 'Anugraheethan Antony', 2021, 'images/Anugraheethan Antony.jpg', '5', 'Prince Joy', 'Antonys dad is disappointed by him. He brings home two of his friends to try and make him change.'),
(29, 'Justice League Dark Apokolips War', 2020, 'images/Justice League Dark Apokolips War.jpg', '1', 'Christina Sotta', 'Following the decimation of Earth, the Justice League regroups to take on Darkseid and save the remaining survivors.'),
(30, 'Aadu 3', 2020, 'images/Aadu 3.jpg', '4', 'Midhun Manuel Thomas', 'Aadu 3 is a malayalam comedy movie directed by Midhun Manuel Thomas. The movie stars Jayasurya, Sunny Wayne, Vinayakan, Vijay Babu, Saiju Kurup etc. in prominent roles. '),
(31, 'Two Countries', 2015, 'images/Two Countries.jpg', '4', 'Shafi', 'An immoral man decides to marry a woman with physical disabilities to avoid repayment of a loan. Later, he changes his stance when he gets a chance to marry a wealthy alcoholic.'),
(32, 'Anveshanam', 2020, 'images/Anveshanam.jpg', '9', 'Prasobh Vijayan', 'When Aravind learns that something unexpected has happened to his family, he rushes out to meet them in the hospital, only to find himself in an unforeseen situation.'),
(33, 'Alone', 2020, 'images/Alone.jpg', '9', 'John Hyams', 'A cold-blooded killer hunts a widow in the wilderness after she escapes from his remote cabin in the Pacific Northwest.'),
(34, 'Kerala Varma Pazhassi Raja', 2009, 'images/Kerala Varma Pazhassi Raja.jpg', '6', 'Hariharan', 'In 1796, Kerala Varma, king of Pazhassi, leaves his kingdom due to the East India Company and seeks refuge in the Wayanad forests. He then uses guerrilla warfare tactics against his enemies.'),
(35, 'Kayamkulam Kochunni', 2018, 'images/Kayamkulam Kochunni.jpg', '6', 'Rosshan Andrrews', 'Ill-treated since childhood by the wealthy people, Kayamkulam Kochunni decides to steal from the rich and feeds the poor and the lower caste community, thus growing into a hero for the downtrodden.'),
(36, 'Coma', 2019, 'images/Coma.jpg', '8', 'Nikita Argunov', 'A man awakens in a chaotic dystopian world filled with memories of comatose patients and nonexistent laws of physics.'),
(37, 'Mortal Engines', 2018, 'images/Mortal Engines.jpg', '8', 'Christian Rivers', 'In a post-apocalyptic world where cities move and consume each other to survive, two strangers come together to stop a sinister and destructive conspiracy.');

-- --------------------------------------------------------

--
-- Table structure for table `new-registration`
--

CREATE TABLE `new-registration` (
  `u_id` int(100) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `phone_no` int(250) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new-registration`
--

INSERT INTO `new-registration` (`u_id`, `full_name`, `user_name`, `phone_no`, `email_address`, `password`) VALUES
(1, 'seetha', 'ashauser', 2147483647, 'asharamankutty20@gmail.com', 0),
(2, 'seetha', 'seethauser', 2147483647, 'homeinteriorkochi@gmail.com', 0),
(3, 'Renjith', 'renjithuser', 2147483647, 'renjithassociatesonline@gmail.com', 0),
(4, 'Raman', 'ramanuser', 2147483647, 'asharamankutty20@gmail.com', 0),
(5, 'Raman', 'ramanuser', 2147483647, 'asharamankutty20@gmail.com', 0),
(6, 'Raman', 'ramanuser', 2147483647, 'asharamankutty20@gmail.com', 0),
(7, 'Janaki', 'janaki', 2147483647, 'homeinteriorkochi@gmail.com', 1),
(8, 'sajan', 'sajan', 2147483647, 'homeinteriorkochi@gmail.com', 5),
(9, 'reghu', 'reghu', 2147483647, 'asharamankutty20@gmail.com', 0),
(10, 'Maria', 'mariauser', 2147483647, 'asharamankutty20@gmail.com', 6),
(11, 'Maria', 'mariauser', 2147483647, 'asharamankutty20@gmail.com', 6),
(12, 'Josesh', 'joseph', 2147483647, 'asharamankutty20@gmail.com', 97),
(13, 'Josesh', 'joseph', 2147483647, 'asharamankutty20@gmail.com', 97),
(14, 'Geetha', 'geethauser', 2147483647, 'asharamankutty20@gmail.com', 49),
(15, 'admin', 'admin', 2147483647, 'asharamankutty20@gmail.com', 2147483647),
(16, 'Johny', 'johny', 2147483647, 'homeinteriorkochi@gmail.com', 0),
(17, 'Thomas', 'thomas', 2147483647, 'renjithassociatesonline@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(100) NOT NULL,
  `movie_id` int(100) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `review` text NOT NULL,
  `score` int(100) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `movie_id`, `user_name`, `review`, `score`, `submit_date`) VALUES
(4, 10, 'john', 'Secong Attempt to post a review\r\n', 5, '2021-05-05 10:54:14'),
(5, 10, 'john', 'Secong Attempt to post a review\r\n', 5, '2021-05-05 10:54:57'),
(6, 10, 'john', 'Secong Attempt to post a review\r\n', 5, '2021-05-05 11:38:31'),
(7, 12, 'john', 'my third revie', 5, '2021-05-05 12:33:02'),
(8, 13, 'john', 'review for soul', 5, '2021-05-05 12:54:46'),
(9, 13, 'john', 'review for soul', 5, '2021-05-05 13:01:40'),
(10, 10, 'renjithuser', 'Third Review', 5, '2021-05-05 17:59:27'),
(11, 11, 'renjithuser', 'Third review', 5, '2021-05-05 18:00:12'),
(12, 11, 'renjithuser', 'Third review', 5, '2021-05-05 18:18:16'),
(13, 11, 'asha', 'Attempt to post a review', 5, '2021-05-06 09:50:42'),
(17, 14, 'john', 'Second Review from john', 5, '2021-05-06 12:25:19'),
(18, 10, 'asha', 'Review on Friday', 5, '2021-05-07 09:32:41'),
(19, 10, 'asha', 'Review on Friday', 5, '2021-05-07 09:34:30'),
(20, 10, 'asha', 'Review on Friday', 5, '2021-05-07 09:36:20'),
(21, 10, 'asha', 'Review on Friday', 5, '2021-05-07 09:36:34'),
(22, 10, 'asha', 'Review on Friday', 5, '2021-05-07 10:17:28'),
(23, 10, 'john', 'Review on Friday', 5, '2021-05-07 10:52:56'),
(24, 10, 'asha', 'Loging session review', 5, '2021-05-07 11:27:06'),
(25, 10, 'asha', 'Loging session review', 5, '2021-05-07 11:46:41'),
(26, 10, 'asha', 'Loging session review', 5, '2021-05-07 11:46:55'),
(27, 10, 'asha', 'Review without login', 5, '2021-05-07 11:47:05'),
(28, 18, 'janaki', 'First Review from Janaki', 5, '2021-05-07 12:46:56'),
(29, 22, 'joseph', 'First Review', 5, '2021-05-07 14:18:15'),
(30, 10, 'joseph', 'Review on top', 5, '2021-05-07 21:19:18'),
(31, 10, 'joseph', 'good', 1, '2021-05-08 08:46:24'),
(32, 10, 'joseph', 'gooood', 4, '2021-05-08 08:49:19'),
(33, 12, 'johny', 'My first Review', 5, '2021-05-11 10:23:26'),
(34, 10, 'admin', '', 2, '2021-05-14 12:25:09'),
(35, 10, 'admin', '', 5, '2021-05-15 11:34:47'),
(36, 18, 'joseph', 'First Review from Joseph', 5, '2021-05-19 15:54:27'),
(37, 27, 'geethauser', 'First review from Geetha', 5, '2021-05-19 19:51:43'),
(38, 11, 'mariauser', '2 Rating added', 2, '2021-05-25 10:42:30'),
(39, 13, 'mariauser', 'two rating movie', 2, '2021-05-25 10:43:00'),
(40, 24, 'mariauser', 'two rating film', 2, '2021-05-25 10:43:41'),
(41, 12, 'mariauser', 'three star movie', 3, '2021-05-25 12:15:40'),
(42, 37, 'mariauser', 'Three star movie', 3, '2021-05-25 12:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(50) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `type` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_name`, `password`, `role`, `type`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055\r\n', 'admin', 1),
(4, 'asha', '1a2b', 'user', 2),
(6, 'john', 'asdf', 'user', 3),
(8, 'renjithuser', 'Renjith@123', 'user', 3),
(9, 'ramanuser', 'Raman@123', 'user', 3),
(10, 'ramanuser', 'Raman@123', 'user', 3),
(11, 'ramanuser', 'Raman@123', 'user', 3),
(12, 'janaki', '1b4f0f64bcd7f33cca2536623c84baec', 'user', 3),
(13, 'sajan', '5be890cc1a9e204e8578e4b66ba83a54', 'user', 3),
(14, 'reghu', 'b553c62ea29066906fc2855dfa284209', 'user', 3),
(15, 'mariauser', '6b5bf6b60874f323fcf072fcc9669fcf', 'user', 3),
(16, 'mariauser', '6b5bf6b60874f323fcf072fcc9669fcf', 'user', 3),
(17, 'joseph', '97c8374861d04dd333852eb18fc28793', 'user', 3),
(18, 'joseph', '97c8374861d04dd333852eb18fc28793', 'user', 3),
(19, 'geethauser', '49f96c5ee9330cfb51204843ce87b149', 'user', 3),
(20, 'admin', '0e7517141fb53f21ee439b355b5a1d0a', 'user', 3),
(21, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 1),
(22, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 1),
(23, 'johny', 'a950d702cd726c8b22735f4d924e2319', 'user', 3),
(24, 'thomas', 'f640fdc2c16617522f43c94a634d7c3c', 'user', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `new-registration`
--
ALTER TABLE `new-registration`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `new-registration`
--
ALTER TABLE `new-registration`
  MODIFY `u_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
