<?php

class Lannister
{
	public function __construct()
	{}

	public function sleepWith($other)
	{
		// Lannisters fuck each other
		if (is_a($other, 'Lannister'))
			echo ("Let's do this.".PHP_EOL);
		else
			echo ("Not even if I'm drunk !".PHP_EOL);
	}
	static public function doc(){ return "House Lannister is one of the Great Houses of Westeros."; }
	static public $verbose = False;
}
?>
