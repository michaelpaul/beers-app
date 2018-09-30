jQuery(function ($) {
    $('.js-another').click(function (e) {
        e.preventDefault();
        $.getJSON('/api/beers/random')
            .done(function (beer) {
                $('.js-name').text(beer.name);
                $('.js-desc').text(beer.description);
                $('.js-abv').text(beer.abv);
                $('.js-location').text(beer.brewery_location || 'Unknown');
            }).fail(function (jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("Error: ", jqXHR, textStatus, errorThrown);
                }
            });
    });
});