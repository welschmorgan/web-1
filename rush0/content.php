<?php
	function generate_content_config($module, $property = "")
	{
		global $_GLOBALS;
		if (!isset($module) || empty($module))
			return ("");
		$module_path = "modules/" . $module . "/index.php";
		if (file_exists($module_path))
		{
			require_once($module_path);
			$mod = isset($_GLOBALS['modules'][$module]) ?
					$_GLOBALS['modules'][$module] :
					NULL;
			if (isset($property))
			{
				if (isset($mod[$property]))
					return ($mod[$property]);
				return ("");
			}
			return ($mod);
		}
		return (NULL);
	}
	function generate_content_index($module)
	{
		$mod = generate_content_config($module, "index");
		if (!isset($mod))
			return ("Module '$module' does not exist !");
		return $mod;
	}
	function generate_content_header($module)
	{
		$mod = generate_content_config($module, "header");
		if (!isset($mod))
			return ("");
		return $mod;
	}
	function generate_content_footer($module)
	{
		$mod = generate_content_config($module, "footer");
		if (!isset($mod))
			return ("");
		return $mod;
	}
	function generate_content_styles($module)
	{
		$mod = generate_content_config($module, "styles");
		if (!isset($mod))
			return (array());
		return ($mod);
	}
	function generate_content_scripts($module)
	{
		$mod = generate_content_config($module, "scripts");
		if (!isset($mod))
			return (array());
		return ($mod);
	}
?>
