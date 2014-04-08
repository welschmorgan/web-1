<?php
	$_GLOBALS['config']['site']['title'] = "Éléonore & Morgan's Shop";
	$_GLOBALS['config']['mysql']['host'] = "localhost";
	$_GLOBALS['config']['mysql']['user'] = "root";
	$_GLOBALS['config']['mysql']['pass'] = "amXXQ4ctr59U7PNb";
	$_GLOBALS['config']['mysql']['db'] = "rush-0";
	if (isset($_SESSION['basket']))
	{
		$a = array(
			"Panier (".count($_SESSION['basket']).")" => array(
				"href" => "?module=basket",
				"title" => "Voir son panier."
			));
		$items = array();
		foreach ($_SESSION['basket'] as $item)
		{
			$items[$item['name']] = array(
				"href" => "?module=catalogue&action=show_id&id=".$item['id'],
				"title" => "Voir son l'article."
			);
		}
		$left_logged = array_merge($a, $items);
	}
	else
		$left_logged = array(
			"Panier (vide)" => array(
				"href" => "?module=basket",
				"title" => "Voir son panier."
			));
	$left_unlogged = array(
		"Inscription" => array(
			"href" => "?module=register",
			"title" => "S'inscrire sur le site."
		),
		"Connexion" => array(
			"href" => "?module=login",
			"title" => "Se connecter au site."
		)
	);
	$right_unlogged = array();
	$right_logged = array(
		"Voir son compte" => array(
			"href" => "/?module=account&action=show",
			"title" => "Voir son compte."
		),
		"Editer son compte" => array(
			"href" => "/?module=account&action=show",
			"title" => "Voir son compte."
		),
		"Supprimer son compte" => array(
			"href" => "/?module=account&action=delete",
			"title" => "Supprimer son compte."
		),
		"Déconnexion" => array(
			"href" => "/?module=logout",
			"title" => "Se déconnecter."
		)
	);
	$_GLOBALS['config']['menu']['left'] = isset($_SESSION['username']) ? $left_logged : $left_unlogged;
	$_GLOBALS['config']['menu']['right'] = isset($_SESSION['username']) ? $right_logged : $right_unlogged;


/*
** Global funcs
*/
	function get_post_get($name, $default = "")
	{
		return (isset($_GET[$name]) ? $_GET[$name] : ( isset($_POST[$name]) ? $_POST[$name] : $default));
	}
?>
