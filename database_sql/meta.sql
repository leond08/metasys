-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2016 at 10:42 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `meta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'markleo', 'metasys');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cityid` int(10) NOT NULL AUTO_INCREMENT,
  `City_name` varchar(100) NOT NULL,
  PRIMARY KEY (`cityid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `City_name`) VALUES
(1, 'Bato'),
(2, 'Balatan'),
(3, 'Buhi'),
(4, 'Baao'),
(5, 'Nabua'),
(6, 'Iriga'),
(7, 'Bula');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE IF NOT EXISTS `criteria` (
  `criteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `percentage` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `segment_id` int(11) NOT NULL,
  PRIMARY KEY (`criteria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `name`, `percentage`, `sort`, `event_id`, `segment_id`) VALUES
(23, 'General Effect (Entrance and Exit)', 0, 0, 62, 0),
(24, 'Content, Clear Organization', 0, 0, 62, 0),
(25, 'Grace and Poise', 0, 0, 61, 0);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_temp`
--

CREATE TABLE IF NOT EXISTS `criteria_temp` (
  `criteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `criteria_temp_name` varchar(100) NOT NULL,
  PRIMARY KEY (`criteria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `criteria_temp`
--

INSERT INTO `criteria_temp` (`criteria_id`, `criteria_temp_name`) VALUES
(17, 'Tone Quality (Vocal Technique/Intonation)'),
(18, 'Musicianship (Dynamic Nuances, Interpretation Intonation, Diction)'),
(19, 'Deportment'),
(20, 'Blending/Harmony'),
(21, 'Grace and Poise'),
(22, 'Mastery and Presicion'),
(23, 'Interpretation and Cheoreography'),
(24, 'General Effect (Costume)'),
(25, 'Mastery and Performance'),
(26, 'Cheoreography and Coordination'),
(27, 'General Effect (Entrance and Exit)'),
(28, 'Mastery and Performance (Grace, Poise, Rhythm)'),
(29, 'General Effect (Impact)'),
(30, 'Content, Clear Organization'),
(31, 'Delivery'),
(32, 'Pronunciation, Enunciation, and Diction'),
(33, 'Stage Presence (Eye Contact, Poise, Personality)'),
(34, 'Delivery and Mastery'),
(35, 'Persuasion / Impact'),
(36, 'Interpretation');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) NOT NULL,
  `date` varchar(30) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `status` enum('Upcoming','Ongoing','Finished') NOT NULL,
  `percentage_on_off` enum('on','off') NOT NULL,
  `allow_segment` enum('no','yes') NOT NULL DEFAULT 'no',
  `asispercentagescore` enum('yes','no') NOT NULL,
  `max_score` decimal(8,2) NOT NULL,
  `min_score` decimal(8,2) NOT NULL,
  `interval_score` decimal(8,2) NOT NULL,
  `category_select` enum('Mr','Ms','MrMs','Group') NOT NULL,
  `event_image` varchar(200) NOT NULL DEFAULT 'default.png',
  `is_show` enum('NO','YES') NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `date`, `venue`, `status`, `percentage_on_off`, `allow_segment`, `asispercentagescore`, `max_score`, `min_score`, `interval_score`, `category_select`, `event_image`, `is_show`) VALUES
(61, 'Singing Contest', '2016-05-27', 'CSPC Gymnasium', 'Upcoming', 'on', 'no', 'yes', '10.00', '7.00', '0.50', 'Mr', '1464153900Chrysanthemum.jpg', 'YES'),
(62, 'Battle of the Band', '2016-05-28', 'CSPC Gymnasium', 'Upcoming', 'on', 'no', 'yes', '10.00', '7.00', '0.50', 'Group', '1464241010Jellyfish.jpg', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `final_criteria`
--

CREATE TABLE IF NOT EXISTS `final_criteria` (
  `criteria_id` int(11) NOT NULL,
  `criteria_name` int(11) NOT NULL,
  `percentage` enum('ON','OFF') NOT NULL,
  `sort` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`criteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_score`
--

CREATE TABLE IF NOT EXISTS `final_score` (
  `f_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `done_voting` enum('YES','NO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_contestant`
--

CREATE TABLE IF NOT EXISTS `group_contestant` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `is_active` enum('YES','NO') NOT NULL,
  `group_image` varchar(100) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group_contestant`
--

INSERT INTO `group_contestant` (`group_id`, `group_name`, `number`, `is_active`, `group_image`, `event_id`) VALUES
(1, 'Maroon 5', 1, 'YES', '1464241181Penguins.jpg', 62);

-- --------------------------------------------------------

--
-- Table structure for table `individual_contestant`
--

CREATE TABLE IF NOT EXISTS `individual_contestant` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mi` varchar(10) NOT NULL,
  `type` enum('Mr','Ms') NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `is_active` enum('YES','NO') NOT NULL,
  `finalist` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `image_name` varchar(100) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `individual_contestant`
--

INSERT INTO `individual_contestant` (`con_id`, `lname`, `fname`, `mi`, `type`, `barangay`, `city`, `number`, `is_active`, `finalist`, `image_name`, `event_id`) VALUES
(15, 'Sumadero', 'Mark', 'L', 'Mr', 'lapsi', 'Nabua', 1, 'YES', 'NO', '1464227227Koala.jpg', 61),
(16, 'Agaptio', 'Jose', 'l', 'Mr', 'lapsi', 'Nabua', 2, 'YES', 'NO', '1464227256Penguins.jpg', 61);

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE IF NOT EXISTS `judge` (
  `judge_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `designation` enum('chairman','member') NOT NULL,
  `event_id` int(11) NOT NULL,
  `online_stat` enum('NO','YES') NOT NULL,
  PRIMARY KEY (`judge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`judge_id`, `name`, `designation`, `event_id`, `online_stat`) VALUES
(11, 'Jojo Marquillero', 'chairman', 53, 'YES'),
(12, 'Mark Leo Sumadero', 'member', 53, 'YES'),
(13, 'Jomar Pacer', 'member', 53, 'YES'),
(14, 'Mark Leo Sumadero', 'chairman', 61, 'YES'),
(15, 'Jojo Marquillero', 'chairman', 62, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `judge_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `segment_id` int(11) NOT NULL,
  `score` decimal(8,2) NOT NULL,
  `rank` int(11) NOT NULL,
  `done_voting` enum('YES','NO') NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`score_id`, `judge_id`, `con_id`, `group_id`, `criteria_id`, `segment_id`, `score`, `rank`, `done_voting`, `event_id`) VALUES
(126, 14, 15, 0, 25, 0, '8.50', 2, 'YES', 61),
(127, 15, 0, 1, 23, 0, '10.00', 1, 'YES', 62),
(128, 14, 16, 0, 25, 0, '9.50', 1, 'YES', 61),
(129, 15, 0, 1, 24, 0, '10.00', 1, 'YES', 62);

-- --------------------------------------------------------

--
-- Table structure for table `segment`
--

CREATE TABLE IF NOT EXISTS `segment` (
  `segment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `percentage` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`segment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_criteria`
--

CREATE TABLE IF NOT EXISTS `temp_criteria` (
  `criteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `criteriatemp_name` varchar(100) NOT NULL,
  `percentage` int(10) NOT NULL,
  `sort` int(11) NOT NULL,
  `eventemp_id` int(11) NOT NULL,
  PRIMARY KEY (`criteria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `temp_criteria`
--

INSERT INTO `temp_criteria` (`criteria_id`, `criteriatemp_name`, `percentage`, `sort`, `eventemp_id`) VALUES
(1, 'Tone Quality (Vocal Technique / Intonation)', 40, 1, 2),
(2, 'Musicianship (Dynamic Nuance, Interpretation Intonation, Diction)', 40, 2, 2),
(3, 'Deportment', 20, 3, 2),
(4, 'Tone Quality (Vocal Technique / Intonation)', 30, 1, 3),
(5, 'Blending / Harmony', 30, 2, 3),
(6, 'Musicianship (Dynamic Nuances, Interpretation, Diction)', 30, 3, 3),
(7, 'Deportment', 10, 4, 3),
(8, 'Grace and Poise', 30, 1, 4),
(9, 'Mastery and Precision', 30, 2, 4),
(10, 'Interpretation and Choreography', 20, 3, 4),
(11, 'General Effect (Costume)', 20, 4, 4),
(12, 'Mastery and Performance', 40, 1, 5),
(13, 'Choreography and Coordination', 40, 2, 5),
(14, 'General Effect (Entrance and Exit)', 20, 3, 5),
(15, 'Mastery and Performance (Grace, Poise, Rhythm)', 45, 1, 6),
(16, 'Choreography and Coordination', 40, 2, 6),
(17, 'General Effect', 15, 3, 6),
(18, 'Content, Clear Organization', 35, 1, 7),
(19, 'Delivery', 25, 2, 7),
(20, 'Pronunciation, Enunciation, and Diction', 25, 3, 7),
(21, 'Stage Presence (Eye Contact, Poise, Personality)', 15, 4, 7),
(22, 'Delivery and Mastery', 60, 1, 8),
(23, 'Pronunciation, Enunciation, and Diction', 20, 2, 8),
(24, 'Persuasion / Impact', 20, 3, 8),
(25, 'Interpretation', 40, 1, 9),
(26, 'Delivery', 40, 2, 9),
(27, 'Stage Presence', 20, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `temp_event`
--

CREATE TABLE IF NOT EXISTS `temp_event` (
  `eventemp_id` int(11) NOT NULL AUTO_INCREMENT,
  `eventemp_name` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`eventemp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `temp_event`
--

INSERT INTO `temp_event` (`eventemp_id`, `eventemp_name`, `venue`, `date`) VALUES
(2, 'Vocal Solo', 'CSPC Gymnasium', ''),
(3, 'Mixed Duet', 'CSPC Gymnasium', ''),
(4, 'Modern Dance', 'CSPC Gymnasium', ''),
(5, 'Dance Sport', 'CSPC Gymnasium', ''),
(6, 'Philippine Folkdance', 'CSPC Gymnasium', ''),
(7, 'Extemporaneous Speech', 'CSPC Gymnasium', ''),
(8, 'Oratorical Contest', 'CSPC Gymnasium', ''),
(9, 'Speech Chorus', 'CSPC Gymnasium', ''),
(10, 'Cheerdance Competition ', 'CSPC Gymnasium', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
