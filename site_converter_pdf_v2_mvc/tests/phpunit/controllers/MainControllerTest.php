<?php

namespace tests\phpunit\controllers;

use PHPUnit\Framework\TestCase;
use controllers\MainController;

/**
 * MainControllerTest - класс для тестирования MainController
 */
class MainControllerTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new MainController();
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
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
