<?php

/**
 * Triangle
 */
class Triangle {

	protected $a, $b, $c;
	
	/**
	 * Constructor
	 *
	 * @param float $a
	 * @param float $b
	 * @param float $c
	 */
	public function __construct($a, $b, $c) {
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
		if ($this->a < 0 or $this->b < 0 or $this->c < 0) {
			return null;
		}
		if ($this->a + $this->b <= $this->c or $this->a + $this->c <= $this->b or $this->b + $this->c <= $this->a) {
			return null;
		}
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