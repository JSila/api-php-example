<?php

use Faker\Factory;

abstract class ApiTester extends TestCase
{
    use FactoryTrait;

    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @param $url
     * @param string $method
     * @param array $data
     * @return mixed
     */
    public function requestJson($url, $method = 'GET', array $data = [])
    {
        return json_decode($this->call($method, $url, $data)->getContent());
    }

    /**
     * Setting up testing class
     */
    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }

    /**
     * Prepare for test.
     */
    private function prepareForTests()
    {
        Artisan::call('migrate');
    }

    /**
     * Tearing down test
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @param $object
     * @param array $attributes
     */
    public function assertObjectHasAttributes($object, array $attributes)
    {
        foreach($attributes as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }


}