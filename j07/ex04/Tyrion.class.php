<?
	class Tyrion extends Lannister
	{
		public function sleepWith($other)
		{
			// Tyrion wanna fuck Sansa
			if (is_a($other, 'Sansa'))
				echo ("Let's do this.".PHP_EOL);
			else
				echo ("Not even if I'm drunk !".PHP_EOL);
		}
		static public function doc(){ return "Tyrion Lannister is the youngest son of Joanna Lannister."; }
		static public $verbose = False;
	}
?>
