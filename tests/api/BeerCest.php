<?php

use app\tests\fixtures\BeerFixture;

class BeerCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'beers' => BeerFixture::className()
        ]);
        $I->haveHTTPHeader('Content-Type', 'application/json');
        $I->haveHTTPHeader('Accept', 'application/json');
    }

    public function _after(ApiTester $I)
    {
        $I->dontSeeHttpHeader('Set-Cookie');
    }

    public function createBeerWithWrongForm(ApiTester $I)
    {
        $I->sendPOST('/beers', ['foo' => 'bar']);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            ['field' => 'name', 'message' => 'Name cannot be blank.'],
            ['field' => 'abv', 'message' => 'Abv cannot be blank.']
        ]);
    }

    public function createBeer(ApiTester $I)
    {
        $I->sendPOST('/beers', [
            'name' => 'Brand new beer',
            'abv' => '1.99',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeHttpHeader('Location', 'http://localhost/api/beers/4');
        $I->seeResponseContainsJson([
            'id' => 4,
            'name' => 'Brand new beer',
            'description' => null,
            'abv' => '1.99%',
            'brewery_location' => null
        ]);
    }

    public function overviewBeers(ApiTester $I)
    {
        $I->sendHEAD('/beers');
        $I->seeResponseCodeIs(200);
        $I->seeHttpHeader('Link', '<http://localhost/api/beers?page=1>; rel=self');
        $I->seeHttpHeader('X-Pagination-Current-Page', 1);
        $I->seeHttpHeader('X-Pagination-Page-Count', 1);
        $I->seeHttpHeader('X-Pagination-Per-Page' , 20);
        $I->seeHttpHeader('X-Pagination-Total-Count', 3);
    }

    public function getBeers(ApiTester $I)
    {
        $I->sendGET('/beers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeHttpHeader('Link', '<http://localhost/api/beers?page=1>; rel=self');
        $I->seeHttpHeader('X-Pagination-Current-Page', 1);
        $I->seeHttpHeader('X-Pagination-Page-Count', 1);
        $I->seeHttpHeader('X-Pagination-Per-Page' , 20);
        $I->seeHttpHeader('X-Pagination-Total-Count', 3);
        $I->seeResponseContainsJson([
            [
                'id' => 1,
                'name' => 'Guinness',
                'abv' => '4.20%',
                'brewery_location' => 'Ireland, Dublin'
            ],
        ]);
    }

    public function getBeersInXML(ApiTester $I)
    {
        $I->haveHTTPHeader('Accept', 'application/xml');
        $I->sendGET('/beers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsXml();
        $I->seeXmlResponseMatchesXpath('/response/item[1]');
        $I->seeXmlResponseMatchesXpath('/response/item[2]');
        $I->seeXmlResponseMatchesXpath('/response/item[3]/name[text()="Brahma"]');
    }

    public function getRandomBeer(ApiTester $I)
    {
        $I->sendGET('/beers/random');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer:>0',
            'name' => 'string',
            'description' => 'string',
            'abv' => 'string',
            'brewery_location' => 'string',
        ]);
    }

    public function notFound(ApiTester $I)
    {
        $I->sendGET('/beers/777');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'name' => 'Not Found',
            'message' => 'Object not found: 777',
            'code' => 0,
            'status' => 404,
            'type' => 'yii\web\NotFoundHttpException',
        ]);
    }

    public function getBeer(ApiTester $I)
    {
        $I->sendGET('/beers/2');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'id' => 2,
            'name' => 'Smithwick’s Irish Ale',
            'abv' => '4.50%',
            'brewery_location' => 'Ireland, Kilkenny'
        ]);
    }

    public function updateBeerWithWrongForm(ApiTester $I)
    {
        $I->sendPUT('/beers/2', [
            'abv' => '450 percent',
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            ['field' => 'abv', 'message' => 'Abv must be a number.']
        ]);
    }

    public function updateBeerWithPut(ApiTester $I)
    {
        $I->sendPUT('/beers/2', [
            'id' => 2,
            'name' => 'Smithwick’s Irish Red Ale',
            'description' => 'Short and sweet'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            // changed
            'name' => 'Smithwick’s Irish Red Ale',
            'description' => 'Short and sweet',
            // no changes
            'id' => 2,
            'abv' => '4.50%',
            'brewery_location' => 'Ireland, Kilkenny'
        ]);
    }

    public function updateBeerWithPatch(ApiTester $I)
    {
        $I->sendPATCH('/beers/2', [
            'id' => 2,
            'name' => 'The same as PUT',
            'description' => 'PUT and PATCH use the same controller/action',
            'abv' => '3.01',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            // changed
            'name' => 'The same as PUT',
            'description' => 'PUT and PATCH use the same controller/action',
            'abv' => '3.01%',
            // no changes
            'id' => 2,
            'brewery_location' => 'Ireland, Kilkenny',
        ]);
    }
}
