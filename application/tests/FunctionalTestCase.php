<?php

namespace tests;

/**
 * Base test case for testing specifications
 */
class FunctionalTestCase extends \Unittest_TestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        \Kohana::$config->attach(new \Config_File('config/testing'));
        $this->clearDatabase();
        $this->prepareDatabase();
    }

    /**
     * Truncate all database tables
     */
    protected function clearDatabase()
    {
        \DB::query(\Database::DELETE, 'TRUNCATE TABLE `pages`')->execute();
    }

    /**
     * Insert all fixture rows to their respective tables
     */
    public function prepareDatabase()
    {
        foreach ($this->getTestEntries() as $model => $entries) {
            foreach ($entries as $entryData) {
                $entry = \ORM::factory($model);
                foreach ($entryData as $field => $value) {
                    $entry->{$field} = $value;
                }
                $entry->create();
            }
        }
    }

    /**
     * Override this method to return database test fixtures.
     *
     * @return array
     */
    protected function getTestEntries()
    {
        return array();
    }
}
