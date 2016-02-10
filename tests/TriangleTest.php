<?php

require __DIR__ . "../../model/Triangle.php";

/**
 * Triangle test
 */
class TriangleTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 * @covers Triangle::getPerimeter
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
	 * @covers Triangle::getPerimeter
	 * @dataProvider negativeSides
	 */
	public function test_getPerimeter_return_null_when_negative($a, $b, $c) {
		$triangle = new Triangle($a, $b, $c);
		$this->assertNull($triangle->getPerimeter());
	}

	/**
	 * @test
	 * @covers Triangle::getPerimeter
	 * @dataProvider invalidSides
	 */
	public function test_getPerimeter_return_null_when_not_a_triangle($a, $b, $c) {
		$triangle = new Triangle($a, $b, $c);
		$this->assertNull($triangle->getPerimeter());
	}

	/**
	 * @test
	 * @covers Triangle::getArea
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

	public function negativeSides() {
		return [
			[-3, 4, 5], [3, -4, 5], [3, 4, -5],
			[-3, -4, 5], [-3, 4, -5], [3, -4, -5],
			[-3, -4, -5]
		];
	}

	public function invalidSides() {
		return [[2, 3, 6], [3, 6, 2], [6, 2, 3]];
	}

}