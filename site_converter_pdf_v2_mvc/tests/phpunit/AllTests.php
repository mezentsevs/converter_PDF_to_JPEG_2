<?php

namespace tests\phpunit;

use PHPUnit\Framework\TestSuite;
use tests\phpunit\controllers\AllControllersTests;
use tests\phpunit\core\AllCoreTests;
use tests\phpunit\models\AllModelsTests;

/**
 * AllTests - класс набора всех наборов тестов.
 */
class AllTests
{
    public static function suite()
    {
        $suite = new TestSuite('AllSuite');
        
        // Добавляем наборы тестов в набор:
        $suite->addTest(AllControllersTests::suite());
        $suite->addTest(AllCoreTests::suite());
        $suite->addTest(AllModelsTests::suite());

        return $suite;
    }
}
