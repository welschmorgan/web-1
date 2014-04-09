<?php
class Color
{
	public $red;
	public $green;
	public $blue;
	public static $verbose = False;

	public function __construct(array $color = NULL)
	{
		if (isset($color))
		{
			if (isset($color['rgb']))
				$this->parseRGB($color['rgb']);
			else
				$this->setRGB($color['red'], $color['green'], $color['blue']);
		}
		if (self::$verbose === True)
			print($this." constructed.".PHP_EOL);
	}

	public function __destruct()
	{
		if (self::$verbose === True)
			print($this." destructed.".PHP_EOL);
	}

	public static function doc()
	{
		return (file_get_contents("Color.doc.txt"));
	}

	public function sanitize()
	{
		$this->red = ($this->red > 255
						? 255
						: ($this->red < 0
							? 0
							: $this->red));
		$this->green = ($this->green > 255
						? 255
						: ($this->green < 0
							? 0
							: $this->green));
		$this->blue = ($this->blue > 255
						? 255
						: ($this->blue < 0
							? 0
							: $this->blue));
		return ($this);
	}

	public function __toString()
	{
		return ("Color( red:".str_pad($this->red, 4, ' ', STR_PAD_LEFT)
				.", green:".str_pad($this->green, 4, ' ', STR_PAD_LEFT)
				.", blue:".str_pad($this->blue, 4, ' ', STR_PAD_LEFT)." )");
	}

	public function parseRGB($rgb)
	{
		$irgb = $rgb; //intval()
		$this->red = ($irgb >> 16) & 0xFF;
		$this->green = ($irgb >> 8) & 0xFF;
		$this->blue = $irgb & 0xFF;
		$this->sanitize();
	}

	public function asRGB()
	{
		return (intval($this->red) << 16 + intval($this->green) << 8 + intval($this->blue));
	}

	public function setRGB($r, $g, $b)
	{
		$this->red = intval($r);
		$this->green = intval($g);
		$this->blue = intval($b);
		$this->sanitize();
	}

	public function op($op, $other)
	{
		$ret = array('red' => $this->red, 'green' => $this->green, 'blue' => $this->blue);
		if (isset($other))
		{
			switch($op)
			{
				case '+':
					$ret['red'] += $other->red;
					$ret['green'] += $other->green;
					$ret['blue'] += $other->blue;
				break;
				case '-':
					$ret['red'] -= $other->red;
					$ret['green'] -= $other->green;
					$ret['blue'] -= $other->blue;
				break;
				case '*':
					$ret['red'] *= $other;
					$ret['green'] *= $other;
					$ret['blue'] *= $other;
				break;
				default:
			}
		}
		return (new Color($ret));
	}
	public function add(Color $other)
	{ return ($this->op('+', $other));}
	public function sub(Color $other)
	{ return ($this->op('-', $other));}
	public function mult($other)
	{ return ($this->op('*', $other));}
};
?>
