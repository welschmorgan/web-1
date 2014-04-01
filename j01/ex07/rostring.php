#!/usr/bin/php
<?php
	function epur($str)
	{
		$arg = trim($str);
		$out = preg_replace('/ +/', ' ', $arg);
		return ($out);
	}

	function rostring($arg)
	{
		$r = explode(" ", epur($arg));
		if (isset($r[0]))
		{
			$r[] = $r[0];
			reset($r);
			$key = key($r);
			unset($r[$key]);
			reset($r);
		}
		$final = array();
		foreach($r as $item)
		{
			if (!empty($item))
				$final[] = $item;
		}
		return (join(" ", $final));
	}

	if (isset($argv[1]))
		echo rostring($argv[1])."\n";
?>
