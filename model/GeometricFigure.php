<?php

/**
 * Abstract geometric figure
 */
abstract class GeometricFigure {

	/**
	 * Return perimeter of a figure
	 *
	 * @return float
	 */
	abstract public function getPerimeter();

	/**
	 * Return area of a figure
	 *
	 * @return float
	 */
	abstract public function getArea();

	/**
	 * Return scaled instance of a figure
	 *
	 * @param float $factor
	 * @return float
	 */
	abstract public function scale($factor);

}