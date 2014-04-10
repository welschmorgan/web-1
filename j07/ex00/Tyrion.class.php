<?php
	class Tyrion extends Lannister
	{
		var $_name;
		var $_size;

		public function __construct($name = "Tyrion", $size = "Short") {
			parent::__construct();
			$this->_size = $size;
			$this->_name = $name;
			print("My name is ".$this->_name.PHP_EOL);
		}
		public function getSize() {
			return $this->_size;
		}
		static public function doc(){ return "Tyrion Lannister is the youngest son of Joanna Lannister."; }
		static public $verbose = False;
	};
?>
