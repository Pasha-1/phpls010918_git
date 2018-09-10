SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `hose_num` varchar(255) NOT NULL,
  `corp` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `change_requered` tinyint(1) NOT NULL,
  `card_payment` tinyint(1) NOT NULL,
  `do_not_call` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`id`, `name`, `email`, `tel`, `street`, `hose_num`, `corp`, `room`, `floor`, `comments`, `change_requered`, `card_payment`, `do_not_call`) VALUES
(38, 'Сеня', 'dd@dg.fh', ' 7 (567) 752 79 02', 'внв', '1', '1', '1', '1', '', 0, 1, 0),
(39, 'Вася', 'dd@dg.fh', ' 7 (755) 460 37 01', 'новов', '2', '2', '2', '2', '', 0, 0, 1);

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `PersonID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `orders` (`OrderID`, `PersonID`) VALUES
(110, 38),
(111, 38),
(112, 39);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `PersonID` (`PersonID`);

ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`PersonID`) REFERENCES `customer` (`id`);
COMMIT;