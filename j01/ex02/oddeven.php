#!/usr/bin/php
<?php

function	ask_input(&$input)
{
	echo "Entrez un nombre: ";
	$handle = fopen ("php://stdin","r");
	$input = "";
	$line = fgets($handle);
	if (empty($line))
		exit (1);
	$line = trim($line);
	$num = is_numeric($line);
	if (!$num && empty($line))
	{
		echo "'".$line."' n'est pas un chiffre\n";
		return (false);
	}
	if (!$num)
	{
		echo "'".$line."' n'est pas un chiffre\n";
		return (false);
	}
	$input = $line;
	fclose ($handle);
	return (true);
}

function parity_name($nbr)
{
	return (($nbr % 2) ? "impair" : "pair");
}
$input = "";
while (42)
{
	if (ask_input($input))
		echo "Le nombre ".$input." est ".parity_name($input).".\n";
}

?>
