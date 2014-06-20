<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Controller_Crawler extends Controller
{
    public function action_index()
    {
        $content = View::factory('crawler/index')->set('links', array());
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
                /** @var Model_Page $page */
                $page = ORM::factory('Page');
                $page->url = $url;
                $page->body = $body;
                $page->save();
            } catch (RequestException $e) {
            }
        }

        $content = View::factory('crawler/crawl');
        $this->response->body($content);
    }
}
