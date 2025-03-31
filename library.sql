-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2025 at 03:02 AM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(25) NOT NULL,
  `genre` varchar(25) NOT NULL,
  `published_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre`, `published_year`) VALUES
(11, 'Test Boo', 'TestAuthor', 'Test Genre1', 1112),
(12, '1984', 'George Orwell', 'Dystopian', 1950),
(13, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 1960),
(14, 'Pride and Prejudice', 'Jane Austen', 'Romance', 1813),
(15, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', 1951),
(16, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 1925),
(17, '1984', 'George Orwell', 'Dystopian', 1949),
(18, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 1960),
(19, 'Pride and Prejudice', 'Jane Austen', 'Romance', 1813),
(20, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', 1951),
(21, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 1925),
(22, '1984', 'George Orwell', 'Dystopian', 1949),
(23, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 1960),
(24, 'Pride and Prejudice', 'Jane Austen', 'Romance', 1813),
(25, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', 1951),
(26, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 1925),
(27, '1984', 'George Orwell', 'Dystopian', 1949),
(28, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 1960),
(29, 'Pride and Prejudice', 'Jane Austen', 'Romance', 1813),
(30, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', 1951),
(34, 'Test3', 'TestAuthor', 'Test Genre', 1111);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `book_id`, `member_id`, `loan_date`, `return_date`) VALUES
(15, 11, 1, '2023-04-01', '2023-04-15'),
(16, 12, 2, '2023-05-01', '2023-05-10'),
(17, 13, 3, '2023-06-01', '2023-06-14'),
(18, 14, 4, '2023-07-01', '2023-07-14'),
(19, 15, 5, '2023-08-01', '2023-08-10'),
(20, 16, 6, '2023-09-01', '2023-09-15'),
(21, 17, 7, '2023-10-01', '2023-10-10'),
(22, 18, 8, '2023-11-01', '2023-11-15'),
(23, 19, 9, '2023-12-01', '2023-12-15'),
(24, 20, 10, '2024-01-01', '2024-01-15'),
(25, 21, 1, '2024-02-01', '2024-02-15'),
(26, 22, 2, '2024-03-01', '2024-03-10'),
(27, 23, 3, '2024-04-01', '2024-04-15'),
(28, 24, 4, '2024-05-01', '2024-05-15'),
(29, 25, 5, '2024-06-01', '2024-06-15'),
(30, 26, 6, '2024-07-01', '2024-07-10'),
(31, 27, 7, '2024-08-01', '2024-08-10'),
(32, 28, 8, '2024-09-01', '2024-09-15'),
(33, 29, 9, '2024-10-01', '2024-10-15'),
(34, 30, 10, '2024-11-01', '2024-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `membership__date` date NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `membership__date`, `email`, `phone_number`) VALUES
(1, 'John Do', '2025-03-30', 'johndoe@example.com', '123-456-7890'),
(2, 'Jane Smith', '2022-05-22', 'janesmith@example.com', '098-765-4321'),
(3, 'Emily Johnson', '2023-03-18', 'emilyj@example.com', '555-123-4567'),
(4, 'Michael Brown', '2022-11-11', 'michaelb@example.com', '444-567-8901'),
(5, 'Sarah Davis', '2023-02-27', 'sarahd@example.com', '333-456-7891'),
(6, 'John Doe', '2023-01-15', 'johndoe@example.com', '123-456-7890'),
(7, 'Jane Smith', '2022-05-22', 'janesmith@example.com', '098-765-4321'),
(8, 'Emily Johnson', '2023-03-18', 'emilyj@example.com', '555-123-4567'),
(9, 'Michael Brown', '2022-11-11', 'michaelb@example.com', '444-567-8901'),
(10, 'Sarah Davis', '2023-02-27', 'sarahd@example.com', '333-456-7891');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Loans_BooksID` (`book_id`),
  ADD KEY `FK_Loans_MembersID` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `FK_Loans_BooksID` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `FK_Loans_MembersID` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
