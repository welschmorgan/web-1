<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Installation script for webshop rush-0</title>
	<link rel="stylesheet" href="styling/alert.css">
	<link rel="stylesheet" href="styling/content.css">
</head>
<body>
<div class='content center'>
<?php
	require_once("config.php");
	$db = mysqli_connect($_GLOBALS['config']['mysql']['host'],
		$_GLOBALS['config']['mysql']['user'],
		$_GLOBALS['config']['mysql']['pass']) or die("Couldn't connect to db.");
	$create_db = "CREATE DATABASE IF NOT EXISTS `".$_GLOBALS['config']['mysql']['db']."` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;";
	if(!mysqli_query($db, $create_db))
		die("<span class='alert alert-error'>Failed creating new database: ".mysqli_error($db)."</span>");
	if (!mysqli_select_db($db, $_GLOBALS['config']['mysql']['db']))
		die("<span class='alert alert-error'>Couldnt select db: ".mysqli_error($db)."</span>");
	$create_users = "CREATE TABLE IF NOT EXISTS `users` (\n".
					"  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,\n".
					"  `first_name` varchar(255) NOT NULL,\n".
					"  `last_name` varchar(255) NOT NULL,\n".
					"  `username` varchar(255) NOT NULL,\n".
					"  `password` varchar(255) NOT NULL,\n".
					"  `email` varchar(255) NOT NULL,\n".
					"  `birthday` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,\n".
					"  `level` int(11) NOT NULL,\n".
					"  PRIMARY KEY (`id`)\n".
					") ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;";
	$create_products = "CREATE TABLE IF NOT EXISTS `products` (\n".
					"  `id` int(11) NOT NULL AUTO_INCREMENT,\n".
					"  `name` varchar(255) NOT NULL,\n".
					"  `color` varchar(255) NOT NULL,\n".
					"  `description` varchar(255) NOT NULL,\n".
					"  `category` varchar(255) NOT NULL,\n".
					"  `picture` text NOT NULL,\n".
					"  PRIMARY KEY (`id`)\n".
					") ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;";
	if (mysqli_query($db, $create_users))
	{
		echo "<span class='alert alert-success'>Successfully created users table.</span><br/>";
		if (mysqli_query($db, "INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `birthday`, `level`) VALUES\n".
						"(0, 'Morgan', 'Welsch', 'mwelsch', 'mwelsch', 'welschmorgan@gmail.com', '1989-03-22 11:33:00', 1000),\n".
						"(1, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy@gmail.com', '1989-03-22 11:33:00', 0);"))
			echo "<span class='alert alert-success'>Successfully inserted members.</span><br/>";
		else
			echo ("<span class='alert alert-error'>Couldn't insert members: ".mysqli_error($db)."</span><br/>");
	}
	else
		echo ("<span class='alert alert-error'>Couldn't create users table: ".mysqli_error($db)."</span><br/>");

	if (mysqli_query($db, $create_products))
	{
		echo "<span class='alert alert-success'>Successfully created products table.</span><br/>";
		if (mysqli_query($db, "INSERT INTO `products` (`id`, `name`, `color`, `description`, `category`, `picture`) VALUES\n".
			"(0, 'Pneus michelin', 'Noire a bandes blanches', 'Pneus a tendances gangster des etats-unis d''ameriques des ann&eacute;es 30.', 'normale gangster', 'http://www.eco-tyre.fr/media/catalog/category/Pirelli-Logo.jpg'),\n".
			"(1, 'Pneus uniroyal', 'Noire mat', 'Des pneus super bien !', 'normale pluie bas-prix', 'http://www.raid4aides.fr/images/sampledata/ja_zite/logos/logo_uniroyal.gif'),\n".
			"(2, 'Pneus goodyear', 'Noire', 'Des pneus de qualit&eacute;', 'normale qualit&eacute;', 'http://www.leparisien.fr/images/2013/10/21/3246457_goodyear.JPG'),\n".
			"(3, 'Pneus pirelli', 'Noire', 'Des pneus a la mode, comme les choux de chez nous ...', 'normale qualit&eacute; tendance', 'http://www.eco-tyre.fr/media/catalog/category/Pirelli-Logo.jpg'),\n".
			"(4, 'Pneus neige', 'Noire', 'Des pneus neige continental, ne glissez plus sous la neige', 'neige qualite', 'http://media.dvelos.com/media/manufacturers/c6da7303be1continental/continental_continental_logo.png'),\n".
			"(5, 'Pneus occasion', 'Noire', 'Des pneus de tous sortes, origines et ages', 'occasion', 'http://www.espaceagro.com/_AFFAIRE/41809.jpg');\n"))
			echo "<span class='alert alert-success'>Successfully inserted products.</span><br/>";
		else
			echo ("<span class='alert alert-error'>Couldn't insert products: ".mysqli_error($db)."</span><br/>");
	}
	else
		echo ("<span class='alert alert-error'>Couldn't create products table: ".mysqli_error($db)."</span><br/>");

	mysqli_close($db);
?>
</div>
</body>
</html>
