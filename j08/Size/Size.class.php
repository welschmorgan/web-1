<?php
	require_once("Norme/Norme.class.php");

	class Size extends Norme
	{
		private $_width = 0;
		private $_height = 0;

		public function __construct($w = 0, $h = 0)
		{
			parent::__construct();
			$this->_width = $w;
			$this->_height = $h;
		}

		public function getWidth() { return $this->_width; }
		public function getHeight() { return $this->_height; }
		public function setWidth(int $w) { $this->_width = $w; }
		public function setHeight(int $h) { $this->_height = $h; }
		public function set(int $w, int $h) { $this->_width = $w; $this->_height = $h; }

		public function op(Point $other, string $op)
		{
			switch($op)
			{
				case '+':
					return (new Size($this->width + $other->width, $this->height + $other->height));
				case '-':
					return (new Size($this->width - $other->width, $this->height - $other->height));
				case '*':
					return (new Size($this->width * $other->width, $this->height * $other->height));
				case '/':
					return (new Size($this->width / $other->width, $this->height / $other->height));
				case '%':
					return (new Size($this->width % $other->width, $this->height % $other->height));
				case '=':
					return (new Size($this->width = $other->width, $this->height = $other->height));
			}
			return ($this);
		}

		public function add(Size $other){ return ($this->op($other, '+')); }
		public function sub(Size $other){ return ($this->op($other, '-')); }
		public function mul(Size $other){ return ($this->op($other, '*')); }
		public function div(Size $other){ return ($this->op($other, '/')); }
		public function mod(Size $other){ return ($this->op($other, '%')); }
		public function assign(Size $other){ return ($this->op($other, '=')); }

		static public function doc(){ return file_get_contents("Size/Size.doc.txt"); }
		public function __toString(){
			return ("Size (width: ".str_pad((int)$this->_width, 3, ' ', STR_PAD_LEFT)
					.", height: ".str_pad((int)$this->_height, 3, ' ', STR_PAD_LEFT)
					." )");
		}
	}
?>
