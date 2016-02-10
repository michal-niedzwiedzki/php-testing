<?php

require __DIR__ . "../../model/Triangle.php";

/**
 * Triangle test
 */
class TriangleTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function test_getPerimeter() {
		$a = 3;
		$b = 4;
		$c = 5;
		$expected = 12;

		$triangle = new Triangle($a, $b, $c);
		$actual = $triangle->getPerimeter();

		$this->assertEquals($expected, $actual);
	}

	/**
	 * @test
	 */
	public function test_getArea() {
		$a = 3;
		$b = 4;
		$c = 5;
		$expected = 6;

		$triangle = new Triangle($a, $b, $c);
		$actual = $triangle->getArea();

		$this->assertEquals($expected, $actual);
	}

}