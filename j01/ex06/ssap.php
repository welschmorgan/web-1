#!/usr/bin/php
<?php
	function epur($str)
	{
		$arg = trim($str);
		$out = preg_replace('/ +/', ' ', $arg);
		return ($out);
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
		sort($final);
		foreach ($final as $word)
		{
			echo $word."\n";
		}
	}
	do_args($argv);
?>
