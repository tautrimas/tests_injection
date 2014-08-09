<?php

use App\Detector\LanguageDetector;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;

class Controller_Crawler extends Controller
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $container;

    public function before()
    {
        $this->container = \App\DependencyInjection\ContainerSingleton::get();
    }

    public function action_index()
    {
        $pages = ORM::factory('Page')->order_by('id', 'desc')->find_all();

        $template = View::factory('common/template');
        $template->body = View::factory('crawler/list')->set('pages', $pages);
        $this->response->body($template);
    }

    public function action_recent()
    {
        $pages = ORM::factory('Page')->order_by('id', 'desc')->limit(3)->find_all();

        $template = View::factory('common/template');
        $template->body = View::factory('crawler/list')->set('pages', $pages);
        $this->response->body($template);
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

                /** @var LanguageDetector $detector */
                $detector = $this->container->get('app.detector.language_detector');
                $language = $detector->detectLanguage($text);

                /** @var Model_Page $page */
                $page = ORM::factory('Page');
                $page->url = $url;
                $page->body = $text;
                $page->lang = $language;
                $page->create();
            } catch (RequestException $e) {
            }
        }

        $template = View::factory('common/template');
        $template->body = View::factory('crawler/crawl');
        $this->response->body($template);
    }
}
