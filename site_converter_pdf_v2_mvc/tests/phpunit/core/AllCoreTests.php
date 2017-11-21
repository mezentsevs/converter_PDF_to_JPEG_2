<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestSuite;

/**
 * AllCoreTests - класс набора тестов для core.
 */
class AllCoreTests
{
    public static function suite()
    {
        $suite = new TestSuite('CoreSuite');
        
        // Добавляем тесты в набор:
        $suite->addTestSuite('tests\\phpunit\\core\\ControllerTest');
        $suite->addTestSuite('tests\\phpunit\\core\\DatabaseObjectTest');
        $suite->addTestSuite('tests\\phpunit\\core\\ModelTest');
        $suite->addTestSuite('tests\\phpunit\\core\\MySQLDatabaseTest');
        $suite->addTestSuite('tests\\phpunit\\core\\RouteTest');
        //$suite->addTestSuite('tests\\phpunit\\core\\SessionTest');
        $suite->addTestSuite('tests\\phpunit\\core\\ViewTest');

        return $suite;
    }
}
