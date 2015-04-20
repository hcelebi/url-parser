<?php

namespace Test;

use UrlParser\UrlParser;

class UrlParserTest extends \PHPUnit_Framework_TestCase
{
    private $uri;

    public function setUp()
    {
        $this->uri = "http://www.gittigidiyor.com/arama/?k=nokia&uc=1";
    }


    public function testHelloWorld()
    {
        $urlParser = new UrlParser();
        $this->assertEquals("Hello World", $urlParser->helloWorld());
    }

    /**
     * @test
     */
    public function ShouldBeReturnedProtocolType_HTTP()
    {
        $urlParser = new UrlParser();
        $result = $urlParser->getProtocolType($this->uri);
        $this->assertEquals("http", $result);
    }


    /**
     * @test
     */
    public function ShouldBeReturnedQueryParameterCount_IsTwo()
    {
        $urlParser = new UrlParser();
        $result = $urlParser->getQueryParameterCount($this->uri);
        $this->assertEquals(2, $result);
    }

    /**
     * @test
     * @depends ShouldBeReturnedProtocolType_HTTP
     */
    public function ShouldBeReturnedHostname_IsGG()
    {
        $urlParser = new UrlParser();
        $result = $urlParser->getHostname($this->uri);
        $this->assertEquals("www.gittigidiyor.com", $result);
    }



    /**
     * @test
     * @dataProvider additionProvider
     */
    public function ShouldBeReturnedHostname_IsCimri($data)
    {
        $urlParser = new UrlParser();
        $result = $urlParser->getHostname($data);
        $this->assertEquals("www.cimri.com", $result);
    }


    /**
     * @test
     * @expectedException \UrlParser\NotValidURLException
     */
    public function ShouldBeReturnedNotValidURLFormatException()
    {
        $urlParser = new UrlParser();
        $urlParser->isValid("http:/www.gittigidiyor.com");
    }


    /**
     * @test
     */
    public function MockedObject_ShouldBeReturnedHostname_IsGoogle()
    {
        $object = $this->getMock("UrlParser", array("getHostname"));
        $object->expects($this->any())->method("getHostname")->willReturn("www.google.com");
        $this->assertEquals("www.google.com", $object->getHostname());
    }



    public function additionProvider()
    {
        return array(
            array("http://www.cimri.com")
        );
    }
}