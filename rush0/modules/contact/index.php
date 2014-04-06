<?php
	$action = isset($_GET['action']) ? $_GET['action'] : "show";
	$index = "";
	switch($action)
	{
		case "mail":
			$index = "evoisin@student.42.fr; mwelsch@student.42.fr;";
		break;
		case "tel":
			$index = "0606060606 0660554919";
		break;
		default:
	}
	$_GLOBALS['modules']['contact']['index'] = $index;
	$_GLOBALS['modules']['contact']['scripts'] = array();
	$_GLOBALS['modules']['contact']['styles'] = array();
?>
