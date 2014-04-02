#!/usr/bin/php
<?php
	if (count($argv) >= 2)
	{
		$arg = trim($argv[1]);
		$out = preg_replace('/\s+/', ' ', $arg);
		echo $out."\n";
	}
?>
