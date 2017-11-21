<?php

namespace tests\api;

use \ApiTester;

class GetSliderByIdCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests

    /**
     * api/slider/{id} - Successful operation (200).
     */
    public function getSliderById(ApiTester $I)
    {
        $I->wantTo('get slider via API');
        $I->sendGET('http://localhost/my-site/site_converter_pdf_v2_mvc/public/api/slider/232');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"id":232');
        $I->seeResponseContains('"imagesLinks"');
        $I->seeResponseContains('_01.jpeg');
        $I->seeResponseContains('_02.jpeg');
        $I->seeResponseContains('_03.jpeg');
    }

    /**
     * api/slider/{id} - Invalid ID supplied (400).
     */
    public function getSlidersInvalidIdSupplied(ApiTester $I)
    {
        $I->wantTo('get sliders invalid ID supplied');
        $I->sendGET('http://localhost/my-site/site_converter_pdf_v2_mvc/public/api/slider/');
        $I->seeResponseCodeIs(400);
    }

    /**
     * api/slider/{id} - Slider not found (404).
     */
    public function getSliderNotFound(ApiTester $I)
    {
        $I->wantTo('get slider not found');
        $I->sendGET('http://localhost/my-site/site_converter_pdf_v2_mvc/public/api/slider/000');
        $I->seeResponseCodeIs(404);
    }
}
