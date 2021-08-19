-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2021 at 04:16 AM
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
-- Database: `eddyquincy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fullname`, `password`) VALUES
('STAFF001', 'Ibeh Eka', '$2y$10$WwJbLyJHOTGQcm03HoOIm.k.m0Uv2g37scvUyQpUz7NBVa7PURT.6'),
('STAFF002', 'Mr. Yemi', '$2y$10$yQvudAZ/sScmurdnWOypFemH9fuXH.DspyOgFyMYJyHPIjH6vzJfG');

-- --------------------------------------------------------

--
-- Table structure for table `affairs`
--

CREATE TABLE `affairs` (
  `student_id` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bursary`
--

CREATE TABLE `bursary` (
  `student_id` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `student_id` varchar(255) NOT NULL,
  `clearance_option` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared',
  `link_name` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL DEFAULT 'Please upload the appropriate documents.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`student_id`, `clearance_option`, `status`, `link_name`, `remark`) VALUES
('ND2018/1010/001', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/001', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/001', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/001', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/001', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/001', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/002', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/002', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/002', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/002', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/002', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/002', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/003', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/003', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/003', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/003', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/003', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/003', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/004', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/004', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/004', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/004', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/004', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/004', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/005', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/005', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/005', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/005', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/005', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/005', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/006', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/006', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/006', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/006', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/006', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/006', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/007', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/007', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/007', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/007', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/007', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/007', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/008', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/008', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/008', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/008', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/008', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/008', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/009', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/009', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/009', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/009', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/009', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/009', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.'),
('ND2018/1010/010', 'Director of Library', 'not cleared', 'library', 'Please upload the appropriate documents.'),
('ND2018/1010/010', 'Dean of Science', 'not cleared', 'science', 'Please upload the appropriate documents.'),
('ND2018/1010/010', 'Dean of Student Affairs', 'not cleared', 'affairs', 'Please upload the appropriate documents.'),
('ND2018/1010/010', 'Bursary', 'not cleared', 'bursary', 'Please upload the appropriate documents.'),
('ND2018/1010/010', 'Registrar\'s Office', 'not cleared', 'registrar', 'Please upload the appropriate documents.'),
('ND2018/1010/010', 'Departmental', 'not cleared', 'department', 'Please upload the appropriate documents.');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `student_id` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`student_id`, `course`, `status`) VALUES
('ND2018/1010/010', 'GNS 127', 'not cleared'),
('ND2018/1010/010', 'COM 222', 'not cleared'),
('ND2018/1010/010', 'COM 224', 'not cleared'),
('ND2018/1010/010', 'COM 226', 'not cleared'),
('ND2018/1010/010', 'OTM 227', 'not cleared'),
('ND2018/1010/010', 'COM 101', 'not cleared'),
('ND2018/1010/002', 'GNS 127', 'not cleared'),
('ND2018/1010/002', 'COM 222', 'not cleared'),
('ND2018/1010/002', 'COM 224', 'not cleared'),
('ND2018/1010/002', 'COM 226', 'not cleared'),
('ND2018/1010/002', 'OTM 227', 'not cleared'),
('ND2018/1010/002', 'COM 101', 'not cleared'),
('ND2018/1010/003', 'GNS 127', 'not cleared'),
('ND2018/1010/003', 'COM 222', 'not cleared'),
('ND2018/1010/003', 'COM 224', 'not cleared'),
('ND2018/1010/003', 'COM 226', 'not cleared'),
('ND2018/1010/003', 'OTM 227', 'not cleared'),
('ND2018/1010/003', 'COM 101', 'not cleared'),
('ND2018/1010/004', 'GNS 127', 'not cleared'),
('ND2018/1010/004', 'COM 222', 'not cleared'),
('ND2018/1010/004', 'COM 224', 'not cleared'),
('ND2018/1010/004', 'COM 226', 'not cleared'),
('ND2018/1010/004', 'OTM 227', 'not cleared'),
('ND2018/1010/004', 'COM 101', 'not cleared'),
('ND2018/1010/005', 'GNS 127', 'not cleared'),
('ND2018/1010/005', 'COM 222', 'not cleared'),
('ND2018/1010/005', 'COM 224', 'not cleared'),
('ND2018/1010/005', 'COM 226', 'not cleared'),
('ND2018/1010/005', 'OTM 227', 'not cleared'),
('ND2018/1010/005', 'COM 101', 'not cleared'),
('ND2018/1010/006', 'GNS 127', 'not cleared'),
('ND2018/1010/006', 'COM 222', 'not cleared'),
('ND2018/1010/006', 'COM 224', 'not cleared'),
('ND2018/1010/006', 'COM 226', 'not cleared'),
('ND2018/1010/006', 'OTM 227', 'not cleared'),
('ND2018/1010/006', 'COM 101', 'not cleared'),
('ND2018/1010/007', 'GNS 127', 'not cleared'),
('ND2018/1010/007', 'COM 222', 'not cleared'),
('ND2018/1010/007', 'COM 224', 'not cleared'),
('ND2018/1010/007', 'COM 226', 'not cleared'),
('ND2018/1010/007', 'OTM 227', 'not cleared'),
('ND2018/1010/007', 'COM 101', 'not cleared'),
('ND2018/1010/008', 'GNS 127', 'not cleared'),
('ND2018/1010/008', 'COM 222', 'not cleared'),
('ND2018/1010/008', 'COM 224', 'not cleared'),
('ND2018/1010/008', 'COM 226', 'not cleared'),
('ND2018/1010/008', 'OTM 227', 'not cleared'),
('ND2018/1010/008', 'COM 101', 'not cleared'),
('ND2018/1010/009', 'GNS 127', 'not cleared'),
('ND2018/1010/009', 'COM 222', 'not cleared'),
('ND2018/1010/009', 'COM 224', 'not cleared'),
('ND2018/1010/009', 'COM 226', 'not cleared'),
('ND2018/1010/009', 'OTM 227', 'not cleared'),
('ND2018/1010/009', 'COM 101', 'not cleared'),
('ND2018/1010/001', 'GNS 127', 'not cleared'),
('ND2018/1010/001', 'COM 222', 'not cleared'),
('ND2018/1010/001', 'COM 224', 'not cleared'),
('ND2018/1010/001', 'COM 226', 'not cleared'),
('ND2018/1010/001', 'OTM 227', 'not cleared'),
('ND2018/1010/001', 'COM 101', 'not cleared'),
('ND2018/1010/001', 'COM 126', 'not cleared'),
('ND2018/1010/002', 'COM 126', 'not cleared'),
('ND2018/1010/003', 'COM 126', 'not cleared'),
('ND2018/1010/004', 'COM 126', 'not cleared'),
('ND2018/1010/005', 'COM 126', 'not cleared'),
('ND2018/1010/006', 'COM 126', 'not cleared'),
('ND2018/1010/007', 'COM 126', 'not cleared'),
('ND2018/1010/008', 'COM 126', 'not cleared'),
('ND2018/1010/009', 'COM 126', 'not cleared'),
('ND2018/1010/010', 'COM 126', 'not cleared');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `student_id` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `student_id` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `student_id` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `science`
--

CREATE TABLE `science` (
  `student_id` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `clearance_status` varchar(255) NOT NULL DEFAULT 'not cleared',
  `department` varchar(255) NOT NULL DEFAULT 'Computer Science',
  `password` varchar(255) NOT NULL,
  `passport` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fname`, `lname`, `clearance_status`, `department`, `password`, `passport`) VALUES
('ND2018/1010/001', 'Eddy', 'Quincy', 'not cleared', 'Computer Science', '$2y$10$q6dH7NgmyiLfJi8AXua4r.pADj/muzuUQBU5Ve6ZvrkABf4nda6cO', 'quincy.jpg'),
('ND2018/1010/002', 'John', 'Doe', 'not cleared', 'Computer Science', '$2y$10$xprfg.NbFK5./KfZ1O6k2ujwzLMnPNEAX44majrec6wokBbV4d8Bu', 'johndoe.jpg'),
('ND2018/1010/003', 'Jane', 'Doe', 'not cleared', 'Computer Science', '$2y$10$1qFsRkmJrAWnt.4/7m2jSuf2hXJ6l7Fp.pzEKTilYHBPNBi4ypgWG', 'janedoe.jpg'),
('ND2018/1010/004', 'Juice', 'WRLD', 'not cleared', 'Computer Science', '$2y$10$B5I9P3TIjtGyGHnfW6G85ORruyiBeeBgFcEGGsMskE1OdqIw3Nisa', 'juicewrld.jpg'),
('ND2018/1010/005', 'Wisdom', 'Ojimah', 'not cleared', 'Computer Science', '$2y$10$K0mzY.jPLCSnAF4hm72wSOd5QViCAmjAax15mjbC8Ebg004Rl0B7C', 'wisdomojimah.jpg'),
('ND2018/1010/006', 'Gabriel', 'Vindicate', 'not cleared', 'Computer Science', '$2y$10$ElAo/mSr7cbPI7IG.9JG/.8E1qqrHUhkOlgFBkh4gufuN4.qGeOjq', 'gabrielvindicate.jpg'),
('ND2018/1010/007', 'King', 'Julius', 'not cleared', 'Computer Science', '$2y$10$tAyTnXWO0Jc8.iNq/t5NCeP/5WS1pmbF9VB0ppt.NG9ua08n06zMO', 'kingjulius.jpg'),
('ND2018/1010/008', 'Goodness', 'Endurance', 'not cleared', 'Computer Science', '$2y$10$YUi7KbUKHTt0NBxNM/QXYuFacySV2may7m23y1eOWpUYkygq.lUUa', 'goodnessendurance.jpg'),
('ND2018/1010/009', 'Precious', 'Soye', 'not cleared', 'Computer Science', '$2y$10$DoxjvwR6L0XNQAtLLk6P4eXtl23YVy7WsTAo62Ol5RzFzQfDvVisu', 'precious.jpg'),
('ND2018/1010/010', 'Promise', 'Enyia', 'not cleared', 'Computer Science', '$2y$10$Sa8XXxZRUwZvHPd.EL3.vOBw.Hv2xqDI1QksSxJh3b.vx5NKBj7HC', 'promise.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affairs`
--
ALTER TABLE `affairs`
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `bursary`
--
ALTER TABLE `bursary`
  ADD KEY `bursary_fk` (`student_id`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `science`
--
ALTER TABLE `science`
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_id_2` (`student_id`),
  ADD UNIQUE KEY `student_id_3` (`student_id`),
  ADD UNIQUE KEY `student_id_4` (`student_id`),
  ADD UNIQUE KEY `student_id_5` (`student_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affairs`
--
ALTER TABLE `affairs`
  ADD CONSTRAINT `affairs_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `bursary`
--
ALTER TABLE `bursary`
  ADD CONSTRAINT `bursary_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `clearance`
--
ALTER TABLE `clearance`
  ADD CONSTRAINT `clearance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `science`
--
ALTER TABLE `science`
  ADD CONSTRAINT `science_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
