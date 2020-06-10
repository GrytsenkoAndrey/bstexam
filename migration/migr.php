<?php

$link = mysql_connect('localhost', 'bstuser', 'bstuserpass');
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}

$sql = 'CREATE DATABASE IF NOT EXISTS bst_db DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
if (mysql_query($sql, $link)) {
    echo "База my_db успешно создана\n";
	
	
	$db_selected = mysql_select_db('bst_db', $link);
	if (!$db_selected) {
		die ('Не удалось выбрать базу foo: ' . mysql_error());
	}


	$sql = "CREATE TABLE `favorite` (
	  `id` int(11) NOT NULL,
	  `user_login` varchar(80) NOT NULL,
	  `contact_id` tinyint(4) UNSIGNED DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	mysql_query($sql);

	$sql = "INSERT INTO `favorite` (`id`, `user_login`, `contact_id`) VALUES
	(1, 'qwe@qwe', 1),
	(2, 'r@r', 5),
	(3, 'r@r', 8),
	(4, 'qwe@qwe', 6),
	(5, 'qwe@qwe', 1)";

	mysql_query($sql);

	$sql = "CREATE TABLE `users` (
	  `id` tinyint(4) UNSIGNED NOT NULL,
	  `login` varchar(80) NOT NULL,
	  `password` varchar(60) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT";

	mysql_query($sql);

	$sql = "INSERT INTO `users` (`id`, `login`, `password`) VALUES
	(1, 'test@test', '$2y$10$wYq6SoAaXnuS1nHnia4wAujucgj.m.2eizSGjqrnx.vYO5jmneHZO'),
	(2, 'asd@asd', '$2y$10$2kD7Twa23o2U/dBRm5t9..FA4rGHMLubWWcZlQEjmFQF4dJQYtc9S'),
	(3, 'qwe@qwe', '$2y$10$fynQha0xjCGPHG.o0swNIefN5A1kWeg8dO2n/eouu0Yb.UdxohfDa'),
	(4, 'a@a', '$2y$10$k8CGSbdtJJaLT84xaL3N2eSF6rgxaVxV0GiicfEETni7U2t72qa2i'),
	(5, 'b@b', '$2y$10$DZixgfuAvm6zJZoVsfiTTOA4OkeHB7yQ0szzU7a3AyQ5xvJq..81y'),
	(6, 'c@c', '$2y$10$peWAKlR7cBW9mAzehAkQJ.CaYAvXFt6m9kOyZOgi3EwXg2.RkjUya'),
	(7, 'd@d', '$2y$10$vJqWdSFWtKKT7eymDbQahuqOIqyLSrKllb1iM.d/j5NaGbGDBY9JO'),
	(8, 'e@e', '$2y$10$w3GvD0HE0xwwvT2ce1uEqukzrCY8L77rQ7KLUemZgIZMVp8MhGYzK'),
	(9, 'f@f', '$2y$10$rYIQ0Ijhx3kv819f6udpb.bFwUCr1KRMKGPU/Z3v0fQ6bSXjbmHJe'),
	(10, 'g@g', '$2y$10$b73kW./PCqfYhedK223BnegbGcrdbVkB2S7.y6IjXhUikX8EYL2dW'),
	(11, 'h@h', '$2y$10$aI66Jzv16RgqXSNpdw1b/OvYqvTBLb6PmmckdUjqCXr2X/YtFTplW'),
	(12, 't@t', '$2y$10$wInJdOrj1Br.a7svXL/1m.slr.agE1d7tje1CW770RJP8U/8w/ygG'),
	(13, 'r@r', '$2y$10$anK6q7ABLG/7reVKz2IKWeD.R6Eq4dwz5dv3hWxZEVMR6ZtbwsGFO')";

	mysql_query($sql);

	$sql = "ALTER TABLE `favorite`
	  ADD PRIMARY KEY (`id`),
	  ADD KEY `contact_id` (`contact_id`)";

	mysql_query($sql);

	$sql = "ALTER TABLE `users` ADD PRIMARY KEY (`id`)";

	mysql_query($sql);


	$sql = "ALTER TABLE `favorite` ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE";

	mysql_query($sql);

	$sql = "CREATE USER `bstuser`@`localhost` IDENTIFIED BY `bstuserpass`";

	mysql_query($sql);

	$sql = "GRANT ALL ON `bst_db` TO `bstuser`@`localhost`";

	mysql_query($sql);
	
	
} else {
    echo 'Ошибка при создании базы данных: ' . mysql_error() . "\n";
}

