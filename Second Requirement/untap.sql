
-- --------------------tables schema----------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `untap`
--
CREATE DATABASE IF NOT EXISTS untap;
USE untap;
-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `amount` double NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);



-- --------------------tables data----------------------

INSERT INTO `customers` (`customer_id`, `customer_name`) VALUES
(1, 'omar'),
(2, 'hesham'),
(3, 'salma'),
(4, 'khaled'),
(7, 'ABC'),
(8, 'XYZ');



INSERT INTO `orders` (`order_id`, `order_date`, `amount`, `customer_id`) VALUES
(1, '2017-12-07 00:00:00', 50, 7),
(2, '2017-12-04 00:00:00', 20, 8),
(3, '2017-12-08 00:00:00', 80, 7),
(4, '2017-12-17 00:00:00', 200, 1),
(5, '2017-12-12 00:00:00', 200, 8);

COMMIT;

