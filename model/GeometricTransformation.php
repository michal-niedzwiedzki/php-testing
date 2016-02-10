<?php

/**
 * Abstract geometric transformation
 */
abstract class GeometricTransformation {

	/**
	 * Perform transformation
	 *
	 * @param GeometricFigure $figure
	 * @return GeometricFigure
	 */
	abstract public function transform(GeometricFigure $figure);

}