<?php

require __DIR__ . "../../model/ScalingTransformation.php";

/**
 * Scaling transformation test
 */
class ScalingTransformationTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 * @covers ScalingTransformation::transform
	 */
	public function test_transform() {
		$transformation = new ScalingTransformation(10);

		$figure = $this->getMock("GeometricFigure");
		$figure->expects($this->once())
			->method("scale")
			->with($this->equalTo(10))
			->will($this->returnValue($this->getMock("GeometricFigure")));

		$transformation->transform($figure);
	}

}