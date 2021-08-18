-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Ago-2021 às 17:03
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `response`
--
CREATE DATABASE IF NOT EXISTS `response` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `response`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cl_response`
--

CREATE TABLE IF NOT EXISTS `cl_response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_option` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tabela antes do insert `cl_response`
--

TRUNCATE TABLE `cl_response`;
--
-- Extraindo dados da tabela `cl_response`
--

INSERT INTO `cl_response` (`id`, `ID_option`, `descricao`, `photo`, `date`, `type`, `user`) VALUES
(7, 8, 'olaaaaa', 'www.google.com', '2021-01-01', 10, 0),
(9, 1, '$b', '$c', '2021-08-09', 1, 1),
(10, 1, '$b', '$c', '2021-08-09', 1, 1),
(11, 0, '', '', '0000-00-00', 0, 0),
(12, 1, 'aobaaa', 'www.casasbahia.com.br', '0000-00-00', 1, 0),
(13, 1, 'aobaaa', 'www.casasbahia.com.br', '2021-08-09', 1, 0),
(14, 0, '', '', '2021-08-09', 0, 0),
(15, 78, 'tamojunto', 'www.kabummmmm.com.br', '2021-08-09', 7, 0),
(16, 14, 'taeeeeeee', 'www.atchimmmmmm.com.br', '2021-08-10', 8, 0),
(17, 1, 'ta', NULL, '0000-00-00', 1, 1),
(18, 1, 'ta', NULL, '0000-00-00', 1, 1),
(19, 1, 'ta', NULL, '0000-00-00', 1, 1),
(20, 1, 'ta', '1_photo', '0000-00-00', 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
