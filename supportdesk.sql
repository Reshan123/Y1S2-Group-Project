-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 07:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supportdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_q`
--

CREATE TABLE `common_q` (
  `CQ_ID` int(11) NOT NULL,
  `CQ_title` varchar(200) DEFAULT NULL,
  `CQ_body` varchar(5000) DEFAULT NULL,
  `CQ_Category` varchar(200) DEFAULT NULL,
  `Res_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `common_q`
--

INSERT INTO `common_q` (`CQ_ID`, `CQ_title`, `CQ_body`, `CQ_Category`, `Res_ID`) VALUES
(226457, 'What is a Regular Semester Registration?', 'Regular registration is the admission granted to a student who has completed the requirements stated by the institute, a faculty and or a specific study programme to proceed to the next academic year/semester.', 'Semester', 22785613),
(226458, 'How to apply for sholarship programs?', 'To apply please send in a letter of request addressed to Director/Academic Affairs and a copy of your A/L results and OR  copies of relevant sports/extracurricular achievements which will be authenticated and submitted to the scholarship awarding panel. These Scholarships are awarded ONCE A YEAR after each intake in completed.', 'Sholarship', 22992285),
(226459, 'What is the orientation program?', 'During the orientation program, the students are also introduced to support services such as IT Services, Library, Career Guidance & Counseling,  Sports,  Medical and Student Services, which will be frequently used by students once the academic activities start. Furthermore, Students will be introduced to many other extra curricular activities available at the university via the introduction of Clubs and Societies of the university. Participation for the orientation program is mandatory for registered students and the institute will request the students to sit for relevant orientation examinations as required.', 'Orientation', 22328881),
(226460, 'How does education loans work?', 'Education loans are issued for the purpose of attending an accredited fee-levying Institute or a university to pursue an academic degree.Education loans can be obtained from ones workplace as well as via private-sector lending sources such as banks.You may require a Studentship Confirmation Letter along with semester payment details from the Institute to request for the loan facility.', 'Student Loans', 22785613);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `F_ID` int(11) NOT NULL,
  `F_rating` int(11) DEFAULT NULL,
  `F_body` varchar(1500) DEFAULT NULL,
  `Reg_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `Man_ID` int(11) NOT NULL,
  `Man_username` varchar(50) DEFAULT NULL,
  `Man_email` varchar(50) DEFAULT NULL,
  `Man_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`Man_ID`, `Man_username`, `Man_email`, `Man_password`) VALUES
(33111666, 'Emma Wotson', 'M33111666@my.cornell.manager.us', 'emmamanager123'),
(33559173, 'Wiliam Peters', '33559173@my.cornell.manager.us', 'williammanager123');

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

CREATE TABLE `registered_user` (
  `Reg_ID` int(11) NOT NULL,
  `Reg_username` varchar(50) DEFAULT NULL,
  `Reg_email` varchar(50) DEFAULT NULL,
  `Reg_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`Reg_ID`, `Reg_username`, `Reg_email`, `Reg_password`) VALUES
(11000458, 'John Nigga', '11100943@my.cornell.us', 'britneybrown123'),
(11008734, 'Ben Smith', '11008734@my.cornell.us', 'bensmith123'),
(11100943, 'Britney Brown', '11000458@my.cornell.us', 'britneybrown123'),
(11426007, 'Harsha Kumar', '11426007@my.cornell.us', 'harsha123'),
(11561168, 'Oliver Green', '11561168@my.cornell.us', 'olivergreen123'),
(11739125, 'Arun Singh', '11739125@my.cornell.us', 'arunsingh123'),
(11900023, 'Jasmine Peter', '11900023@my.cornell.us', 'jasmine123');

-- --------------------------------------------------------

--
-- Table structure for table `reg_tickets`
--

CREATE TABLE `reg_tickets` (
  `RegT_ID` int(11) NOT NULL,
  `RegT_category` varchar(200) DEFAULT NULL,
  `RegT_title` varchar(200) DEFAULT NULL,
  `RegT_body` varchar(5000) DEFAULT NULL,
  `Reg_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_tickets`
--

INSERT INTO `reg_tickets` (`RegT_ID`, `RegT_category`, `RegT_title`, `RegT_body`, `Reg_ID`) VALUES
(44300083, 'Scholarship ', 'Scholarships university offers', 'I am a third year student from the faculty of computing and I have a collective gpa of 3.7, I would like to apply for scholarships and wanted to know what different types of scholarships the university offers as well as the document required in order to apply for them.', 11900023),
(44511974, 'Repeats', 'Finals repeats date', 'I am a student who finished my finals last month, I would like to apply to repeat a final for one of my modules and I would like to know when the registration for it starts or if it is already in progress.', 11900023),
(44611007, 'Clubs and societies', 'Available clubs and societies ', 'In order to build my student portfolio, I would like to join some more clubs as to increase the number of extracurricular activities I do, thus I would like to know the available clubs and societies of this university as well as information on whom I must contact in order to join these clubs. Awaiting your prompt response.', 11008734);

-- --------------------------------------------------------

--
-- Table structure for table `responder`
--

CREATE TABLE `responder` (
  `Res_ID` int(11) NOT NULL,
  `Res_username` varchar(50) DEFAULT NULL,
  `Res_email` varchar(50) DEFAULT NULL,
  `Res_password` varchar(50) DEFAULT NULL,
  `Man_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responder`
--

INSERT INTO `responder` (`Res_ID`, `Res_username`, `Res_email`, `Res_password`, `Man_ID`) VALUES
(22126492, 'James', '22126492@my.cornell.staff.us', 'jamesstaff123', 33559173),
(22328881, 'Rani achchi', '22328881@my.cornell.staff.us', 'ranistaff123', 33559173),
(22446437, 'Henry', '22446437@my.cornell.staff.us', 'henrystaff123', 33111666),
(22785613, 'Edward', '22785613@my.cornell.staff.us', 'edwardstaff123', 33111666),
(22992285, 'Jasper', '22992285@my.cornell.staff.us', 'jasperstaff123', 33111666);

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `S_ID` int(11) NOT NULL,
  `S_Body` varchar(5000) DEFAULT NULL,
  `RegT_ID` int(11) DEFAULT NULL,
  `Res_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solution`
--

INSERT INTO `solution` (`S_ID`, `S_Body`, `RegT_ID`, `Res_ID`) VALUES
(55, 'Good afternoon dear student, the finals repeating examinations dates will be uploaded in the university official website soon, you can log into the university website using your student log in credentials, there will be also be a notice from your year coordinators.', 44511974, 22785613),
(56, 'Dear student, we appreciate your interest in joining our university, for the faculty of humanities and sciences we offer 4 degrees, a 4 year bachelors in chemistry 4 year bachelors in biotechnology, a 4 year bachelors in biomedical and a bachelor’s of education in psychology, you would have to pay the fee each semester before registration for that semester, a year has 2 semesters. The fees for psychology and chemistry starts at $30,000 whereas for the bachelors of biomedical and biotechnology the fees starts at $45,000. There will be an open day next week Monday the 15th, if you still have questions, you could come meet me ask for Miss Pravin, I am located in the 9th floor. ', 44300083, 22446437);

-- --------------------------------------------------------

--
-- Table structure for table `unreg_tickets`
--

CREATE TABLE `unreg_tickets` (
  `UnregT_ID` int(11) NOT NULL,
  `UnregT_title` varchar(200) DEFAULT NULL,
  `UnregT_body` varchar(5000) DEFAULT NULL,
  `UnregT_pemail` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unreg_tickets`
--

INSERT INTO `unreg_tickets` (`UnregT_ID`, `UnregT_title`, `UnregT_body`, `UnregT_pemail`) VALUES
(44511974, 'Orientation exam dates', 'Good Afternoon, I would like to get some information about the upcoming orientation exam dates for the new student who have just registered for the 2023 intake.', 'sasha2002@gmail.com'),
(44782541, 'Log in details ', 'I am writing this ticket to ask about student’s log in details, I am a new student and I have not received mine yet, I was also wondering when will our ID card be issued. Awaiting your prompt reply.', 'jimmybookworm@gmail.com'),
(44800063, 'Semester fees', 'Good Morning, I am an AL student who is looking to join this university and I would like to know the fees and fees structure for the faculty of humanities and sciences, as well as any information about the specializations you have. Hoping to hear from you soon ', 'danial2004@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_q`
--
ALTER TABLE `common_q`
  ADD PRIMARY KEY (`CQ_ID`),
  ADD KEY `Res_ID` (`Res_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`F_ID`),
  ADD KEY `Reg_ID` (`Reg_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`Man_ID`);

--
-- Indexes for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`Reg_ID`);

--
-- Indexes for table `reg_tickets`
--
ALTER TABLE `reg_tickets`
  ADD PRIMARY KEY (`RegT_ID`),
  ADD KEY `Reg_ID` (`Reg_ID`);

--
-- Indexes for table `responder`
--
ALTER TABLE `responder`
  ADD PRIMARY KEY (`Res_ID`),
  ADD KEY `Man_ID` (`Man_ID`);

--
-- Indexes for table `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `RegT_ID` (`RegT_ID`),
  ADD KEY `Res_ID` (`Res_ID`);

--
-- Indexes for table `unreg_tickets`
--
ALTER TABLE `unreg_tickets`
  ADD PRIMARY KEY (`UnregT_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `common_q`
--
ALTER TABLE `common_q`
  ADD CONSTRAINT `common_q_ibfk_1` FOREIGN KEY (`Res_ID`) REFERENCES `responder` (`Res_ID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`Reg_ID`) REFERENCES `registered_user` (`Reg_ID`);

--
-- Constraints for table `reg_tickets`
--
ALTER TABLE `reg_tickets`
  ADD CONSTRAINT `reg_tickets_ibfk_1` FOREIGN KEY (`Reg_ID`) REFERENCES `registered_user` (`Reg_ID`);

--
-- Constraints for table `responder`
--
ALTER TABLE `responder`
  ADD CONSTRAINT `responder_ibfk_1` FOREIGN KEY (`Man_ID`) REFERENCES `manager` (`Man_ID`);

--
-- Constraints for table `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `solution_ibfk_1` FOREIGN KEY (`RegT_ID`) REFERENCES `reg_tickets` (`RegT_ID`),
  ADD CONSTRAINT `solution_ibfk_2` FOREIGN KEY (`Res_ID`) REFERENCES `responder` (`Res_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
