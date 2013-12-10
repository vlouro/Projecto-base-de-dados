-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2013 at 09:15 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `colecao`
--

-- --------------------------------------------------------

--
-- Table structure for table `colecao`
--

CREATE TABLE IF NOT EXISTS `colecao` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_name` varchar(200) NOT NULL,
  `game_code` varchar(100) NOT NULL,
  `game_console` varchar(50) DEFAULT NULL,
  `game_format` varchar(20) DEFAULT NULL,
  `game_type` varchar(75) NOT NULL,
  `game_state` varchar(60) NOT NULL,
  `game_year` int(11) NOT NULL,
  `game_price` float NOT NULL,
  `game_borrowed` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`game_id`),
  UNIQUE KEY `game_code` (`game_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `colecao`
--

INSERT INTO `colecao` (`game_id`, `game_name`, `game_code`, `game_console`, `game_format`, `game_type`, `game_state`, `game_year`, `game_price`, `game_borrowed`) VALUES
(7, 'Fifa 13', '48', 'Playstation 3', 'FÃ­sico', 'Desporto', 'Semi-Novo', 2012, 1, 'disp'),
(42, 'World of Warcraft', '123456', 'PC', 'Digital', 'RPG', 'Novo', 2004, 5, 'IndisponÃ­vel'),
(43, 'Naruto Ultimate Ninja Storm 3', '456789', 'Playstation 3', 'FÃ­sico', 'AcÃ§Ã£o', 'Novo', 2013, 50, 'Disponivel'),
(44, 'Resident Evil 6', '197070', 'Playstation 3', 'FÃ­sico', 'AcÃ§Ã£o', 'Semi-Novo', 2012, 20, 'DisponÃ­vel'),
(45, 'Tales of Grace F', '5749600', 'Playstation 3', 'FÃ­sico', 'RPG', 'Novo', 2012, 24, 'DisponÃ­vel'),
(46, 'Burnout', '5759456', 'PSP', 'FÃ­sico', 'Corridas', 'Semi-Novo', 2008, 30, 'DisponÃ­vel'),
(47, 'Naruto Ultimate Ninja Storm 2', '3485869', 'Playstation 3', 'FÃ­sico', 'AcÃ§Ã£o', 'Semi-Novo', 2011, 50, 'Emprestado');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_mail` varchar(150) DEFAULT NULL,
  `user_password` varchar(30) DEFAULT NULL,
  `user_time` datetime NOT NULL,
  `user_code` varchar(32) NOT NULL,
  `user_activated` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_time`, `user_code`, `user_activated`) VALUES
(3, 'Valter Louro', 'valterlouro@gmail.com', 'vaQ/hE1aox1Vs', '2013-02-25 18:36:21', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(4, 'Nuno', 'oliveira_junior@gmail.com', 'olfTfv4/4iQb2', '2013-03-11 18:43:01', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(10, '', '', '$1$CGbwoQFc$b/NShjF1WgOaG6nMdI', '2013-03-11 19:50:30', 'd41d8cd98f00b204e9800998ecf8427e', 0);
