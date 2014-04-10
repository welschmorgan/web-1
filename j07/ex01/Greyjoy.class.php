<?php

class Greyjoy {
	protected $familyMotto;

	public function __construct(){
		$this->familyMotto = "We do not sow";
	}
	static public function doc(){ return "House Greyjoy is one of the Great Houses of Westeros."; }
	static public $verbose = False;
}

?>
