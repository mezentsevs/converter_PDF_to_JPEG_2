<?php

namespace tests\phpunit\controllers;

use PHPUnit\Framework\TestSuite;

/**
 * AllControllersTests - класс набора тестов для controllers.
 */
class AllControllersTests
{
    public static function suite()
    {
        $suite = new TestSuite('ControllersSuite');

        // Добавляем тесты в набор:
        $suite->addTestSuite('tests\\phpunit\\controllers\\ApiControllerTest');
        $suite->addTestSuite('tests\\phpunit\\controllers\\MainControllerTest');
        $suite->addTestSuite('tests\\phpunit\\controllers\\SliderControllerTest');

        return $suite;
    }
}
