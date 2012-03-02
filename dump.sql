DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` int(11)  NOT NULL,
  `first_name` varchar(50)  NOT NULL,
  `middle_name` varchar(50)  NOT NULL,
  `last_name` varchar(50)  NOT NULL,
  `city` varchar(100)  NOT NULL,
  `street` varchar(100)  NOT NULL,
  `birthday` DATE  NOT NULL,
  `phone` varchar(50)  NOT NULL
)
ENGINE = MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
