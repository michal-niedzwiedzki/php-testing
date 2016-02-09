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