<?php

require_once "GeometricFigure.php";

/**
 * Circle
 */
class Circle extends GeometricFigure {

	public $radius;
	
	/**
	 * Constructor
	 *
	 * @param float $a
	 */
	public function __construct($radius) {
		if ($radius < 0) {
			throw new Exception("Negative radius");
		}
		$this->radius = $radius;
	}

	/**
	 * Return perimeter of a circle
	 *
	 * @return float
	 */
	public function getPerimeter() {
		return 2 * M_PI * $this->radius;
	}

	/**
	 * Return area of a circle
	 *
	 * @return float
	 */
	public function getArea() {
		return M_PI * $this->radius * $this->radius;
	}

	/**
	 * Return scaled instance of a circle
	 *
	 * @param float $factor
	 * @return Circle
	 */
	public function scale($factor) {
		return new Circle($this->radius * $factor);
	}

}