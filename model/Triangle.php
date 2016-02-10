<?php

/**
 * Triangle
 */
class Triangle {

	public $a, $b, $c;
	
	/**
	 * Constructor
	 *
	 * @param float $a
	 * @param float $b
	 * @param float $c
	 */
	public function __construct($a, $b, $c) {
		if ($a < 0 or $b < 0 or $c < 0) {
			throw new Exception("Negative sides");
		}
		if ($a + $b <= $c or $a + $c <= $b or $b + $c <= $a) {
			throw new Exception("Sides do not form a triangle");
		}
		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}

	/**
	 * Return perimeter of a triangle
	 *
	 * @return float
	 */
	public function getPerimeter() {
		return $this->a + $this->b + $this->c;
	}

	/**
	 * Return area of a triangle
	 *
	 * @return float
	 */
	public function getArea() {
		$s = $this->getPerimeter() / 2;
		return sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c));
	}

}