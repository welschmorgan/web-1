<?php
	require_once("Norme/Norme.class.php");

	class Tile extends Norme
	{
		private $_type;
		private $_objects;
		private $_position;

		public static $Types = array(
			"Empty" => 0,
			"Obstacle" => 1
		);

		public function __construct($type, Point $pos)
		{
			parent::__construct();
			$this->_type = $type;
			$this->_objects = array();
			$this->_position = $pos;
		}

		public function getName() { return $this->name; }
		public function setName($name) { $this->name = $name; }

		public function getType() { return $this->_type; }
		public function setType($type) { $this->_type = $type; }

		public function getPosition() { return $this->_position; }

		public function objectEnter(mixed $object){ $this->_objects[] = $object; }
		public function objectLeave(mixed $object){ $this->_objects[] = $object; }
		public function __toString()
		{
			print (" Tile ( type: ".$this->_type.", position: ".$this->_position." )")
		}
	}
?>
