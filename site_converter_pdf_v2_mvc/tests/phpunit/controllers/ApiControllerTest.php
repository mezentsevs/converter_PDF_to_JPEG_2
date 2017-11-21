<?php

namespace tests\phpunit\controllers;

use PHPUnit\Framework\TestCase;
use controllers\ApiController;

/**
 * ApiControllerTest - класс для тестирования ApiController
 */
class ApiControllerTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new ApiController();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода аctionIndex.
     */
    public function testActionIndex()
    {
        $this->assertNull($this->fixture->actionIndex());
    }

    /**
     * Тест метода actionSlider.
     */
    public function testActionSlider()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода sendResponse.
     */
    public function testSendResponse()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода getStatusCodeMessage.
     * @dataProvider providerGetStatusCodeMessage
     */
    public function testGetStatusCodeMessage($statusCode, $message)
    {
        $this->assertEquals(
            $message,
            $this->fixture->getStatusCodeMessage($statusCode)
        );
    }

    /**
     * Провайдер данных теста testGetStatusCodeMessage.
     */
    public function providerGetStatusCodeMessage()
    {
        return [
            [null, ''],
            [200, 'Successful operation'],
            [400, 'Invalid ID supplied'],
            [404, 'Slider not found']
        ];
    }
}
