#!/usr/bin/php

<?php
	function epur($str)
	{
		$arg = trim($str);
		return (preg_replace('/\s+/', ' ', $str));
	}
	$days = array("lundi",
					"mardi",
					"mercredi",
					"jeudi",
					"vendredi",
					"samedi",
					"dimanche");
	$month = array("janvier", "fevrier", "mars", "avril", "mai", "juin",
					"juillet", "aout", "septembre", "octobre", "novembre",
					"decembre");
	function extract_day_id($str)
	{
		global $days;
		for($i = 0; $i < count($days); $i ++)
		{
			if ($days[$i] == strtolower($str))
				return ($i);
		}
		return (-1);
	}
	function extract_month_id($str)
	{
		global $month;
		for($i = 0; $i < count($month); $i ++)
		{
			if ($month[$i] == strtolower($str))
				return ($i);
		}
		return (-1);
	}

	function err()
	{
		return ("Wrong Format");
	}

	function parse_date($str)
	{
		global $days;
		global $month;
		$dte = explode(' ', epur($str));
		if (count($dte) != 5)
			return ("Wrong Format");
		$wd = extract_day_id($dte[0]);
		$d = $dte[1];
		if (strlen($d) != 2)
			return (err());
		$m = extract_month_id($dte[2]);
		$y = $dte[3];
		if (strlen($y) != 4)
			return (err());
		$t = explode (':', epur($dte[4]));
		if (count($t) != 3)
			return (err());
		if (strlen($t[0]) != 2 || strlen($t[1]) != 2 || strlen($t[2]) != 2)
			return (err());
		return (mktime($t[0],$t[1],$t[2], $m, $d, $y));
	}
	if (isset($argv[1]))
		echo parse_date($argv[1]), "\n";
?>
