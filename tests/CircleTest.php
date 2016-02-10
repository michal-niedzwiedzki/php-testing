<?php

require __DIR__ . "../../model/Circle.php";

/**
 * Circle test
 */
class CircleTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 * @covers Circle::__construct
	 * @expectedException Exception
	 */
	public function test_construct_throw_when_negative() {
		new Circle(-5);
	}

	/**
	 * @test
	 * @covers Circle::getPerimeter
	 */
	public function test_getPerimeter() {
		$circle = new Circle(5);
		$this->assertEquals(2 * M_PI * 5, $circle->getPerimeter());
	}

	/**
	 * @test
	 * @covers Circle::getArea
	 */
	public function test_getArea() {
		$circle = new Circle(5);
		$this->assertEquals(M_PI * 25, $circle->getArea());
	}

	/**
	 * @test
	 * @covers Circle::scale
	 */
	public function test_scale() {
		$circle1 = new Circle(5);
		$circle2 = $circle1->scale(2);
		$this->assertEquals(10, $circle2->radius);
		$this->assertNotSame($circle1, $circle2);
	}

}