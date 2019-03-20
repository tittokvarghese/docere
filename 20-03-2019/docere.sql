-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2019 at 07:02 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docere`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `aptsid` bigint(20) NOT NULL,
  `apts_pid` bigint(20) NOT NULL,
  `apts_did` bigint(20) NOT NULL,
  `apts_day` varchar(20) NOT NULL,
  `apts_month` varchar(20) NOT NULL,
  `apts_year` varchar(4) NOT NULL,
  `apts_week` varchar(20) NOT NULL,
  `apts_seen` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`aptsid`, `apts_pid`, `apts_did`, `apts_day`, `apts_month`, `apts_year`, `apts_week`, `apts_seen`) VALUES
(1, 1, 9, '25', 'March', '2019', 'Monday', '1'),
(2, 10, 9, '31', 'March', '2019', 'Monday', '0'),
(3, 10, 9, '31', 'March', '2019', 'Monday', '0'),
(7, 1, 9, '31', 'March', '2019', 'Sunday', '0'),
(8, 1, 4, '31', 'March', '2019', 'Sunday', '0');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `docid` bigint(20) NOT NULL,
  `doc_uid` bigint(20) NOT NULL,
  `doc_degree` varchar(200) NOT NULL,
  `doc_fee` varchar(5) NOT NULL,
  `doc_type` varchar(100) NOT NULL,
  `doc_services` text NOT NULL,
  `doc_member` text NOT NULL,
  `doc_about` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`docid`, `doc_uid`, `doc_degree`, `doc_fee`, `doc_type`, `doc_services`, `doc_member`, `doc_about`) VALUES
(1, 2, 'DM, DPM, MBBS, MD', '100', 'Cardiologist', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...'),
(2, 3, 'DM, DPM, MBBS, MD', '50', 'Pediatrician', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Life Member of Ex-Students Association of Medical College, Kolkata,Life Member of Neurological Society of India,Member of Neurological Surgeons Society of India', 'Dr. Sanghamitra Sarkar is an eminent Neurologist and Neurosurgeon associated with Lifeline Polyclinic in Kalyani area. She has completed her MBBS - Bachelor of Medicine and Bachelor of Surgery in the year 1996, MS (General Surgery) - Master of Surgery in General Surgery and M.Ch'),
(3, 4, 'MD', '150', 'Gynecologist', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...'),
(4, 5, 'DM, DPM', '120', 'Neurologist', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...'),
(5, 6, 'DM', '150', 'General Physician', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...'),
(6, 7, 'MBBS, MD', '150', 'Dentist', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...'),
(7, 8, 'MBBS', '150', 'Eye Specialist', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...'),
(8, 9, 'DM, DPM, MBBS, MD', '100', 'ENT', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Cerebrovascular Surgeryrn Aortic Anuerysm Surgery / Endovascular Repairrn Peripheral Neuro surgeryrn Epilepsy surgeryrn Spine Surgeryrn Brain Tumor Surgeryrn Hydrocephalusrn Stereotactic and Functional Neurosurgeryrn Prolapsed Disc Diseasern Spondylolisthesisrn Surgery for intracranial aneurysms and arteriovenous malformationsrn Surgery for pain and peripheral nerve surgery', 'Dr. Sanghamitra Sarkar is an eminent Neurologist a...');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leaid` bigint(20) NOT NULL,
  `lea_did` bigint(20) NOT NULL DEFAULT '1',
  `lea_day` varchar(20) NOT NULL,
  `lea_month` varchar(20) NOT NULL,
  `lea_year` varchar(4) NOT NULL,
  `lea_week` varchar(20) NOT NULL,
  `lea_type` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `lgstid` bigint(20) NOT NULL,
  `lgst_uid` bigint(20) NOT NULL,
  `lgst_ip` varchar(200) NOT NULL,
  `lgst_time` varchar(50) NOT NULL,
  `lgst_date` varchar(200) NOT NULL,
  `lgst_os` varchar(100) NOT NULL,
  `lgst_bra` varchar(100) NOT NULL,
  `lgst_bra_info` text NOT NULL,
  `lgst_refurl` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`lgstid`, `lgst_uid`, `lgst_ip`, `lgst_time`, `lgst_date`, `lgst_os`, `lgst_bra`, `lgst_bra_info`, `lgst_refurl`) VALUES
(1, 1, '::1', '1552977529', 'Tue, March 19, 2019, 12:08:49 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(2, 2, '::1', '1552977545', 'Tue, March 19, 2019, 12:09:05 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(3, 3, '::1', '1552977559', 'Tue, March 19, 2019, 12:09:19 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(4, 4, '::1', '1552977566', 'Tue, March 19, 2019, 12:09:26 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(5, 2, '::1', '1552977575', 'Tue, March 19, 2019, 12:09:35 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(6, 3, '::1', '1552977590', 'Tue, March 19, 2019, 12:09:50 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(7, 4, '::1', '1552977603', 'Tue, March 19, 2019, 12:10:03 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(8, 5, '::1', '1552977624', 'Tue, March 19, 2019, 12:10:24 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(9, 6, '::1', '1552977647', 'Tue, March 19, 2019, 12:10:47 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(10, 7, '::1', '1552977663', 'Tue, March 19, 2019, 12:11:03 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(11, 8, '::1', '1552977677', 'Tue, March 19, 2019, 12:11:17 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(12, 9, '::1', '1552977708', 'Tue, March 19, 2019, 12:11:48 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(13, 9, '::1', '1552977743', 'Tue, March 19, 2019, 12:12:23 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(14, 1, '::1', '1552977860', 'Tue, March 19, 2019, 12:14:20 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(15, 9, '::1', '1552993372', 'Tue, March 19, 2019, 4:32:52 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(16, 2, '::1', '1552993386', 'Tue, March 19, 2019, 4:33:06 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(17, 10, '::1', '1552993430', 'Tue, March 19, 2019, 4:33:50 PM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(18, 1, '::1', '1553053165', 'Wed, March 20, 2019, 9:09:25 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(19, 3, '::1', '1553057143', 'Wed, March 20, 2019, 10:15:43 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(20, 4, '::1', '1553060816', 'Wed, March 20, 2019, 11:16:56 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(21, 5, '::1', '1553060949', 'Wed, March 20, 2019, 11:19:09 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(22, 6, '::1', '1553061113', 'Wed, March 20, 2019, 11:21:53 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(23, 7, '::1', '1553061193', 'Wed, March 20, 2019, 11:23:13 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(24, 8, '::1', '1553061266', 'Wed, March 20, 2019, 11:24:26 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(25, 2, '::1', '1553061325', 'Wed, March 20, 2019, 11:25:25 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(26, 1, '::1', '1553061400', 'Wed, March 20, 2019, 11:26:40 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(27, 7, '::1', '1553061444', 'Wed, March 20, 2019, 11:27:24 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(28, 6, '::1', '1553061523', 'Wed, March 20, 2019, 11:28:43 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(29, 5, '::1', '1553061557', 'Wed, March 20, 2019, 11:29:17 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(30, 1, '::1', '1553061589', 'Wed, March 20, 2019, 11:29:49 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(31, 7, '::1', '1553061611', 'Wed, March 20, 2019, 11:30:11 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/'),
(32, 1, '::1', '1553061619', 'Wed, March 20, 2019, 11:30:19 AM', 'Windows 10', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'http://localhost/docere/');

-- --------------------------------------------------------

--
-- Table structure for table `new_password`
--

CREATE TABLE `new_password` (
  `npwdid` bigint(20) NOT NULL,
  `npwd_email` varchar(100) NOT NULL,
  `npwd_code` varchar(6) NOT NULL DEFAULT '0',
  `npwd_time` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notid` bigint(20) NOT NULL,
  `not_tid` bigint(20) NOT NULL,
  `not_fid` bigint(20) NOT NULL,
  `not_time` varchar(20) NOT NULL,
  `not_star` varchar(4) NOT NULL DEFAULT '0',
  `not_feedback` text NOT NULL,
  `not_type` varchar(20) NOT NULL DEFAULT '0',
  `not_seen` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notid`, `not_tid`, `not_fid`, `not_time`, `not_star`, `not_feedback`, `not_type`, `not_seen`) VALUES
(1, 9, 10, '1553040785', '4', 'okkkkkkk', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `symid` bigint(20) NOT NULL,
  `sym_uid` bigint(20) NOT NULL,
  `sym_items` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`symid`, `sym_uid`, `sym_items`) VALUES
(29, 4, ' Body Pain'),
(28, 4, 'Vomiting'),
(24, 3, 'Child Fever'),
(23, 3, 'Back cold'),
(12, 9, 'Headache'),
(11, 9, 'Fever'),
(32, 5, 'Muscle weakness'),
(33, 5, 'Seizures'),
(34, 5, 'Unexplained pain'),
(35, 6, 'Digestive problem'),
(53, 7, 'Pain or Popping'),
(52, 7, 'toothache'),
(51, 7, ' arthritis'),
(50, 7, ' injury'),
(49, 7, 'teeth grinding'),
(41, 8, 'Double vision'),
(42, 8, 'Sudden blurry'),
(43, 8, 'Sudden eye pain'),
(44, 8, ' redness'),
(45, 8, ' nausea'),
(46, 8, ' vomiting'),
(47, 2, 'Chest pain'),
(48, 2, ' chest tightness');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `tmtid` bigint(20) NOT NULL,
  `tmt_uid` bigint(20) NOT NULL,
  `tmt_week` text NOT NULL,
  `tmt_fhh` varchar(5) NOT NULL,
  `tmt_fmm` varchar(5) NOT NULL,
  `tmt_ftime` varchar(5) NOT NULL,
  `tmt_thh` varchar(5) NOT NULL,
  `tmt_tmm` varchar(5) NOT NULL,
  `tmt_totime` varchar(5) NOT NULL,
  `tmt_limit` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`tmtid`, `tmt_uid`, `tmt_week`, `tmt_fhh`, `tmt_fmm`, `tmt_ftime`, `tmt_thh`, `tmt_tmm`, `tmt_totime`, `tmt_limit`) VALUES
(1, 9, 'Sunday,Monday', '09', '00', 'AM', '10', '00', 'AM', '50'),
(2, 3, 'Sunday,Thursday,Friday,Saturday', '10', '00', 'AM', '04', '00', 'PM', '200'),
(3, 3, 'Wednesday', '08', '00', 'AM', '11', '00', 'AM', '50'),
(4, 4, 'Sunday', '08', '00', 'AM', '12', '00', 'PM', '100'),
(5, 7, 'Sunday,Monday,Tuesday,Wednesday', '08', '00', 'AM', '12', '00', 'PM', '100'),
(6, 8, 'Sunday,Tuesday,Saturday', '10', '00', 'AM', '04', '00', 'PM', '100'),
(7, 2, 'Wednesday,Thursday', '09', '00', 'AM', '05', '00', 'PM', '200'),
(8, 6, 'Thursday,Friday,Saturday', '09', '00', 'AM', '12', '26', 'PM', '60'),
(9, 5, 'Sunday,Monday,Tuesday,Thursday', '11', '00', 'AM', '06', '00', 'PM', '150');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` bigint(20) NOT NULL,
  `uact` int(1) NOT NULL DEFAULT '1',
  `fname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `login_id` varchar(60) NOT NULL,
  `upwd` varchar(220) NOT NULL,
  `utype` varchar(50) NOT NULL,
  `utime` varchar(50) NOT NULL,
  `udate` varchar(100) NOT NULL,
  `uip` varchar(200) NOT NULL,
  `ubra` text NOT NULL,
  `uimage` text NOT NULL,
  `ulocation` text,
  `ugender` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uact`, `fname`, `lname`, `login_id`, `upwd`, `utype`, `utime`, `udate`, `uip`, `ubra`, `uimage`, `ulocation`, `ugender`) VALUES
(1, 1, 'Titto', 'K Varghese', 'titto@gmail.com', 'e01c02ddef1230a3121877436cb10448d6b49e2fe704e1c3f', 'Patient', '1552977529', 'Tue, March 19, 2019, 12:08:49 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '478104_1553057093_638649672_284557_n.jpg', 'Kottayam', '1'),
(2, 1, 'Thomas A', 'Holo', 'a@gmail.com', 'a15e68b652532e721123c49c9ffda265c0eec97b796e60719', 'Doctor', '1552977545', 'Tue, March 19, 2019, 12:09:05 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '523401_1553061350_473348177_752898_n.jpg', 'Chry', '1'),
(3, 1, 'Thomas B', 'Chackooo', 'b@gmail.com', '81e20a87822fdd671557ea6ddce5ffd2b648390e118c8798b', 'Doctor', '1552977559', 'Tue, March 19, 2019, 12:09:19 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '834125_1553058947_1357604605_841327_n.jpg', 'TVM', '1'),
(4, 1, 'Thomas c', 'Holo', 'c@gmail.com', '735594b929cb361f63e81dc83c136175c524e981f49026b04', 'Doctor', '1552977566', 'Tue, March 19, 2019, 12:09:26 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '643841_1553060903_1244732_203580_n.jpg', 'Lifeline Polyclinic - A-9X, Block A9, 6 (S) Kalyani, Near Kalyani Main Station, Kalyani-741235', '1'),
(5, 1, 'Thomas d', 'Holo', 'd@gmail.com', '76ccacf9aab3dc2e831740d972b6a2cca8ad86a38ecac9d72', 'Doctor', '1552977624', 'Tue, March 19, 2019, 12:10:24 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '653671_1553060990_437188994_890133_n.jpg', 'Lifeline Polyclinic - A-9X, Block A9, 6 (S) Kalyani, Near Kalyani Main Station, Kalyani-741235', '1'),
(6, 1, 'Thomas e', 'Holo', 'e@gmail.com', '4ded590ee8c26d3516f8a9c698a4260c0891e7b9fe2c0f761', 'Doctor', '1552977647', 'Tue, March 19, 2019, 12:10:47 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '386944_1553061183_229436175_304808_n.jpg', 'Ponnkunnam', '1'),
(7, 1, 'Meenu', 'John', 'f@gmail.com', '385ceafabd33c7d36d71f8468783d9db56eec4932250f2a27', 'Doctor', '1552977663', 'Tue, March 19, 2019, 12:11:03 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '928003_1553061233_533331150_776889_n.jpg', 'Bangalore', '2'),
(8, 1, 'Thomas g', 'Holo', 'g@gmail.com', 'd9d3026866b2d064f6342dca6b12f6b4c2f951107ec117566', 'Doctor', '1552977677', 'Tue, March 19, 2019, 12:11:17 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '562659_1553061304_180616798_998024_n.jpg', 'Lifeline Polyclinic - A-9X, Block A9, 6 (S) Kalyani, Near Kalyani Main Station, Kalyani-741235', '1'),
(9, 1, 'Thomas ENT', 'Holo', 'jikku@gmail.com', '407bfd28bddcd98a37775fce430f71a37d32bfc70bb1a140e', 'Doctor', '1552977708', 'Tue, March 19, 2019, 12:11:48 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '501303_1552977824_777395605_949639_n.jpg', 'Kottayam', '1'),
(10, 1, 'Soman', 'Sunnu Joseph', 'soman@gmail.com', '5d3cc1fd8d44089c3348b6634808952a1c860df8a696b7b08', 'Patient', '1552993430', 'Tue, March 19, 2019, 4:33:50 PM', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '', 'Lifeline Polyclinic - A-9X, Block A9, 6 (S) Kalyani, Near Kalyani Main Station, Kalyani-741235', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`aptsid`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leaid`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`lgstid`);

--
-- Indexes for table `new_password`
--
ALTER TABLE `new_password`
  ADD PRIMARY KEY (`npwdid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notid`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`symid`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`tmtid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `login_id` (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `aptsid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `docid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leaid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `lgstid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `new_password`
--
ALTER TABLE `new_password`
  MODIFY `npwdid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `symid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `tmtid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
