<?php

require_once "GeometricFigure.php";

/**
 * Square
 */
class Square extends GeometricFigure {

	public $a;
	
	/**
	 * Constructor
	 *
	 * @param float $a
	 */
	public function __construct($a) {
		if ($a < 0) {
			throw new Exception("Negative side");
		}
		$this->a = $a;
	}

	/**
	 * Return perimeter of a square
	 *
	 * @return float
	 */
	public function getPerimeter() {
		return 4 * $this->a;
	}

	/**
	 * Return area of a square
	 *
	 * @return float
	 */
	public function getArea() {
		return $this->a * $this->a;
	}

	/**
	 * Return scaled instance of a square
	 *
	 * @param float $factor
	 * @return Square
	 */
	public function scale($factor) {
		return new Square($this->a * $factor);
	}

}