<?php
require_once'../../lib';

class DelymbriaCoreTest extends PHPUnit_Framework_TestCase
{    
    public function setUp()
    {
    }
    
    public function tearDown()
    {
        
    }
    
    public function testConstruct()
    {
        $test = new DelymbriaCore();
        
        $testvar = $test->getCoreData();
        
        $this->assertEquals("1.0a1", $testvar["version"]);
    }
}