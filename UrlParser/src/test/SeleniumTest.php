<?php

namespace Test;

use PHPUnit_Extensions_Selenium2TestCase;

class Selenium2Test extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser("firefox");
        $this->setBrowserUrl("http://www.gittigidiyor.com");
    }

    /**
     * @test
     */
    public function testTitle()
    {
        $this->url('http://www.gittigidiyor.com');
        $this->assertEquals("GittiGidiyor - Türkiye'nin En İşlek Alışveriş Merkezi", $this->title());
    }

    /**
     * @test
     */
    public function searchKeywordNokia()
    {
        $this->url("http://www.gittigidiyor.com/arama");
        $this->byId("search-keyword")->value("nokia");
        $this->byName("submit_detay")->click();

        $totalProductCount = $this->byClassName("result-count")->text();
        $this->assertTrue($totalProductCount >  0);
    }

    /**
     * @test
     */
    public function loginWithAyfer()
    {
        $this->url("http://www.gittigidiyor.com/uye-girisi");
        $this->byId("L-UserNameField")->value("gg_test_ayfer2");
        $this->byId("L-PasswordField")->value("deneme");
        $this->byId("L-Enter")->click();
        $this->assertEquals("GittiGidiyor'a Hoşgeldiniz!", $this->title());
    }


    protected function getScreenShot()
    {
        $file_name = '/Users/hcelebi/Desktop/screenshots' . '/' . get_class($this) . ':' . $this->getName() . '_' . date('Y-m-d_H:i:s') . '.png';
        file_put_contents($file_name, $this->currentScreenshot());
    }


    public function tearDown()
    {
        if ($this->getStatus() == \PHPUnit_Runner_BaseTestRunner::STATUS_ERROR || $this->getStatus() == \PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE) {
            $this->getScreenShot();
        }
    }
}