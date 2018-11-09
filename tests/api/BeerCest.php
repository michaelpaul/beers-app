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

    public function getBeers(ApiTester $I)
    {
        $I->sendGET('/beers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeHttpHeader('X-Pagination-Current-Page', 1);
        $I->seeHttpHeader('X-Pagination-Page-Count', 1);
        $I->seeHttpHeader('X-Pagination-Per-Page' , 20);
        $I->seeHttpHeader('X-Pagination-Total-Count', 3);
        $I->seeResponseContains('"id":');
        $I->seeResponseContains('"name":');
        $I->seeResponseContains('"abv":');
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
}
