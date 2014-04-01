#!/usr/bin/php
<?php
	if (count($argv) != 2)
		exit (1);
	$arg = trim($argv[1]);
	$out = preg_replace('/ +/', ' ', $arg);
	echo $out."\n";
?>
