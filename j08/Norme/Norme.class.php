<?php
	class Norme
	{
		static public $verbose = False;

		public function __construct()
		{
			if (self::$verbose)
				print($this. " constructed.");
		}

		public function __destruct()
		{
			if (self::$verbose)
				print($this. " destructed.");
		}
		static public function doc(){ return "";}
	}
?>
