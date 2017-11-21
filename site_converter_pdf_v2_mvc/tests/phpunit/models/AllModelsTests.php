<?php

namespace tests\phpunit\models;

use PHPUnit\Framework\TestSuite;

/**
 * AllModelsTests - класс набора тестов для models.
 */
class AllModelsTests
{
    public static function suite()
    {
        $suite = new TestSuite('ModelsSuite');
        
        // Добавляем тесты в набор:
        $suite->addTestSuite('tests\\phpunit\\models\\DocumentTest');
        $suite->addTestSuite('tests\\phpunit\\models\\ImageTest');

        return $suite;
    }
}
