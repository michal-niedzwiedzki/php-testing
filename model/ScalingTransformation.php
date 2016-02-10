<?php

require_once "GeometricTransformation.php";

/**
 * Scaling transformation
 */
class ScalingTransformation extends GeometricTransformation {

	public $factor;
	
	/**
	 * Constructor
	 *
	 * @param float $factor
	 */
	public function __construct($factor) {
		$this->factor = $factor;
	}

	/**
	 * Perform transformation
	 *
	 * @param GeometricFigure $figure
	 * @return GeometricFigure
	 */
	public function transform(GeometricFigure $figure) {
		return $figure->scale($this->factor);
	}

}