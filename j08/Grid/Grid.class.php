<?php
	require_once ("Norme/Norme.class.php");
	require_once ("Point/Point.class.php");
	require_once ("Size/Size.class.php");
	require_once ("Tile/Tile.class.php");

	class Grid extends Norme
	{
		private $_size;
		private $_tiles;

		public function __construct($size_x = 0, $size_y = 0)
		{
			parent::__construct();
			$this->_size = new Size($size_x, $size_y);
			$this->create();
		}
		public function create() {
			$this->_tiles = array();
			for ($row=0; $row < $this->_size->getHeight(); $row++)
			{
				$this->_tiles[$row] = array();
				for($col=0; $col < $this->_size; $col++)
				{
					$this->_tiles[$row][$col]
						= new Tile(Tile::$Tiles['Empty'], $col, $row);
				}
			}
		}
		public function getSize() { return $this->_size;}
		public function getWidth() { return $this->_size->getWidth(); }
		public function getHeight() { return $this->_size->getHeight(); }
		static public function doc(){ return file_get_contents("Grid/Grid.doc.txt"); }
		public function __toString(){
			return ("Grid (width: ".str_pad((int)$this->_size->getWidth(), 3, ' ', STR_PAD_LEFT)
					.", height: ".str_pad((int)$this->_size->getHeight(), 3, ' ', STR_PAD_LEFT)
					." )");
		}
	}
?>
