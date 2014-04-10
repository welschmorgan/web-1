<?php
class NightsWatch implements IFighter
{
	private $_fighters;

	public function __construct(){ $this->_fighters = array(); }

	public function recruit($fighter)
	{
		if (is_a($fighter, 'IFighter'))
			$this->_fighters[] = $fighter;
	}

	public function fight()
	{
		foreach ($this->_fighters as $f)
			$f->fight();
	}

	static public function doc(){ return "A military order which holds and guards the Wall."; }
	static public $verbose = False;
};
?>
