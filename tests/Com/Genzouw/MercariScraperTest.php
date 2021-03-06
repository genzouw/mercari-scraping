<?php

/**
 * @author   genzouw <genzouw@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package
 */
use Com\Genzouw\MercariScraper;

class MercariScraperTest extends \PHPUnit_Framework_TestCase  {

    public function setUp() {
    }

    public function tearDown() {
    }


    /**
     * @test
     */
    public function test_findItems() {
        $target = new MercariScraper();

        $expected = array();

        // ----- Validating -----
        $this->assertEquals(
            $expected,
            $target->findItems()
        );
    }
}
