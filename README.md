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
In browser you should see a simple for for entering triangle sides length.
We will expand the task using testing techniques to develop efficiently.

Exercise 0: getting ready
-------------------------

**Objective:** to learn the basic structure of PHPUnit and how to run tests.

Browse tests in `tests/` directory.
Run PHPUnit `vendor/bin/phpunit`.


In `tests/` directory classes with methods starting with *test* or annotated with `@test` will be run automatically.

To only run specific test you can pass a filter on the command line:
`vendor/bin/phpunit --filter getArea`

Exercise 1: getting real with testing
-------------------------------------

**Objective:** to prove that automated tests are simple to use.

In class Triangle implement method `getPerimeter()` so that it returns sum of all sides.
Test your implementation manually in browser.

Then, write a unit test in file `tests/TriangleTest.php`, method `test_getPerimeter` in which
you build an example triangle and compare expected perimeter with actual result of method `Triangle::getPerimeter`

Exercise 2: testing behaviours
------------------------------

**Objective:** to learn testing both happy and unhappy cases.

In class Triangle modify method `getPerimeter()` to return null if negative length of any side is given.
Write the second method in class `TriangleTest` (e.g. `test_getPerimeter_return_null_when_negative`)
to check for negative numbers. Use multiple assertions for 9 combinations of negative and positive numbers.

Run PHPUnit and correct possible failures.
Test in browser the old behaviour (positive numbers) as well as the new one (negative numbers).

Exercise 3: using code coverage reports
---------------------------------------

**Objective:** to learn how to use meaningful tests using code coverage report.

Run PHPUnit with coverage report generation option:
`vendor/bin/phpunit --coverage-html doc/coverage`

Exercise 4: getting sick of manual testing
------------------------------------------

**Objective:** to stress the possiblity of manual testing to the limit

In class Triangle modify method `getPerimeter()` to check if triangle can be constructed from given sides.
The rule is that `a+b>c or a+c>b or b+c>a`. Return null when the condition is not satisfied.

Generate fresh code coverage report and find the part of class Triangle not covered with tests.

Update tests by writing another method (e.g. `test_getPerimeter_return_null_when_not_a_triangle`) including
9 combination of values: 2, 3, 6. Test manually in browser. Also retest all cases from exercise 2.

Exercise 5: using data providers
--------------------------------

**Objective:** to use declarative programming in testing multiple cases.

Write a data provider function in your test, e.g. "negativeSides" that would return array of arrays
with combinations of triangle sides just like asserted in method `test_getPerimeter_return_null_when_negative`.

Then make method `test_getPerimeter_return_null_when_negative` accept parameters `($a, $b, $c)`.
In method doc block annotate it with `@dataProvider negativeSides`.
Method should assert that getting perimeter of a triangle built using passed parameters should be null.

Run PHPUnit and rewrite method `test_getPerimeter_return_null_when_not_a_triangle` to use data provider
(e.g. `invalidSides`). Run tests again.

Exercise 6: refactoring with tests
----------------------------------

**Objective:** to use unit tests as an indication for refactoring and a safety net.

In class Triangle add method `getArea` for calculating area of a triangle. The universal formula for
calculating area of arbitrary triangle is `sqrt(s*(s-a)*(s-b)*(s-c))` where s is half the perimeter.

Write unit tests for both happy and unhappy cases. Reuse existing data provider if necessary.
Generate code coverage report to make sure all cases are covered (delete old report first).

At this stage it should be apparent that a lot of code is repeated. Refactor the code
so that an exception is thrown when instantiating an invalid triangle.

To test whether exception is thrown test method should be annotated with
`@expectedException Exception` annotation.
