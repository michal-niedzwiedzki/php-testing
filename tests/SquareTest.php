<?php

require __DIR__ . "../../model/Square.php";

/**
 * Square test
 */
class SquareTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 * @covers Square::__construct
	 * @expectedException Exception
	 */
	public function test_construct_throw_when_negative() {
		new Square(-5);
	}

	/**
	 * @test
	 * @covers Square::getPerimeter
	 */
	public function test_getPerimeter() {
		$square = new Square(5);
		$this->assertEquals(20, $square->getPerimeter());
	}

	/**
	 * @test
	 * @covers Square::getArea
	 */
	public function test_getArea() {
		$square = new Square(5);
		$this->assertEquals(25, $square->getArea());
	}

	/**
	 * @test
	 * @covers Square::scale
	 */
	public function test_scale() {
		$square1 = new Square(5);
		$square2 = $square1->scale(2);
		$this->assertEquals(10, $square2->a);
		$this->assertNotSame($square1, $square2);
	}

}