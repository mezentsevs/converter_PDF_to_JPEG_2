<?php

namespace tests\phpunit\models;

use PHPUnit\Framework\TestCase;
use models\Image;

/**
 * ImageTest - класс для тестирования Image
 */
class ImageTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new Image();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода findAllImages.
     */
    public function testFindAllImages()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода findImagesForDocument.
     */
    public function testFindImagesForDocument()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода imgFilePath.
     */
    public function testImgFilePath()
    {
        $this->fixture->filename = 'testFileName.jpeg';
        $this->assertStringEndsWith(
            'testFileName.jpeg',
            $this->fixture->imgFilePath()
        );
    }

    /**
     * Тест метода destroy.
     */
    public function testDestroy()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
