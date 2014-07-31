<?php

namespace tests;

class IntegrationTestCase extends \Unittest_TestCase
{
    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        \Kohana::$config->attach(new \Config_File('config/testing'));
    }

    protected function clearDatabase()
    {
        \DB::delete('pages')->execute();
    }
}
