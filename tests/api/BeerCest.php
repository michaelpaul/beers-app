<?php

class BeerCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHTTPHeader('Content-type', 'application/json');
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
