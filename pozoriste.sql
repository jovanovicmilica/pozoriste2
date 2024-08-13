-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 02:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pozoriste`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `idPoll` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `idPoll`) VALUES
(7, 'Online', 1),
(8, 'Cash desk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `sendingDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `email`, `subject`, `message`, `sendingDate`) VALUES
(8, 'test@gmail.com', 'Test', 'test test test test test test test test test test test test test test test test ', '2022-06-29 16:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `preview` int(1) NOT NULL,
  `priority` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `name`, `path`, `preview`, `priority`) VALUES
(1, 'Home', 'index.php', 1, 1),
(2, 'Performances', 'performances.php', 1, 5),
(3, 'Repertoire', 'repertoire.php', 1, 10),
(4, 'Tickets', 'tickets.php', 3, 10),
(5, 'Login', 'login.php', 2, 25),
(6, 'Log out', 'logout.php', 3, 25),
(7, 'Admin panel', 'admin/index.php', 4, 20),
(8, 'Contact', 'contact.php', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `performances`
--

CREATE TABLE `performances` (
  `id` int(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `poster` varchar(255) NOT NULL,
  `premier` date NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `performances`
--

INSERT INTO `performances` (`id`, `name`, `description`, `poster`, `premier`, `duration`) VALUES
(1, 'Dogs', 'The play is based on the text by Christopher J. Johnson\'s The Dog Logs, an Australian actor, director and writer, was translated into Serbian by Milica Mihailović. The actors in the play play 14 breeds of dogs, on an almost empty stage, using only the text and their acting skills. Through a lot of laughter, but also a few sad, almost tragic stories, the play shows and re-examines the human attitude towards dogs, which give us unlimited and unconditional love. Apart from cities all over Serbia, \"Dogs\" often visit Croatia (Krk, Pula, Rijeka, Poreč, Zagreb, Osijek, soon in Split and Zadar), they recently toured in Canada, Switzerland and Norway.', 'kerovi.jpg', '2020-06-12', 120),
(2, 'Be careful of what you want', 'The play \"Be careful of what you want\" was based on Norma Foster\'s \"Love List\". The original text of the play was first performed in 2003 at the Thousand Islands Playhouse in Cananoque, Ontario.\n\nWhat happens when two men, played by Aleksandar Radojicic and Radovan Vujovic, fall into the trap of looking for the perfect woman? With intelligent humor, great plot and a serious dilemma - whether there is an ideal partner, the talented acting trio, together with Aleksandra Tomić, always delights the audience wherever this great comedy is performed.', 'psz.jpg', '2018-02-08', 100),
(7, 'FRANKIE & JOHNNY', 'Frankie and Johnny is a topical and necessary piece, because we all act as if we were so emotionally hurt by birth that for the rest of our lives we should defend ourselves from our own illusions behind our shields of inviolability, and that inevitably leads to emptiness. This piece is about taking off armor and guards. About allowing the opportunity to be loved. About allowing the possibility of us being hurt. We all seek love, but are we capable of love? This game of chess between two intelligent and attractive, but emotionally crippled people, is still touching because they agree to give a chance to a relationship that seems doomed from the start and win us over with the idea that \"outsiders\" can easily enter the port of love. Because, as Johnny says: You never choose love. She chooses you.', '1656454151Frenki-i-Dzoni-67.jpg', '2022-01-11', 100),
(14, 'Boing Boing', 'Mark Kamoleti\'s Boeing Boeing is a hit comedy of the 60\'s. The first performances in London and Paris were played for twenty years. The play has been premiered more than 200 times, and 4 films have been made, the most famous of which is with Jerry Lewis and Tony Curtis in the lead roles. It is interesting that the original text was so often adapted and adapted to the climate, so the performances very often moved away from what it essentially is: vaudeville. The adaptation made by Branislava Ilić is based on a comedy of the situation and is deprived of unnecessary humor for what is already obviously funny. The revival of the spirit of Paris in the 1960s gives the play a special style because this piece works best in the context of the time in which it was written, which is a time of great changes: the emergence of the hippie movement, breaking sexist and racist taboos, television and popular culture. Mathematically accurate, set in Paris at the time, the Boeing Boeing play is a funny but also poetic story.', '16564539106N2A6263-scaled.jpg', '2016-01-12', 100),
(15, 'My whole body hurts here', 'The comedy The whole body hurts me here, it plays with the current, modern diseases of society, combining them with the all-time problems that accompany the relationship between the dominant mother and the only son; a relationship that ranges from fierce conflicts to extremely close relationships dominated by the mother\'s petty bourgeoisie and the son\'s pampering.\r\n \r\nThe mother decides to secretly, without her son\'s knowledge, write advertisements and paste them on Košutnjak and Banovo brdo as her son gives math classes, in order to start him and pull him out of the apathy and extreme depression he fell into. The two of them live in a big house on Banovo brdo. Their father and husband, Zivan, died a long time ago, and the two of them were left to live a limp and boring life, in a community that is by no means natural.\r\n \r\nThe son does nothing, just blows the grass and watches TV, sinking into utter disinterest in life and the world outside. One morning, a young woman enters the house, who needs math instruction. It triggers a whole series of situations that, in the end, with an abundance of comic twists, dramatically affect their lives. After that morning, nothing will be the same in their lives.\r\n \r\nThe play is based on the motives of the Lesson, by Eugene Ionesco, and tells an absurd story about our time, which, in many ways, can be called - the time of the absurd.', 'aaa.png', '2020-11-18', 120),
(16, '#CATROASTED', 'It\'s hard to explain \"butterflies in the stomach\"… happiness, joy of recognition, closeness and passion are what connected\r\nSofia and Petra. They are both realized personalities, independent emotionally and financially, Sofia is the mother of a beautiful bride\r\ngirls, and Peter successful, full of self-confidence, a man that any modern woman would want. From one seemingly\r\nof a completely insignificant event the relationship begins to change. Doubt, mistrust, desire for control appear,\r\ninsecurity and lack of respect. The play \"#CoanBake\" deals with a love affair in which it slowly disappears\r\nself-esteem, internal boundaries and in which two people together sink into the darkness of rudeness and hurt. Which\r\na moment when you need to give up a love affair that is no longer?', '1656454943CYBER-MONDAY-8.jpg', '2022-06-06', 120),
(17, 'GOLDEN CHAIN OF JEWELRY', 'Kostadin - Lale came to Belgrade full of hopes and expectations. But, like any man who is in love with himself and an easy life, he quickly realizes that the years have passed, he has not finished school, and all the businesses he started have failed. There are a lot of beautiful girls, but he needs someone to support him - some rich girl. And such a rush! He is delighted, he reckons that he cheated on her and her family, however, the family of the rich would not be rich if someone like Lale could cheat them…', '16564550976N2A4982-scaled.jpg', '2020-07-18', 70),
(18, 'DUST', 'How many times have you put yourself in the shoes of a lottery millionaire?\r\n\r\nThey say that theater that achieves identification with the viewer can affect his consciousness. Then we are in a big challenge, because one married couple has a lottery ticket worth two million on the table and that is of course just their beginning. This is a story about us. Our permanent transition, hopes and eternal struggle.', '1656455376prah.png', '2020-04-27', 140),
(19, 'I GO ON THE WAY AND HUG THE TREE', 'The text of the play \"I\'m going on the road and I hug a tree\" was written by Miodrag Karadžić, and the play was premiered in 2019 at the Theater on Brdo.\r\n\r\nAndrija Milošević in a hilarious comic story about a son whose mother is looking for a real wife. The candidates take turns, and he and his mother have incredible experiences. However, when the \"real\" one knocks on the door, our hero will meet his destiny in all its splendor.', '1656455581Idem-putem-pa-zagrlim-DRVO-33-scaled.jpg', '2022-04-13', 100);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `question`, `active`) VALUES
(1, 'Do you prefer selling online or at the cash desk?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(255) NOT NULL,
  `price` int(10) NOT NULL,
  `dateFrom` date NOT NULL DEFAULT current_timestamp(),
  `idPerformance` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `price`, `dateFrom`, `idPerformance`) VALUES
(1, 1000, '2022-06-18', 1),
(2, 1200, '2022-06-19', 2),
(7, 1300, '2022-06-29', 7),
(9, 1200, '2022-06-29', 14),
(10, 1000, '2022-06-29', 15),
(11, 1400, '2022-06-29', 16),
(12, 1000, '2022-06-29', 17),
(13, 1200, '2022-06-29', 18),
(14, 1100, '2022-06-29', 19);

-- --------------------------------------------------------

--
-- Table structure for table `repertoire`
--

CREATE TABLE `repertoire` (
  `id` int(255) NOT NULL,
  `idPrice` int(255) NOT NULL,
  `datePerforming` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repertoire`
--

INSERT INTO `repertoire` (`id`, `idPrice`, `datePerforming`) VALUES
(1, 1, '2022-06-30'),
(3, 2, '2022-07-09'),
(6, 1, '2022-07-01'),
(7, 2, '2022-07-02'),
(8, 7, '2022-07-03'),
(9, 9, '2022-07-04'),
(10, 10, '2022-07-05'),
(12, 13, '2022-07-07'),
(13, 14, '2022-06-29'),
(14, 9, '2022-07-14'),
(15, 11, '2022-07-15'),
(16, 13, '2022-07-17'),
(17, 2, '2022-07-30'),
(18, 7, '2022-07-24'),
(19, 1, '2022-07-25'),
(20, 12, '2022-07-06'),
(21, 12, '2022-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(255) NOT NULL,
  `idRepertoire` int(255) NOT NULL,
  `idUser` int(11) NOT NULL,
  `row` int(10) NOT NULL,
  `place` int(10) NOT NULL,
  `position` int(1) NOT NULL,
  `purchaseDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `idRepertoire`, `idUser`, `row`, `place`, `position`, `purchaseDate`) VALUES
(18, 1, 1, 2, 10, 1, '2022-06-27'),
(19, 1, 1, 2, 10, 2, '2022-06-27'),
(21, 1, 1, 2, 11, 3, '2022-06-27'),
(44, 1, 2, 1, 2, 2, '2022-06-28'),
(45, 1, 2, 1, 1, 2, '2022-06-28'),
(49, 13, 2, 1, 10, 1, '2022-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `useranswers`
--

CREATE TABLE `useranswers` (
  `id` int(255) NOT NULL,
  `idAnswer` int(255) NOT NULL,
  `idUser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useranswers`
--

INSERT INTO `useranswers` (`id`, `idAnswer`, `idUser`) VALUES
(5, 8, 13),
(6, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `activationcode` varchar(255) NOT NULL,
  `registrationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `idRole` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `active`, `activationcode`, `registrationDate`, `idRole`) VALUES
(1, 'User', 'User', 'user@gmail.com', 'c37c6474f327735b620b4d4a3f684560', 1, '//', '2022-06-25 22:51:40', 2),
(2, 'Admin', 'Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1, '//', '2022-06-25 22:51:40', 1),
(13, 'Aaa', 'Aaa', 'petar.petrovic.51.21@ict.edu.rs', 'a7be72d58029707f81b90ef7177b1418', 1, '6344a4c373f9d832a898f1e0cd082b37', '2022-06-26 23:53:53', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPoll` (`idPoll`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performances`
--
ALTER TABLE `performances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPerformance` (`idPerformance`);

--
-- Indexes for table `repertoire`
--
ALTER TABLE `repertoire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPrice` (`idPrice`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRepertoire` (`idRepertoire`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `useranswers`
--
ALTER TABLE `useranswers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAnswer` (`idAnswer`) USING BTREE,
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRole` (`idRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `performances`
--
ALTER TABLE `performances`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `repertoire`
--
ALTER TABLE `repertoire`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `useranswers`
--
ALTER TABLE `useranswers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`idPoll`) REFERENCES `poll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`idPerformance`) REFERENCES `performances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repertoire`
--
ALTER TABLE `repertoire`
  ADD CONSTRAINT `repertoire_ibfk_1` FOREIGN KEY (`idPrice`) REFERENCES `prices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`idRepertoire`) REFERENCES `repertoire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useranswers`
--
ALTER TABLE `useranswers`
  ADD CONSTRAINT `useranswers_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useranswers_ibfk_2` FOREIGN KEY (`idAnswer`) REFERENCES `answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
