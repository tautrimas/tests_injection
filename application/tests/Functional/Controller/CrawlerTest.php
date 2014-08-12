<?php

namespace tests\Functional\Controller;

use Request;
use Symfony\Component\DomCrawler\Crawler;
use tests\FunctionalTestCase;

class CrawlerTest extends FunctionalTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getTestEntries()
    {
        return array(
            'Page' => array(
                array(
                    'url' => 'http://example.com',
                    'body' => 'foo',
                    'lang' => 'en',
                ),
            ),
        );
    }

    /**
     * If user submits a URL to crawler page, it should see crawled page in page list.
     */
    public function testList()
    {
        $url = 'http://example.com';

        $request = \Request::factory('crawler/index');
        $response = $request->execute();
        $crawler = new Crawler($response->body());
//        var_dump($response->body());
        $listItems = $crawler->filter('.page-list tbody tr');
        $this->assertCount(1, $listItems);
        $linkText = $listItems->first()->filter('a')->text();
        $this->assertSame($url, trim($linkText));
        $linkHref = $listItems->first()->filter('a')->attr('href');
        $this->assertSame($url, $linkHref);
    }

//    /**
//     * Visit crawler page and submit the URL.
//     *
//     * @param string $url
//     */
//    protected function crawlPage($url)
//    {
//        $request = \Request::factory('crawler/crawl');
//        $request->method(Request::POST);
//        $request->body();
//        $request->post(array('url' => $url, 'save' => null));
//        $request->execute();
//    }
}
