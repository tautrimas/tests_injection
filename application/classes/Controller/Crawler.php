<?php

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
        }

        $content = View::factory('crawler/crawl');
        $this->response->body($content);
    }
}
