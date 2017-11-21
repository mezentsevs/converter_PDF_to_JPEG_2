<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\Session;

/**
 * SessionTest - класс для тестирования Session
 */
class SessionTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new Session();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода message.
     */
    public function testMessage()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода errors.
     */
    public function testErrors()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода checkMessage.
     */
    public function testCheckMessage()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
