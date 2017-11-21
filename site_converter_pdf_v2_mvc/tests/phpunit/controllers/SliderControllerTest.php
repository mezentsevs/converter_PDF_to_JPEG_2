<?php

namespace tests\phpunit\controllers;

use PHPUnit\Framework\TestCase;
use controllers\SliderController;

/**
 * SliderControllerTest - класс для тестирования SliderController
 */
class SliderControllerTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new SliderController();
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
