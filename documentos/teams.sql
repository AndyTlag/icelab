-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: 01-Jun-2020 às 20:44
-- Versão do servidor: 10.3.14-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teams`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `CadProd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CadProd` (IN `prod_nome` VARCHAR(55), IN `prod_valor` DOUBLE, IN `prod_desc` VARCHAR(255), IN `prod_img` VARCHAR(255))  BEGIN
	INSERT INTO tm_produto (prod_nome,prod_valor,prod_desc,prod_img)
	VALUES (prod_nome,prod_valor,prod_desc,prod_img);   
END$$

DROP PROCEDURE IF EXISTS `DelProd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelProd` (IN `prod_cod` INT)  BEGIN
DELETE 
FROM tm_produto WHERE prod_id = prod_cod;
END$$

DROP PROCEDURE IF EXISTS `SelProd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SelProd` (IN `prod_cod` INT)  BEGIN
SELECT *
FROM tm_produto where prod_id = prod_cod;
END$$

DROP PROCEDURE IF EXISTS `UpdProd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdProd` (IN `prod_cod` INT, IN `prod_nome` VARCHAR(55), IN `prod_valor` DOUBLE, IN `prod_desc` VARCHAR(255), IN `prod_img` VARCHAR(255))  BEGIN
	UPDATE tm_produto 
	SET prod_nome= prod_nome, 
	prod_valor= prod_valor, 
	prod_desc= prod_desc, 
	prod_img= prod_img 
	WHERE prod_id= prod_cod;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tm_produto`
--

DROP TABLE IF EXISTS `tm_produto`;
CREATE TABLE IF NOT EXISTS `tm_produto` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_nome` varchar(55) NOT NULL,
  `prod_valor` double NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tm_produto`
--

INSERT INTO `tm_produto` (`prod_id`, `prod_nome`, `prod_valor`, `prod_desc`, `prod_img`) VALUES
(19, 'teste', 999.99, '                         kkkkkkkkkkk     \r\n      \r\n      \r\n      ', '09f0945ecbc2fdd4588462c6248b1320.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tm_usuario`
--

DROP TABLE IF EXISTS `tm_usuario`;
CREATE TABLE IF NOT EXISTS `tm_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(10) NOT NULL,
  `usu_email` varchar(55) NOT NULL,
  `usu_senha` varchar(50) NOT NULL,
  `usu_status` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tm_usuario`
--

INSERT INTO `tm_usuario` (`usu_id`, `usu_nome`, `usu_email`, `usu_senha`, `usu_status`) VALUES
(1, 'picolab', 'picolab@picolab.com', '202cb962ac59075b964b07152d234b70', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
