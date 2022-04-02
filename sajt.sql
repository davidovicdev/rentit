-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 02:24 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sajt`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answerID` int(11) NOT NULL,
  `answerName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL,
  `surveyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answerID`, `answerName`, `votes`, `surveyID`) VALUES
(20, 'BMW', 225, 1),
(21, 'Audi', 183, 1),
(30, 'Mercedes', 123, 1),
(31, 'Honda', 111, 1),
(34, 'Toyota', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `carsID` int(11) NOT NULL,
  `cars_brandID` int(11) NOT NULL,
  `model` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `km` int(11) NOT NULL,
  `driveID` int(11) NOT NULL,
  `cars_bodyID` int(11) NOT NULL,
  `top_speed` int(11) NOT NULL,
  `kw` int(11) NOT NULL,
  `transmissionID` int(11) NOT NULL,
  `color` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imageID` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`carsID`, `cars_brandID`, `model`, `km`, `driveID`, `cars_bodyID`, `top_speed`, `kw`, `transmissionID`, `color`, `imageID`, `price`) VALUES
(3, 7, '500L', 180000, 5, 2, 220, 80, 4, 'Red', 1, 10),
(4, 6, 'Accord', 120000, 5, 1, 270, 100, 5, 'Red', 4, 17),
(5, 2, 'E Class', 80000, 6, 1, 270, 110, 1, 'White', 5, 25),
(6, 1, '320d', 21000, 4, 1, 270, 110, 1, 'Blue', 12, 25),
(7, 1, 'Z4', 360000, 4, 5, 280, 120, 1, 'Black', 11, 30),
(8, 6, 'Civic Type R', 160000, 5, 1, 270, 100, 4, 'White', 13, 30),
(9, 11, 'Clio 4', 140000, 5, 2, 150, 70, 4, 'Yellow', 6, 10),
(10, 10, 'C Max', 170000, 5, 6, 190, 100, 5, 'White', 7, 12),
(11, 10, 'Focus', 210000, 5, 2, 170, 85, 4, 'Grey', 10, 12),
(12, 5, 'Golf 6', 160000, 5, 2, 220, 110, 4, 'Black', 9, 14),
(13, 5, 'Passat ', 120000, 5, 3, 210, 90, 4, 'White', 18, 15),
(14, 5, 'Sharan', 210000, 5, 6, 190, 80, 5, 'White', 14, 13),
(15, 2, 'SLK', 120000, 6, 4, 280, 120, 2, 'Grey', 15, 35),
(16, 3, 'TT', 85000, 5, 4, 250, 95, 4, 'Grey', 17, 35),
(17, 13, '5008', 73000, 6, 7, 210, 100, 5, 'Blue', 20, 18),
(18, 3, 'A4', 53000, 6, 1, 270, 120, 1, 'Black', 21, 30),
(19, 3, 'A8', 40000, 6, 1, 280, 130, 1, 'Black', 22, 35),
(20, 4, 'Astra', 150000, 5, 2, 150, 80, 4, 'Grey', 23, 13),
(21, 12, 'C3', 180000, 5, 2, 165, 80, 4, 'Blue', 24, 18),
(22, 12, 'Captur', 130000, 5, 2, 170, 90, 4, 'White', 25, 18),
(23, 4, 'Corsa', 180000, 5, 2, 180, 85, 4, 'Grey', 26, 15),
(24, 6, 'CRV', 94000, 6, 7, 210, 100, 5, 'Black', 27, 23),
(25, 12, 'DS3', 137000, 5, 2, 180, 90, 4, 'Grey', 28, 15),
(26, 10, 'Fiesta', 85000, 5, 2, 190, 95, 4, 'Yellow', 29, 17),
(27, 5, 'Golf 7', 44000, 5, 2, 240, 110, 1, 'Black', 30, 24),
(28, 10, 'Ka', 210000, 5, 2, 150, 75, 3, 'White', 31, 13),
(29, 3, 'Q7', 84000, 6, 7, 240, 115, 1, 'Black', 32, 28),
(30, 9, 'Sorento', 135000, 5, 7, 210, 105, 5, 'White', 33, 23),
(31, 9, 'Sportage', 180000, 5, 7, 190, 90, 4, 'Red', 34, 19),
(32, 7, 'Tipo', 145000, 5, 1, 180, 90, 4, 'Grey', 35, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cars_body`
--

CREATE TABLE `cars_body` (
  `cars_bodyID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars_body`
--

INSERT INTO `cars_body` (`cars_bodyID`, `name`) VALUES
(1, 'sedan'),
(2, 'hatchback'),
(3, 'wagon'),
(4, 'coupe'),
(5, 'roadster'),
(6, 'minivan'),
(7, 'SUV'),
(8, 'pickup');

-- --------------------------------------------------------

--
-- Table structure for table `cars_brand`
--

CREATE TABLE `cars_brand` (
  `cars_brandID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars_brand`
--

INSERT INTO `cars_brand` (`cars_brandID`, `name`) VALUES
(3, 'Audi'),
(1, 'BMW'),
(12, 'Citroen'),
(7, 'Fiat'),
(10, 'Ford'),
(8, 'GMC'),
(6, 'Honda'),
(9, 'Kia'),
(2, 'Mercedes'),
(4, 'Opel'),
(13, 'Peugeot'),
(11, 'Renault'),
(5, 'Volkswagen');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `firstName`, `lastName`, `email`, `message`) VALUES
(9, 'Test', 'Test', 'test123@gmail.com', 'Works works works works works works works works works');

-- --------------------------------------------------------

--
-- Table structure for table `drive`
--

CREATE TABLE `drive` (
  `driveID` int(11) NOT NULL,
  `name` char(3) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drive`
--

INSERT INTO `drive` (`driveID`, `name`) VALUES
(4, 'RWD'),
(5, 'FWD'),
(6, 'AWD');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageID` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageID`, `path`) VALUES
(1, 'assets/img/upload/500L.png'),
(4, 'assets/img/upload/accord.png'),
(5, 'assets/img/upload/eClass.png'),
(6, 'assets/img/upload/clio.png'),
(7, 'assets/img/upload/cMax.png'),
(9, 'assets/img/upload/golf6.png'),
(10, 'assets/img/upload/focus.png'),
(11, 'assets/img/upload/bmwZ4.png'),
(12, 'assets/img/upload/bmw3.png'),
(13, 'assets/img/upload/civicTypeR.png'),
(14, 'assets/img/upload/sharan.png'),
(15, 'assets/img/upload/slk.png'),
(16, 'assets/img/upload/x5.png'),
(17, 'assets/img/upload/tt.png'),
(18, 'assets/img/upload/passatWagon.png'),
(19, 'assets/img/upload/aClass.png'),
(20, 'assets/img/upload/5008.png'),
(21, 'assets/img/upload/a4.png'),
(22, 'assets/img/upload/a8.png'),
(23, 'assets/img/upload/astra.png'),
(24, 'assets/img/upload/c3.png'),
(25, 'assets/img/upload/captur.png'),
(26, 'assets/img/upload/corsa.png'),
(27, 'assets/img/upload/crv.png'),
(28, 'assets/img/upload/ds3.png'),
(29, 'assets/img/upload/fiesta.png'),
(30, 'assets/img/upload/golf7.png'),
(31, 'assets/img/upload/ka.png'),
(32, 'assets/img/upload/q7.png'),
(33, 'assets/img/upload/sorento.png'),
(34, 'assets/img/upload/sportage.png'),
(35, 'assets/img/upload/tipo.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `href` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `href`, `title`) VALUES
(1, 'index.php', 'Home'),
(2, 'register.php', 'Register'),
(3, 'prices.php', 'Prices'),
(4, 'about.php', 'About us'),
(5, 'contact.php', 'Contact'),
(6, 'adminPanel.php', 'Admin Panel'),
(7, 'logic/logout.php', 'Log out'),
(8, 'aboutAuthor.php', 'About Author');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `role` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `role`) VALUES
(1, 'user'),
(2, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `surveyID` int(11) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`surveyID`, `question`) VALUES
(1, 'What is your favorite car?');

-- --------------------------------------------------------

--
-- Table structure for table `transmission`
--

CREATE TABLE `transmission` (
  `transmissionID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transmission`
--

INSERT INTO `transmission` (`transmissionID`, `name`) VALUES
(1, 'Automatic'),
(2, 'Semi-Automatic'),
(3, 'Manual 4'),
(4, 'Manual 5'),
(5, 'Manual 6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleID` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `voted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `timestamp`, `email`, `firstName`, `lastName`, `roleID`, `active`, `code`, `voted`) VALUES
(19, 'admin', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '2021-03-15 00:48:14.190732', 'mata123@gmail.com', 'Matija', 'Davidovic', 2, 0, 2273651, 1),
(50, 'johnny', 'd95049c4a91e033ac766a9f1b3e77b59', '2021-03-14 11:27:05.611311', 'john123@gmail.com', 'Johnny', 'Johnny', 1, 0, 7339870, 0),
(51, 'cofana', '18be418dce61ab9b9fcc458e0eb75c85', '2021-03-25 09:14:34.494912', 'filipblagojevic1@gmail.com', 'Filip', 'Blagojevic', 1, 0, 1183365, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_cars`
--

CREATE TABLE `users_cars` (
  `users_carsID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `carsID` int(11) NOT NULL,
  `beginDate` date NOT NULL,
  `endDate` date NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_cars`
--

INSERT INTO `users_cars` (`users_carsID`, `userID`, `carsID`, `beginDate`, `endDate`, `totalPrice`) VALUES
(21, 19, 16, '2021-03-14', '2021-03-31', 595),
(22, 51, 27, '2021-03-26', '2021-04-15', 480);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answerID`),
  ADD KEY `surveyID` (`surveyID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carsID`),
  ADD KEY `cars_brandID` (`cars_brandID`),
  ADD KEY `cars_bodyID` (`cars_bodyID`),
  ADD KEY `transmissionID` (`transmissionID`),
  ADD KEY `driveID` (`driveID`),
  ADD KEY `imageID` (`imageID`);

--
-- Indexes for table `cars_body`
--
ALTER TABLE `cars_body`
  ADD PRIMARY KEY (`cars_bodyID`);

--
-- Indexes for table `cars_brand`
--
ALTER TABLE `cars_brand`
  ADD PRIMARY KEY (`cars_brandID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `drive`
--
ALTER TABLE `drive`
  ADD PRIMARY KEY (`driveID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`surveyID`);

--
-- Indexes for table `transmission`
--
ALTER TABLE `transmission`
  ADD PRIMARY KEY (`transmissionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `users_cars`
--
ALTER TABLE `users_cars`
  ADD PRIMARY KEY (`users_carsID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `carsID` (`carsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `carsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cars_body`
--
ALTER TABLE `cars_body`
  MODIFY `cars_bodyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cars_brand`
--
ALTER TABLE `cars_brand`
  MODIFY `cars_brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `drive`
--
ALTER TABLE `drive`
  MODIFY `driveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `surveyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transmission`
--
ALTER TABLE `transmission`
  MODIFY `transmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users_cars`
--
ALTER TABLE `users_cars`
  MODIFY `users_carsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`surveyID`) REFERENCES `survey` (`surveyID`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`cars_bodyID`) REFERENCES `cars_body` (`cars_bodyID`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`cars_brandID`) REFERENCES `cars_brand` (`cars_brandID`),
  ADD CONSTRAINT `cars_ibfk_3` FOREIGN KEY (`driveID`) REFERENCES `drive` (`driveID`),
  ADD CONSTRAINT `cars_ibfk_4` FOREIGN KEY (`transmissionID`) REFERENCES `transmission` (`transmissionID`),
  ADD CONSTRAINT `cars_ibfk_5` FOREIGN KEY (`imageID`) REFERENCES `images` (`imageID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`);

--
-- Constraints for table `users_cars`
--
ALTER TABLE `users_cars`
  ADD CONSTRAINT `users_cars_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `users_cars_ibfk_2` FOREIGN KEY (`carsID`) REFERENCES `cars` (`carsID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
