Unit testing in PHP
===================

In this tutorial you will learn the basics of unit testing in PHP.
The goal of this training is to convince you that automated testing:

* is much faster than manual testing
* is much more strict than manual testing
* is there to help you and your team
* is a project's asset, not a liability
* rewards you in the long run in quality and stability of the code

We will deal with some of the myths around unit testing, in particular:

* there is never enough time to write automated tests
* the code needs to be refactored so no need for unit tests before nor after that happens

How to begin
------------

Make sure you have binary PHP extension `xdebug` installed. If you're running Debian or Ubuntu
the extension can be installed this way: `sudo apt-get install php5-xdebug`.

1. Clone the repo at https://github.com/stronger/php-testing.git
2. Enter php-testing directory `cd php-testing`
3. Run `composer install`
4. Start local web server `php -S localhost:8080`
5. In browser go to http://localhost:8080/index.php

Server logs will be output to console where you launched the server.

For this training session we will be working with simple model representing a triangle.
In browser you should see a simple form for entering triangle sides length.
We will expand the task in each exercise using various testing techniques.

In case you're stuck with some exercise you can take a peek at or merge with branch *exercise-n*,
where *n* is exercise number between 1 and 9.

Exercise 0: getting ready
-------------------------

**Objective:** to learn the basic structure of PHPUnit and how to run tests.

1. Browse tests in `tests/` directory. Note that classes with methods starting with *test*
or annotated with *@test* will be run automatically when PHPUnit is launched.

2. Run PHPUnit `vendor/bin/phpunit`. As a result you should see `I.` - this means the firs
test is incomplete, and the other is passing. In case of failures detailed report is presented below.

3. To only run specific test you can pass a filter on the command line,
i.e. `vendor/bin/phpunit --filter getArea`

Exercise 1: getting real with testing
-------------------------------------

**Objective:** to prove that automated tests are simple to use.

In class Triangle method `getPerimeter()` returns perimeter equal to the sum of all sides of a triangle,
method `getArea()` returns area of a triangle using Heron's formula.

1. Take a look at test method `TriangleTest::test_getArea()` and based on it provide implementation
for yet incomplete test in method `test_getPerimater()`.

2. Test your implementation manually in browser. Then run PHPUnit `vendor/bin/phpunit`.

**Question:** which method of testing was simpler, manual or automated?

Exercise 2: using code coverage reports
---------------------------------------

**Objective:** to learn how to use meaningful tests using code coverage report.

1. Run PHPUnit with coverage report generation option: `vendor/bin/phpunit --coverage-html doc/coverage`

2. Open the report in a browser: `firefox doc/coverage/index.html`
Click on Triangle.php link and see the colour coded coverage report.

Did you notice how the constructor is marked in green even though no tests for it exists?
This is because the testing code executes the constructor, thus making PHPUnit believe
it's covered. It's a false positive and can be fixed adding *@covers* annotation in tests.

3. In for each method in class TriangleTest add *@covers* annotation with name of method it covers.
You can use multiple *@covers* annotations to cover more than one method. Example:

```
/**
 * @covers Triangle::getPerimeter
 */
```

4. Delete old report and generate it anew:
`rm -Rf doc/coverage; vendor/bin/phpunit --coverage-html doc/coverage`
Then open it in a browser to see updated coverage statistics: `firefox doc/coverage/index.html`

Exercise 3: testing behaviours
------------------------------

**Objective:** to learn testing both happy and unhappy cases.

1. In class Triangle modify method `getPerimeter()` to return null if negative length of any side is given.

2. Generate a coverage report to see which lines of newly written code are not yet covered with tests.

3. Write another method in class `TriangleTest` (e.g. `test_getPerimeter_return_null_when_negative`)
to check for negative numbers. Use multiple assertions (`assertNull`), in total 7 combinations
of negative and positive numbers.

4. Run PHPUnit and correct possible failures.

5. Test in browser the old behaviour (positive numbers) as well as the new one (negative numbers).

**Question:** if you didn't look at coverage report, how would you know what to test?

Exercise 4: getting sick of manual testing
------------------------------------------

**Objective:** to stress the possiblity of manual testing to the limit

1. In class Triangle modify method `getPerimeter()` to check if triangle can be constructed from given sides.
The rule is that `a+b>c or a+c>b or b+c>a`. Return null when the condition is not satisfied.

2. Generate fresh code coverage report and find the part of class Triangle not covered with tests:
`rm -Rf doc/coverage; vendor/bin/phpunit --coverage-html doc/coverage`

3. Update tests by writing another method (e.g. `test_getPerimeter_return_null_when_not_a_triangle`) including
3 combination of values (i.e. 2, 3, 6). Test manually in browser.

4. Since you've modified the code that was previously tested, you will have to retest
all cases from previous exercise.

**Question:** did you notice any value of existing unit tests when retesting?

Exercise 5: using data providers
--------------------------------

**Objective:** to use declarative programming in testing multiple cases.

1. Write a data provider function in your test, e.g. "negativeSides" that would return array of arrays
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

2. Then make method `test_getPerimeter_return_null_when_negative` accept parameters `($a, $b, $c)`.
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

3. Run PHPUnit and if tests are passing rewrite method `test_getPerimeter_return_null_when_not_a_triangle`
to use data provider (e.g. `invalidSides`), too. Run tests again.

**Question:** how much does it cost you to retest all existing cases using PHPUnit?

Exercise 6: refactoring with tests
----------------------------------

**Objective:** to use unit tests as an indication for refactoring and a safety net.

Notice how in class `Triangle` method `getArea()` depends on `getPerimeter()` for area calculation.
By adding extra checks to `getPerimeter` we have affected the behaviour of `getArea()`.

Indeed, similar checks should be present for `getArea()`, but also for other methods that will come
in the future. Let's refactor the model so that exception is thrown in constructor when invalid triangle
instantiation is attempted.

To test whether exception is thrown test method should be annotated with `@expectedException Exception`.
Remember to update *@covers* annotation and rename test methods accordingly.

**Question:** how willing would you be to run all checks manually at this stage?

Exercise 7: making a switch to TDD
----------------------------------

**Objective:** to introduce "write tests first" approach.

A geometric transformation called scaling needs to be added to class `Triangle`. When method `scale($factor)`
is called a new instance of `Triangle` should be returned with each of its sides multiplied by `$factor`.

Write unit test for method `scale` first and run them. Expect failures because of missing method.
Then implement missing method using failing test as a specification. Resist temptation to change the test
to match your implementation.

**Question:** at what point did you get the idea of what the implementation of new method is going to be?

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
	$transformation = new ScalingTransformation(10);

	$figure = $this->getMock("GeometricFigure");
	$figure->expects($this->once())
		->method("scale")
		->with($this->equalTo(10))
		->will($this->returnValue($this->getMock("GeometricFigure")));

	$transformation->transform($figure);
}
```

As can be seen in the above code scaling factor should be passed in constructor and its method `transform(GeometricFigure $f)`
should call method `scale` on passed figure. There is no assertions in this test, because we're testing expectations here.

Keep running the test and making changes in the model until all tests are passing. Use failing test reports as a guide for
changing the model.

**Question:** how do you think, why didn't we scale triangle, square or circle and test its sides/radius?
