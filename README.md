Unit testing in PHP
===================

In this tutorial you will learn the basics of unit testing in PHP.
The goal of this training is to convince you that automated testing:

* is much faster than manual testing
* is much more strict than manual testing
* is there to help you and your team
* is a project's asset, not a liability
* rewards you in the long run

We will deal with some of the myths around unit testing, in particular:

* there is not enough time to do automated tests
* the code needs to be refactored so no need for unit tests

How to begin
------------

1. Clone the repo at https://github.com/stronger/php-testing.git
2. Enter php-testing directory `cd php-testing`
3. Run `composer install`
4. Start local web server `php -S localhost:8080`
5. In browser go to http://localhost:8080/index.php

Server logs will be output to console where you launched the server.

For this training session we will be working with simple model representing a triangle.
In browser you should see a simple form for entering triangle sides length.
We will expand the task using testing techniques to develop efficiently.

Exercise 0: getting ready
-------------------------

**Objective:** to learn the basic structure of PHPUnit and how to run tests.

Browse tests in `tests/` directory. Note that classes with methods starting with *test*
or annotated with `@test` will be run automatically when PHPUnit is launched.

Run PHPUnit `vendor/bin/phpunit`.

As a result you should see `I.` - this means the first test is incomplete, and the other
is passing. In case of failures detailed report is presented below.

To only run specific test you can pass a filter on the command line,
i.e. `vendor/bin/phpunit --filter getArea`

Exercise 1: getting real with testing
-------------------------------------

**Objective:** to prove that automated tests are simple to use.

In class Triangle method `getPerimeter()` returns perimeter equal to the sum of all sides of a triangle,
method `getArea()` returns area of a triangle using Heron's formula.

Take a look at test method `TriangleTest::test_getArea()` and based on it provide implementation
for incomplete test in method `test_getPerimater()`.

Test your implementation manually in browser.
Then run PHPUnit `vendor/bin/phpunit`.

**Question:** which method of testing was simpler, manual or automated?

Exercise 2: testing behaviours
------------------------------

**Objective:** to learn testing both happy and unhappy cases.

In class Triangle modify method `getPerimeter()` to return null if negative length of any side is given.
Write another method in class `TriangleTest` (e.g. `test_getPerimeter_return_null_when_negative`)
to check for negative numbers. Use multiple assertions, in total 7 combinations of negative and positive numbers.

Run PHPUnit and correct possible failures.
Test in browser the old behaviour (positive numbers) as well as the new one (negative numbers).

**Question:** again, which method of testing was simpler, manual or automated?

Exercise 3: using code coverage reports
---------------------------------------

**Objective:** to learn how to use meaningful tests using code coverage report.

Run PHPUnit with coverage report generation option:
`vendor/bin/phpunit --coverage-html doc/coverage`

Open the report in a browser: `firefox doc/coverage/index.html`
Click on Triangle.php link and see the colour coded coverage report.

Did you notice how the constructor is marked in green even though no tests for it exists?
This is because the testing code executes the constructor, thus making PHPUnit believe
it's covered. It's a false positive and can be fixed adding @covers annotation in tests.

In for each method in class TriangleTest add @covers annotation with name of method it covers.
You can use multiple @covers annotations to cover more than one method. Example:

```
/**
 * @covers Triangle::getPerimeter
 */
```

Delete old report and generate it anew:
`rm -Rf doc/coverage; vendor/bin/phpunit --coverage-html doc/coverage`

Then open it in a browser to see updated coverage statistics: `firefox doc/coverage/index.html`

Exercise 4: getting sick of manual testing
------------------------------------------

**Objective:** to stress the possiblity of manual testing to the limit

In class Triangle modify method `getPerimeter()` to check if triangle can be constructed from given sides.
The rule is that `a+b>c or a+c>b or b+c>a`. Return null when the condition is not satisfied.

Generate fresh code coverage report and find the part of class Triangle not covered with tests:
`rm -Rf doc/coverage; vendor/bin/phpunit --coverage-html doc/coverage`

Update tests by writing another method (e.g. `test_getPerimeter_return_null_when_not_a_triangle`) including
7 combination of values (i.e. 2, 3, 6). Test manually in browser. Also retest all cases from exercise 2.

**Question:** did you notice any value of existing unit tests when retesting?

Exercise 5: using data providers
--------------------------------

**Objective:** to use declarative programming in testing multiple cases.

Write a data provider function in your test, e.g. "negativeSides" that would return array of arrays
with combinations of triangle sides just like asserted in method `test_getPerimeter_return_null_when_negative`:

```
public function negativeSides() {
	return [
		[-3, 4, 5], [3, -4, 5], [3, 4, -5],
		[-3, -4, 5], [-3, 4, -5], [3, -4, -5],
		[-3, -4, -5]
	];
}
```

Then make method `test_getPerimeter_return_null_when_negative` accept parameters `($a, $b, $c)`.
In method doc block annotate it with `@dataProvider negativeSides`:

```
/**
 * @test
 * @covers Triangle::getPerimeter
 * @dataProvider negativeSides
 */
public function test_getPerimeter_return_null_when_negative($a, $b, $c) {
	...	
}
```

The method should assert that getting perimeter of a triangle built using passed parameters should be null.

Run PHPUnit and if tests are passing rewrite method `test_getPerimeter_return_null_when_not_a_triangle`
to use data provider (e.g. `invalidSides`), too. Run tests again.

**Question:** how much does it cost you to retest all existing cases using PHPUnit?

Exercise 6: refactoring with tests
----------------------------------

**Objective:** to use unit tests as an indication for refactoring and a safety net.

Notice how in class `Triangle` method `getArea` depends on `getPerimeter` for area calculation.
By adding extra checks to `getPerimeter` we have affected the behaviour if `getArea`.

Indeed, similar checks should be present for `getArea`, but also for other methods that will come
in the future. Let's refactor the model so that exception is thrown in constructor when invalid triangle
instantiation is attempted.

To test whether exception is thrown test method should be annotated with `@expectedException Exception`.

**Question:** how willing would you be to run all checks manually?

Exercise 7: making a switch to TDD
----------------------------------

**Objective:** introduce "write tests first" approach.

A geometric transformation called scaling needs to be added to class `Triangle`. When method `scale($factor)`
is called a new instance of `Triangle` should be returned with each of its sides multiplied by $factor.

Write unit test for method `scale` first and run them. Expect failures because of missing method.
Then implement missing method using failing test as a specification. Resist temptation to change the test
to match your implementation.

**Question:** when did you get the idea of what the implementation of new method is going to be?

Exercise 8: refactoring with tests, part 2
------------------------------------------

**Objective:** to use TDD in refactoring.

Our approach was good for triangles but other geometric figures need to be handled as well.
Provide abstract class `GeometricFigure` and implementation for its concretions: Square and Circle.

Write similar unit tests for new classes and update existing tests **before** making changes in model.

**Question:** after testing your code with unit tests did you feel confident you don't need manual testing?

Exercise 9: mocking and testing expectations
--------------------------------------------

**Objective:** to learn using object mocks and testing expectations.

Extract scaling operation into separate class `ScalingTransformation` (subclass of `GeometricTransformation`).
Test `ScalingTransformation::transform` with the following code:

```
/**
 * @test
 * @covers ScalingTransformation::transform
 */
public function test_transform() {
	$factor = 10;
	$transformation = new ScalingTransformation($factor);

	$figure = $this->getMock("GeometricFigure");
	$figure->expects($this->once())
		->method("scale")
		->with($this->equalTo($factor))
		->will($this->returnValue($figure));

	$transformation->transform($figure);
}
```

As can be seen in the above code scaling factor should be passed in constructor and its method `transform(GeometricFigure $f)`
should call method `scale` on passed figure. There is no assertions in this test, because we're testing expectations here.

Keep running the test and making changes in the model until all tests are passing. Use failing test reports as a guide for
changing the model.

**Question:** would you like to test recent refactoring manually?
