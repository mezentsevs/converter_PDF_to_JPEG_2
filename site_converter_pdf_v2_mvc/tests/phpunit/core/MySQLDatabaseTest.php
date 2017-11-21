<?php

namespace tests\phpunit\core;

use PHPUnit\Framework\TestCase;
use core\MySQLDatabase;

/**
 * MySQLDatabase - класс для тестирования MySQLDatabase
 */
class MySQLDatabaseTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new MySQLDatabase();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода openConnection.
     */
    public function testOpenConnection()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода closeConnection.
     */
    public function testCloseConnection()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода query.
     */
    public function testQuery()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода freeResult.
     */
    public function testFreeResult()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода escapeValue.
     */
    public function testEscapeValue()
    {
        $this->assertStringMatchesFormat(
            '%s',
            $this->fixture->escapeValue('  " { test \ @  ')
        );
    }

    /**
     * Тест метода fetchArray.
     */
    public function testFetchArray()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода numRows.
     */
    public function testNumRows()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода insertId.
     */
    public function testInsertId()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода affectedRows.
     */
    public function testAffectedRows()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода confirmQuery.
     */
    public function testConfirmQuery()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
