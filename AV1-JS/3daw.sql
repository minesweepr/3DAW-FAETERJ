-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2025 at 04:45 PM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3daw`
--

-- --------------------------------------------------------

--
-- Table structure for table `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
CREATE TABLE IF NOT EXISTS `pergunta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` enum('multipla','discursiva') NOT NULL,
  `texto` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pergunta`
--

INSERT INTO `pergunta` (`id`, `tipo`, `texto`) VALUES
(1, 'discursiva', 'o que você espera da empresa?'),
(2, 'discursiva', 'qual sua média salarial?'),
(3, 'multipla', 'escolha entre as seguintes opções'),
(4, 'multipla', 'resultado de 1+3'),
(5, 'multipla', 'qual o melhor número?'),
(6, 'multipla', 'qual linguagem de programação NÃO aprendemos em 3DAW?'),
(7, 'multipla', 'que materia a professora Ferlin ensina?'),
(8, 'multipla', 'continue a musica: we will we will...');

-- --------------------------------------------------------

--
-- Table structure for table `pergunta_multipla`
--

DROP TABLE IF EXISTS `pergunta_multipla`;
CREATE TABLE IF NOT EXISTS `pergunta_multipla` (
  `id` int NOT NULL,
  `opc_a` varchar(255) NOT NULL,
  `opc_b` varchar(255) NOT NULL,
  `opc_c` varchar(255) NOT NULL,
  `resposta` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pergunta_multipla`
--

INSERT INTO `pergunta_multipla` (`id`, `opc_a`, `opc_b`, `opc_c`, `resposta`) VALUES
(3, 'a', 'b', 'c', 'c'),
(4, '77', '5', '4', '4'),
(5, '0', '3', '7', '3'),
(6, 'php', 'javascript', 'python', 'python'),
(7, 'ESD', 'TPH', 'DAW', 'ESD'),
(8, 'rock you', 'punch you', 'calma calabreso', 'rock you');

-- --------------------------------------------------------

--
-- Table structure for table `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_pergunta` int NOT NULL,
  `resposta` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL, 
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_pergunta` (`id_pergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resposta`
--

INSERT INTO `resposta` (`id`, `id_usuario`, `id_pergunta`, `resposta`) VALUES
(1, 1, 1, 'muito'),
(2, 1, 2, 'R$5000000000000,99'),
(3, 1, 3, 'a'),
(4, 1, 4, '4'),
(5, 1, 5, '3'),
(6, 2, 1, 'empregabilidade'),
(7, 2, 2, 'R$10000'),
(8, 2, 3, 'b'),
(9, 2, 4, '4'),
(10, 2, 5, '0');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Gabriel', 'gabriel@hotmail.com', 'senha123'),
(2, 'Vinicius', 'vzn@gmail.com', 'senha123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pergunta_multipla`
--
ALTER TABLE `pergunta_multipla`
  ADD CONSTRAINT `pergunta_multipla_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pergunta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
