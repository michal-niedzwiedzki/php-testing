<?php

require __DIR__ . "../../model/Triangle.php";

/**
 * Triangle test
 */
class TriangleTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 * @covers Triangle::__construct
	 */
	public function test_construct() {
		$triangle = new Triangle(3, 4, 5);
		$this->assertEquals(3, $triangle->a);
		$this->assertEquals(4, $triangle->b);
		$this->assertEquals(5, $triangle->c);
	}

	/**
	 * @test
	 * @covers Triangle::__construct
	 * @dataProvider negativeSides
	 * @expectedException Exception
	 */
	public function test_construct_throw_when_negative($a, $b, $c) {
		$triangle = new Triangle($a, $b, $c);
		$this->assertNull($triangle->getPerimeter());
	}

	/**
	 * @test
	 * @covers Triangle::__construct
	 * @dataProvider invalidSides
	 * @expectedException Exception
	 */
	public function test_construct_throw_when_not_a_triangle($a, $b, $c) {
		$triangle = new Triangle($a, $b, $c);
		$this->assertNull($triangle->getPerimeter());
	}

	/**
	 * @test
	 * @covers Triangle::getPerimeter
	 */
	public function test_getPerimeter() {
		$triangle = new Triangle(3, 4, 5);
		$this->assertEquals(12, $triangle->getPerimeter());
	}

	/**
	 * @test
	 * @covers Triangle::scale
	 */
	public function test_scale() {
		$t1 = new Triangle(3, 4, 5);
		$t2 = $t1->scale(2);
		$this->assertEquals(6, $t2->a);
		$this->assertEquals(8, $t2->b);
		$this->assertEquals(10, $t2->c);
		$this->assertNotSame($t1, $t2);
	}

	/**
	 * @test
	 * @covers Triangle::getArea
	 */
	public function test_getArea() {
		$triangle = new Triangle(3, 4, 5);
		$this->assertEquals(6, $triangle->getArea());
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