<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../../vendor/autoload.php';

use JohnKramlich\FederalPovertyLevel;

class FederalPovertyLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $year               = 2014;
        $state              = 'MO';
        $personsInHousehold = 2;
        $householdIncome    = 15000;

        $object = new FederalPovertyLevel();

        $object->setYear($year)
            ->setState($state)
            ->setPersonsInHousehold($personsInHousehold)
            ->setHouseholdIncome($householdIncome);

        $this->assertEquals($year, $object->getYear());
        $this->assertEquals($state, $object->getState());
        $this->assertEquals($personsInHousehold, $object->getPersonsInHousehold());
        $this->assertEquals($householdIncome, $object->getHouseholdIncome());
    }

    public function testException()
    {
        $this->setExpectedException('Exception');
        $object = new FederalPovertyLevel();

        $object->setYear(1900);
    }

    public function testDefaultYear()
    {
        $now  = new DateTime();
        $year = $now->format("Y");

        $object = FederalPovertyLevel::factory('MO', 11490, 1);

        $this->assertEquals($year, $object->getYear());
    }

    public function testPovertyGuidelinePercentage()
    {
        $object = FederalPovertyLevel::factory('MO', 11490, 1, 2014);
        $ratio  = $object->getPovertyGuidelineAsPercentage();

        $this->assertEquals(100, $ratio);

        $object = FederalPovertyLevel::factory('MO', 17235, 1, 2014);
        $ratio  = $object->getPovertyGuidelineAsPercentage();

        $this->assertEquals(150, $ratio);

        $object = FederalPovertyLevel::factory('MO', 20107, 1, 2014);
        $ratio  = $object->getPovertyGuidelineAsPercentage();

        $this->assertEquals(175, $ratio);
    }

    public function testPovertyGuidelineDecimal()
    {
        $object = FederalPovertyLevel::factory('MO', 11490, 1, 2014);
        $ratio  = $object->getPovertyGuidelineAsDecimal();

        $this->assertEquals(1, $ratio);

        $object = FederalPovertyLevel::factory('MO', 17235, 1, 2014);
        $ratio  = $object->getPovertyGuidelineAsDecimal();

        $this->assertEquals(1.5, $ratio);

        $object = FederalPovertyLevel::factory('MO', 20107, 1, 2014);
        $ratio  = $object->getPovertyGuidelineAsDecimal();

        $this->assertEquals(1.75, $ratio);
    }

    public function testGuidelines()
    {
        $data = array(
            'MO' => array(
                '1' => 11490,
                '2' => 15510,
                '3' => 19530,
                '4' => 23550,
                '5' => 27570,
                '6' => 31590,
                '7' => 35610,
                '8' => 39630,
                '9' => 43650,
                '10' => 47670
            ),
            'HI' => array(
                '1' => 13230,
                '2' => 17850,
                '3' => 22470,
                '4' => 27090,
                '5' => 31710,
                '6' => 36330,
                '7' => 40950,
                '8' => 45570,
                '9' => 50190,
                '10' => 54810
            ),
            'AK' => array(
                '1' => 14350,
                '2' => 19380,
                '3' => 24410,
                '4' => 29440,
                '5' => 34470,
                '6' => 39500,
                '7' => 44530,
                '8' => 49560,
                '9' => 54590,
                '10' => 59620
            )
        );

        $year = 2014;

        foreach($data as $state => $table)
        {
            foreach($table as $personsInHousehold => $householdIncome)
            {
                $object = FederalPovertyLevel::factory($state, $householdIncome, $personsInHousehold, $year);
                $povertyGuideline = $object->getPovertyGuideline();

                $this->assertEquals($povertyGuideline, $householdIncome);
            }
        }
    }
}
