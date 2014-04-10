<?php
	class Vertex
	{
		private $_x = 0.0;
		private $_y = 0.0;
		private $_z = 0.0;
		private $_w = 1.0;
		private $_color = NULL;

		static public $verbose = False;

		public function __construct(array $r)
		{
			if (isset($r) && is_array($r))
			{
				$this->_color = new Color(array('rgb' => 255 << 16 + 255 << 8 + 255));
				if (isset($r['x']))
					$this->setX($r['x']);
				else if (isset($r['y']))
					$this->setY($r['y']);
				else if (isset($r['z']))
					$this->setZ($r['z']);
				else if (isset($r['w']))
					$this->setW($r['w']);
				else if (isset($r['color']))
					$this->setColor($r['color']);
			}
			if (self::$verbose)
				print($this." constructed.".PHP_EOL);
		}

		public function __destruct()
		{
			if (self::$verbose)
				print($this." destructed.".PHP_EOL);
		}

		static public function doc()
		{
			return (file_get_contents("Vertex.doc.txt"));
		}

		public function __toString(){
			if (self::$verbose)
				return ("Vertex ( x: ".str_pad(doubleval($this->_x), 3, ' ', STR_PAD_LEFT).
					", y: ".str_pad(doubleval($this->_y), 3, ' ', STR_PAD_LEFT).
					", z: ".str_pad(doubleval($this->_z), 3, ' ', STR_PAD_LEFT).
					", w: ".str_pad(doubleval($this->_w), 3, ' ', STR_PAD_LEFT).
					", color: ".$this->_color." )");
			return ("Vertex ( x: ".str_pad(doubleval($this->_x), 3, ' ', STR_PAD_LEFT).
					", y: ".str_pad(doubleval($this->_y), 3, ' ', STR_PAD_LEFT).
					", z: ".str_pad(doubleval($this->_z), 3, ' ', STR_PAD_LEFT).
					", w: ".str_pad(doubleval($this->_w), 3, ' ', STR_PAD_LEFT)." )");
		}

		public function setX($x){ $this->_x = $x; }
		public function setY($y){ $this->_y = $y; }
		public function setZ($z){ $this->_z = $z; }
		public function setW($z){ $this->_w = $w; }
		public function setColor($col){ $this->_color = $color; }

		public function x(){ return $this->_x; }
		public function y(){ return $this->_y; }
		public function z(){ return $this->_z; }
		public function w(){ return $this->_w; }
		public function color(){ return $this->_color;}
	}
?>