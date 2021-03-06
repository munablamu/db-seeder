<?php

/**
 * Created by PhpStorm.
 * User: tebazil
 * Date: 10.09.15
 * Time: 0:09
 */
use \munablamu\dbseeder\Generator;
class FakerConfiguratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \tebazil\dbseeder\FakerConfigurator
     */
    private $faker;
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->faker = new \munablamu\dbseeder\FakerConfigurator();
    }


    public function testGetProperty()
    {
        $property = 'asdf';
        $this->assertEquals([Generator::FAKER, $property, null, [
            'optional'=>false,
            'unique'=>false,
        ]], $this->faker->$property);
    }

    public function testCallMethod()
    {
        $method = 'asdfa';
        $methodParam1 = 'asdf';
        $methodParam2 = 'asdfasf';
        $this->assertEquals([Generator::FAKER, $method, [$methodParam1, $methodParam2], [
            'optional'=>false,
            'unique'=>false,
        ]], $this->faker->$method($methodParam1, $methodParam2));
    }

    public function testOptional() {
        $method = 'asdfa';
        $methodParam1 = 'asdf';
        $methodParam2 = 'asdfasf';
        $this->assertEquals([Generator::FAKER, $method, [], [
            'optional'=>[],
            'unique'=>false,
        ]], $this->faker->optional()->$method());
        $this->assertEquals([Generator::FAKER, $method, [], [
            'optional'=>[$methodParam1, $methodParam2],
            'unique'=>false,
        ]], $this->faker->optional($methodParam1, $methodParam2)->$method());
    }


    public function testUnique() {
        $method = 'asdfa';
        $methodParam1 = 'asdf';
        $methodParam2 = 'asdfasf';
        $this->assertEquals([Generator::FAKER, $method, [], [
            'optional'=>false,
            'unique'=>[],
        ]], $this->faker->unique()->$method());
        $this->assertEquals([Generator::FAKER, $method, [], [
            'optional'=>false,
            'unique'=>[$methodParam1, $methodParam2],
        ]], $this->faker->unique($methodParam1, $methodParam2)->$method());
    }

    public function testOptionsReset() {
        $method = 'asdfa';
        $methodParam1 = 'asdf';
        $methodParam2 = 'asdfasf';
        $this->assertEquals([Generator::FAKER, $method, [], [
            'optional'=>[],
            'unique'=>[$methodParam1, $methodParam2],
        ]], $this->faker->unique($methodParam1, $methodParam2)->optional()->$method());
        $this->assertEquals([Generator::FAKER, $method, [], [
            'optional'=>false,
            'unique'=>false,
        ]], $this->faker->$method());
    }

    //todo: test some faker output to make sure it works
}
