<?php
class Fighter
{
	private $_name;

	public function __construct($name){ $this->_name = $name; }
	public function __toString(){ return ($this->_name); }
}
?>
