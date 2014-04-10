<?php
	class UnholyFactory
	{
		private $_types;
		private $_soldiers;

		public function __construct(){ $this->_soldiers = array(); }

		public function absorb($fighter){
			if (is_a($fighter, 'Fighter'))
			{
				if ($this->contains((string)$fighter))
				{
					echo "(Factory already absorbed a fighter of type ".(string)$fighter.")".PHP_EOL;
				}
				else
				{
					echo "(Factory absorbed a fighter of type ".(string)$fighter.")".PHP_EOL;
					$this->_soldiers[(string)$fighter] = $fighter;
				}
			}
			else
				echo "(Factory can't absorb this, it's not a fighter)".PHP_EOL;
		}

		public function fabricate($name){
			if ($this->contains((string)$name))
			{
				$f = $this->_soldiers[$name];
				echo "(Factory fabricates a fighter of type " . $f . ")" . PHP_EOL;
				return clone $f;
			}
			return (NULL);
		}

		public function contains($name){ return (array_key_exists($name, $this->_soldiers)); }

		static public function doc(){ return "A factory that creates fighters."; }
		static public $verbose = False;
	}
?>
