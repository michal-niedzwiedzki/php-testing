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
	 */
	public function test_getPerimeter_return_null_when_negative() {
		$triangle = new Triangle(-3, 4, 5);
		$this->assertNull($triangle->getPerimeter());
		$triangle = new Triangle(3, -4, 5);
		$this->assertNull($triangle->getPerimeter());
		$triangle = new Triangle(3, 4, -5);
		$this->assertNull($triangle->getPerimeter());
		$triangle = new Triangle(-3, -4, 5);
		$this->assertNull($triangle->getPerimeter());
		$triangle = new Triangle(-3, 4, -5);
		$this->assertNull($triangle->getPerimeter());
		$triangle = new Triangle(3, -4, -5);
		$this->assertNull($triangle->getPerimeter());
		$triangle = new Triangle(-3, -4, -5);
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

}