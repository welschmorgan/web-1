<?php

class House {
	public function introduce() {
		return "House " . $this->getHouseName() . " : \"".$this->getHouseMotto()."\"";
	}
	static public function doc(){ return "The Great Houses are the most powerful of the noble houses of the Seven Kingdoms."; }
	static public $verbose = False;
}

?>
