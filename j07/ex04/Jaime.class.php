<?
	class Jaime extends Lannister
	{
		public function sleepWith($other)
		{
			// Jaime wanna fuck Cersei in a weird tower
			// Jaime wanna fuck Sansa
			// Jaime refuse Tyrion
			if (is_a($other, 'Cersei'))
				echo ("With pleasure, but only in a tower in Winterfell, then.".PHP_EOL);
			else if (is_a($other, 'Sansa'))
				echo "Let's do this.".PHP_EOL;
			else if (is_a($other, 'Tyrion'))
				echo "Not event if I'm drunk !".PHP_EOL;
			else
				echo parent::sleepWith($other);
		}
		static public function doc(){ return "Ser Jaime Lannister is a knight of the Kingsguard."; }
		static public $verbose = False;
	}
?>
