PHPUnit is the canonical unit testing framework for PHP. Even for simple projects and learning exercises, unit testing pays big dividends. This article shows how to install PHPUnit locally to a project with Composer on UBuntu. If you’d rather not use Composer to install PHPUnit locally to your project, there are alternative installation instructions for installing PHPUnit globally [at the top of this page](https://phpunit.de/getting-started.html).

This article assumes you’ve already installed Composer&mdash;if not  [get Composer installation instructions here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

**Step 1.** Add `src` and `tests` directories to your project’s root.  These aren’t necessarly the directory names required, but you’ll see these directory names referenced in following steps. If you change these names be sure to change the corresponding names in subsequent steps.

**Step 2.** Add the following Composer file, named `composer.json` in your project’s root.

    {
        "name": "rp/puppet02",
        "description": "PHP test template",
        "license": "MIT",
        "require": {
        },
        "require-dev": {
            "phpunit/phpunit": "4.8.*"
        },
        "autoload": {
            "psr-4": {
                "App\\": "src"
            }
        }
     }  

User values specific to your project for the `name,` `description,` and `license` keys. The autoload key uses the psr-4 standard to autoload PHP class files located in the specified directory.

**Step 3.** Run `Composer` to load PHPUnit.

	$ composer update

This will take a couple of minutes or so. When this completes, run Composer from your project’s root to install PHPUnit and its dependencies.

**Step 4.** Check that PHPUnit installed correct by issues this command from your project's root:

	$ vendor/bin/phpunit --version

If the PHPUnit version is correctly reported you’re ready for Step 3.

**Step 5.** Add a `phpunit.xml` file to your project’s root. This XML file provides configuration info to PHPUnit and lets you start PHPUnit without a load of command line arguments. There are more configuration settings than what’s shown below available–this step keeps the configuration simple. Check [PHPUnit’s documentation](https://phpunit.de/manual/current/en/phpunit-book.html#appendixes.configuration) for the other configuration options available.

    <phpunit
        bootstrap="vendor/autoload.php"
        colors="true">
      <testsuites>
        <testsuite name="Initial tests">
          <directory>tests/</directory>
        </testsuite>
      </testsuites>
    </phpunit>

The `bootstrap` key identifies the Composer autoload file that causes your PHP classes to be auto-loaded. The `colors` key tells PHPUnit to show command line test results in color (ie, green for pass, red for fail).

The `testsuites` key identifies groups of tests (“test suites”) and the directory where the PHP tests files are located for each test suite. The `testsuites` key should have one more `testsuite` keys that define a given test suite. The `name` key names the test suite and the `directory` key indentifies the directory where PHP tests are located (relative to the project's root).

When you run phpunit on the command line without any arguments all of the test suites identified here are performed. You can use PHPUnit’s `--testsuite` flag to run a specific test suite. For example, if you had a test suite named `Controller tests` the following command line would run that test suite only:

	phpunit --testsuite "Controller tests"

The name you provide for test suites is case-sensitive. When a test suite is performed, the tests in its top-level directory, as well as any in any child directories are performed.

**Step 5.**  Add a class to test and a test for that class. The two PHP files here are [from the PHPUnit Getting Started page](https://phpunit.de/getting-started.html). The only modification to them was to use specify the necessary namespacing to enable Composer to auto-load classes.

######src/Money.php file&mdash;class to test
    <?php

    // src/Money.php

    namespace App;

    class Money
    {
        private $amount;

        public function __construct($amount)
        {
            $this->amount = $amount;
        }

        public function getAmount()
        {
            return $this->amount;
        }

        public function negate()
        {
            return new Money(-1 * $this->amount);
        }

        // ...
    }

######src/MoneyTest.php file&mdash;test for Money class.

    <?php

    use App\Money;

    class MoneyTest extends PHPUnit_Framework_TestCase
    {
        public function testCanBeNegated()
        {
            // Arrange
            $a = new Money(1);

            // Act
            $b = $a->negate();

            // Assert
            $this->assertEquals(-1, $b->getAmount());
        }
    }

Once you've added these two PHP files, you'll have a directory structure that looks like the abridged one below.

    .
    ├── App
    │   └── Money.php
    ├── composer.json
    ├── composer.lock
    ├── phpunit.xml
    ├── tests
    │   └── MoneyTest.php
    └── vendor
    ├── autoload.php
    ├── bin
    │   └── phpunit -> ../phpunit/phpunit/phpunit
    ├── composer
    .
    .
    .
    └── symfony

**Step 6.**  Run the test suite (with its one test for now) from the command line in you project's root with:

	vendor/bin/phpunit



<p><img style="float:left; padding-right: 24px" src="/content/images/2015/08/running-phpunit.png"></p>When the test runs successfully you'll see a screen as shown to the left.








Learning how to use PHPUnit is central to learning PHP well, and, as you can see, getting it up and running is easy.
