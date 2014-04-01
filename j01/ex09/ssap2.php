#!/usr/bin/php
<?php
	function epur($str)
	{
		$arg = trim($str);
		$out = preg_replace('/ +/', ' ', $arg);
		return ($out);
	}

	function custom_sort($a, $b)
	{
		if (ctype_alpha($a[0]) && ctyle_alpha($b[1]))
			return (strcasecmp($a, $b));
		if (ctype_digit($a[0]) && ctype_digit($b[0]))
			return ($a > $b ? 1 : ($a == $b ? 0 : -1));
		return ($ret < 0 ? 1 : ($ret == 0 ? 0 : -1));
	}

	function do_args($argvec)
	{
		$args = $argvec;
		reset($args);
		$key = key($args);
		unset($args[$key]);
		$final = array();
		foreach ($args as $arg)
		{
			$pur = explode(" ", epur($arg));
			$final = array_merge($final, $pur);
		}
		usort($final, "custom_sort");
		foreach ($final as $word)
		{
			echo $word."\n";
		}
	}
	do_args($argv);
?>
