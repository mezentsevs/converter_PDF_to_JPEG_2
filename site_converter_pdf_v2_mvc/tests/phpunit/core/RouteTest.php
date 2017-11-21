<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\Route;

/**
 * RouteTest - класс для тестирования Route
 */
class RouteTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new Route();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода start.
     */
    public function testStart()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
