<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\DatabaseObject;

/**
 * DatabaseObject - класс для тестирования DatabaseObject
 */
class DatabaseObjectTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new DatabaseObject();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода findAll.
     */
    public function testFindAll()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода findById.
     */
    public function testFindById()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода findBySql.
     */
    public function testFindBySql()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода countAll.
     */
    public function testCountAll()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода instantiate.
     */
    public function testInstantiate()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода hasAttribute.
     */
    public function testHasAttribute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода attributes.
     */
    public function testAttributes()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода sanitizedAttributes.
     */
    public function testSanitizedAttributes()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода save.
     */
    public function testSave()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода create.
     */
    public function testCreate()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода update.
     */
    public function testUpdate()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода delete.
     */
    public function testDelete()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
