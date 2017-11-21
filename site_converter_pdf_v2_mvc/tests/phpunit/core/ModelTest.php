<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\Model;

/**
 * Model - класс для тестирования Model
 */
class ModelTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new Model();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода getData.
     */
    public function testGetData()
    {
        $this->assertNull($this->fixture->getData());
    }
}
