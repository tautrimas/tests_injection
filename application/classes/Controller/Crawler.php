<?php

class Controller_Crawler extends Controller
{
    public function action_index()
    {
        $content = View::factory('crawler/index')->set('links', array());
        $this->response->body($content);
    }
}
