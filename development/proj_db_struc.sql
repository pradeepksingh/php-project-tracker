-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2009 at 07:44 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `mahcuz`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `project_author` varchar(50) NOT NULL,
  `project_desc` text NOT NULL,
  `alias` varchar(200) NOT NULL,
  `has_release` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_author`, `project_desc`, `alias`, `has_release`) VALUES
(1, 'Test 1', 'admin', 'Testing 1 Description', 'test-1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_changelogs`
--

CREATE TABLE IF NOT EXISTS `project_changelogs` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_version` varchar(6) NOT NULL,
  `log_type` varchar(20) NOT NULL,
  `log_title` varchar(200) NOT NULL,
  `log_desc` varchar(600) NOT NULL DEFAULT '',
  `log_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_changelogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_releases`
--

CREATE TABLE IF NOT EXISTS `project_releases` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_author` varchar(50) NOT NULL,
  `project_version` varchar(4) NOT NULL,
  `project_stage` varchar(70) NOT NULL,
  `project_download` varchar(400) NOT NULL DEFAULT '#',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `project_releases`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE IF NOT EXISTS `project_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access_level` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `username`, `password`, `access_level`) VALUES
(1, 'admin', 'letmein', 4);