casper.test.begin('Url submitting', 2, function suite(test) {
    var slug = Math.floor((Math.random() * 1000000) + 1);
    var url = 'http://www.random.org/integers/?num=100&min=1&max=' + slug + '&col=5&base=10&format=html&rnd=new';

    casper.start('http://workshop-revive.local/crawler/crawl', function () {
        test.assertExists('form', 'Form must exist');
        this.fill('form', {url: url}, true);
    });

    casper.thenOpen('http://workshop-revive.local/crawler/index', function () {
        test.assertExists('ul.page-list a[href="' + url + '"]', 'Link must exist');
    });

    casper.run(function () {
        test.done();
    });
});
