<?php
	class Fleet extends Norme
	{
		private $_soldiers;

		public function __construct($size_x = 0, $size_y = 0)
		{
			parent::__construct();
			$this->_soldiers = array();
		}

		public function getSize() { return $this->_size;}
		public function getWidth() { return $this->_size->getWidth(); }
		public function getHeight() { return $this->_size->getHeight(); }
		static public function doc(){ return file_get_contents("Grid/Grid.doc.txt"); }
		public function __toString(){
			return ("Army (" . count($this->_soldiers) . ")");
		}
	}
?>
