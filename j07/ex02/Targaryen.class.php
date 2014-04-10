<?php
	class Targaryen
	{
		public function resistsFire() {
			return False;
		}

		public function getBurned() {
			if ($this->resistsFire())
				return ("emerges naked but unharmed");
			return ("burns alive");
		}
		static public function doc(){ return "House Targaryen is one of the former Great Houses of Westeros."; }
		static public $verbose = False;
	}
?>
