<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\CssSelector\Parser\Parser;
use Symfony\Component\DomCrawler\Crawler;

class Controller_Crawler extends Controller
{
    public function action_index()
    {
        $pages = ORM::factory('Page')->find_all();

        $content = View::factory('crawler/index')->set('pages', $pages);
        $this->response->body($content);
    }

    public function action_crawl()
    {
        if ($this->request->post()) {
            $url = $this->request->post('url');
            $client = new Client();
            try {
                $response = $client->get($url);
                $body = (string)$response->getBody();
                $parser = new Crawler($body);
                $nodes = $parser->filter('h1,h2,h3,h4,h5,h6,p');
                $texts = $nodes->each(
                    function (Crawler $node) {
                        return $node->text();
                    }
                );
                $text = implode("\n", $texts);
                /** @var Model_Page $page */
                $page = ORM::factory('Page');
                $page->url = $url;
                $page->body = $text;
                $page->create();
            } catch (RequestException $e) {
            }
        }

        $content = View::factory('crawler/crawl');
        $this->response->body($content);
    }
}
