Test performance
================

This is a simple project to analyse PHP test performance. Please, feel free to fork, suggest or contribute (see license details below).

## License

DWYW License: Do whatever you want with this code. It is appreciated to mention the authorship :-). 

## Last changes

2019-06-12: Executes the first test once before start measuring. This seems to help to get an accurate memory consumption measurement, because prior to this, the first test was disproportionally penalized in memory consumption.
2019-06-10: Run tests in separated processes and fix bad memory consumption calculation. Thanks to @sergiosusa for point to this issue.
2019-06-09: First version.

## Installation

Clone the repo into your computer. The project includes a basic `docker-compose.yml` to have a minimal environment to work with **PHP** and **phpunit**. You can start the containers with:

```
docker-compose up -d
```

Test for this project can be launched with this:

```
docker exec tb-doubles-php-fpm  bin/phpunit tests/Performance
```

Or use the appropriate method that fits your own needs.

## Usage

This project was created initially to compare and analyse the performance of testing techniques, comparing between two or more implementations of a test. 

You can select the TestCases::test to compare, the number of times to execute and a title for the results table.

* Tests: are the tests you want to compare. They are standard phpunit TestCases so you don't need to change or prepare your existing ones in any way. You must indicate the testcase and the name of the specific test you want to profile. By default we will search for a method named "test".
* Times to execute: in very fast test, time differences could be too small, so test are executed several times so you can get larger numbers that could provide a realistic measure of how a full test suite could perform. Defaults to 50.
* Title: results are shown in a results table so you can use your own for every test comparision.

The SampleTestCase provided in this project shows the difference between four techniques to create test doubles.

You can add all TimedTestCases you need.

```php
class SampleTest extends TimedTestCase
{
    protected function setUp(): void
    {
        $this->addTestCase(new ProphecyMockTest());
        $this->addTestCase(new AnonymousClassTest());
        $this->addTestCase(new NativeMockTest());
        $this->addTestCase(new OriginalClassTest());

        $this->executeTimes(250);

        $this->setTitle('Test Doubles creation methods');
    }
}
```

## Future developments

* Better report.
* A PerformanceTestCase that allows to assert a desired execution time for a software unit.
* Create a composer package so you can easily integrate this tools in your projects.
