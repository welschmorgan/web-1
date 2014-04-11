<?php
	require_once("Norme/Norme.class.php");

	class Point extends Norme
	{
		private $_x = 0;
		private $_y = 0;

		public function __construct($xx = 0, $yy = 0)
		{
			parent::__construct();
			$this->x = $xx;
			$this->y = $yy;
		}

		public function getX() { return $this->_x; }
		public function getY() { return $this->_y; }
		public function setX(int $x) { $this->_x = $x; }
		public function setY(int $y) { $this->_y = $y; }
		public function set(int $x, int $y) { $this->_y = $y; $this->_x = $x; }

		public function op(Point $other, string $op)
		{
			switch($op)
			{
				case '+':
					return (new Point($this->x + $other->x, $this->y + $other->y));
				case '-':
					return (new Point($this->x - $other->x, $this->y - $other->y));
				case '*':
					return (new Point($this->x * $other->x, $this->y * $other->y));
				case '/':
					return (new Point($this->x / $other->x, $this->y / $other->y));
				case '%':
					return (new Point($this->x % $other->x, $this->y % $other->y));
				case '=':
					return (new Point($this->x = $other->x, $this->y = $other->y));
			}
			return ($this);
		}

		public function add(Point $other){ return ($this->op($other, '+')); }
		public function sub(Point $other){ return ($this->op($other, '-')); }
		public function mul(Point $other){ return ($this->op($other, '*')); }
		public function div(Point $other){ return ($this->op($other, '/')); }
		public function mod(Point $other){ return ($this->op($other, '%')); }
		public function assign(Point $other){ return ($this->op($other, '=')); }

		static public function doc(){ return file_get_contents("Point/Point.doc.txt"); }
		public function __toString(){
			return ("Point (x: ".str_pad((int)$this->x, 3, ' ', STR_PAD_LEFT)
					.", y: ".str_pad((int)$this->x, 3, ' ', STR_PAD_LEFT)
					." )");
		}
	}
?>
