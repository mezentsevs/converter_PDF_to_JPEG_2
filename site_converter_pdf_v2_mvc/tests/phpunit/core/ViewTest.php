<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\View;

/**
 * ViewTest - класс для тестирования View
 */
class ViewTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new View();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода generate.
     */
    public function testGenerate()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
