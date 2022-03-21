

CREATE TABLE `bot_history` (
  `id` int(11) NOT NULL,
  `chat_id` int(55) NOT NULL,
  `username` text CHARACTER SET utf8mb4 NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `full_data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `car_db` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `chat_id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `bot_history`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `car_db`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bot_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `car_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
