<?php

namespace tests\phpunit\models;

use PHPUnit\Framework\TestCase;
use models\Document;

/**
 * DocumentTest - класс для тестирования Document
 */
class DocumentTest extends TestCase
{
    /**
     * Вызывается один раз перед началом каждого теста.
     */
    protected function setUp()
    {
        $this->fixture = new Document();
    }

    /**
     * Вызывается после окончания теста.
     */
    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Тест метода findAllDocuments.
     */
    public function testFindAllDocuments()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода attachFile.
     */
    public function testAttachFile()
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
     * Тест метода pdfFilePath.
     */
    public function testPdfFilePath()
    {
        $this->fixture->uploadDir = 'testUploadDir';
        $this->fixture->filename = 'testFileName.pdf';
        $this->assertRegExp(
            '/testFileName.pdf$/',
            $this->fixture->pdfFilePath()
        );
    }

    /**
     * Тест метода imgFolderPath.
     */
    public function testImgFolderPath()
    {
        $this->fixture->filename = 'testFileName.pdf';
        $this->fixture->slidersDir = 'testSlidersDir';
        $this->fixture->imagesDir = 'testImagesDir';
        $this->assertRegExp(
            '/testImagesDir$/',
            $this->fixture->imgFolderPath()
        );
    }

    /**
     * Тест метода sliderFolderPath.
     */
    public function testSliderFolderPath()
    {
        $this->fixture->filename = 'testFileName.pdf';
        $this->fixture->slidersDir = 'testSlidersDir';
        $this->assertRegExp(
            '/testFileName$/',
            $this->fixture->sliderFolderPath()
        );
    }

    /**
     * Тест метода sliderIndexhtmlPath.
     */
    public function testSliderIndexhtmlPath()
    {
        $this->assertStringEndsWith(
            'index.html',
            $this->fixture->sliderIndexhtmlPath()
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

    /**
     * Тест метода sliderIndexhtmlContent.
     */
    public function testSliderIndexhtmlContent()
    {
        $slidesArray = [
            'testSlide01.jpeg',
            'testSlide02.jpeg',
            'testSlide03.jpeg'
        ];
        $this->assertStringMatchesFormat(
            '%a',
            $this->fixture->sliderIndexhtmlContent($slidesArray)
        );
    }

    /**
     * Тест метода sliderIndexhtmlWrite.
     */
    public function testSliderIndexhtmlWrite()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода convert.
     */
    public function testConvert()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Тест метода getImagesLinks.
     */
    public function testGetImagesLinks()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
