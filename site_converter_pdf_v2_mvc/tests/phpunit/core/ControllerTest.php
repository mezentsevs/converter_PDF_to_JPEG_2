<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\Controller;

/**
 * ControllerTest - класс для тестирования Controller
 */
class ControllerTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new Controller();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода actionIndex.
     */
    public function testActionIndex()
    {
        $this->assertNull($this->fixture->actionIndex());
    }
}
