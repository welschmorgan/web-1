<?php
	function generate_menu($arr)
	{
		$code = "<ul>\n";
		foreach ($arr as $entry_name => $entry_attr)
		{
			$code .= "<li><a";
			foreach ($entry_attr as $name => $val)
				$code .= " " . $name . "=\"" . $val . "\"";
			$code .= ">".$entry_name."</a></li>\n";
		}
		$code .= "</ul>\n";
		return ($code);
	}
	function generate_left_menu()
	{
		global $_GLOBALS;
		global $_SESSION;
		return (generate_menu($_GLOBALS['config']['menu']['left']));
	}
	function generate_right_menu()
	{
		global $_GLOBALS;
		global $_SESSION;
		if (!isset($_SESSION['username']))
			return ("<span class='alert'>Inscrivez-vous d'abord pour avoir acces a la partie membre.</span>");
		return (generate_menu($_GLOBALS['config']['menu']['right']));
	}
?>
