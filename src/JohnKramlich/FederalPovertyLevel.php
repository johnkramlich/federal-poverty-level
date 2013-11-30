<?php

namespace JohnKramlich;

use JohnKramlich\FederalPovertyLevel\Exception;
use \DateTime;

/**
 * Federal Poverty Level
 *
 * A PHP library for working with data associated with the United States Federal Poverty Level (FPL). Household income,
 * as a percentage of FPL is often used to determine eligibility for government assistance programs such as Medicaid
 *
 * @link http://aspe.hhs.gov/poverty/index.cfm
 *
 * @author John Kramlich <me@johnkramlich.com>
 */
class FederalPovertyLevel
{
    /**
     * Number of persons in the household
     * @var int
     */
    private $personsInHousehold;

    /**
     * Modified adjusted gross household income
     * @var int
     */
    private $householdIncome;

    /**
     * The year we are working with, e.g. 2013, 2014
     * @var int
     */
    private $year;

    /**
     * State abbreviation
     * @var string
     */
    private $state;


    /**
     * Gets the Number of persons in the household.
     *
     * @return int
     */
    public function getPersonsInHousehold()
    {
        return $this->personsInHousehold;
    }


    /**
     * Sets the Number of persons in the household.
     *
     * @param int $personsInHousehold the persons in household
     *
     * @return self
     */
    public function setPersonsInHousehold($personsInHousehold)
    {
        $this->personsInHousehold = (int)$personsInHousehold;

        return $this;
    }


    /**
     * Gets the Modified adjusted gross household income, in USD.
     *
     * @return int
     */
    public function getHouseholdIncome()
    {
        return $this->householdIncome;
    }


    /**
     * Sets the Modified adjusted gross household income.
     *
     * @param int $householdIncome the household income, in USD
     *
     * @return self
     */
    public function setHouseholdIncome($householdIncome)
    {
        $this->householdIncome = (int)$householdIncome;

        return $this;
    }


    /**
     * Gets the The year we are working with, e.g. 2013, 2014.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }


    /**
     * Sets the The year we are working with, e.g. 2013, 2014.
     *
     * @param int $year the year
     * @throws Exception
     *
     * @return self
     */
    public function setYear($year)
    {
        if ($year !== 2013 && $year !== 2014) {
            throw new Exception("Unsupported year for Federal Poverty Level");
        }

        $this->year = $year;

        return $this;
    }


    /**
     * Gets the State abbreviation.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * Sets the State abbreviation.
     *
     * @param string $state the state
     *
     * @return self
     */
    public function setState($state)
    {
        $this->state = strtoupper($state);

        return $this;
    }


    /**
     * Get Poverty Guideline
     *
     * @return int Household income that is considered 100% of the poverty limit
     */
    public function getPovertyGuideline()
    {
        $povertyGuideline = 0;

        switch ($this->state) {
            case 'AK':
                if ($this->personsInHousehold === 1) {
                    $povertyGuideline = 14350;
                } else if ($this->personsInHousehold === 2) {
                    $povertyGuideline = 19380;
                } else if ($this->personsInHousehold === 3) {
                    $povertyGuideline = 24410;
                } else if ($this->personsInHousehold === 4) {
                    $povertyGuideline = 29440;
                } else if ($this->personsInHousehold === 5) {
                    $povertyGuideline = 34470;
                } else if ($this->personsInHousehold === 6) {
                    $povertyGuideline = 39500;
                } else if ($this->personsInHousehold === 7) {
                    $povertyGuideline = 44530;
                } else if ($this->personsInHousehold === 8) {
                    $povertyGuideline = 49560;
                } else if ($this->personsInHousehold > 8) {
                    $additionalPersons = 5030;
                    $povertyGuideline = 49560 + ($additionalPersons * ($this->personsInHousehold - 8));
                }

                break;

            case 'HI':
                if ($this->personsInHousehold === 1) {
                    $povertyGuideline = 13230;
                } else if ($this->personsInHousehold === 2) {
                    $povertyGuideline = 17850;
                } else if ($this->personsInHousehold === 3) {
                    $povertyGuideline = 22470;
                } else if ($this->personsInHousehold === 4) {
                    $povertyGuideline = 27090;
                } else if ($this->personsInHousehold === 5) {
                    $povertyGuideline = 31710;
                } else if ($this->personsInHousehold === 6) {
                    $povertyGuideline = 36330;
                } else if ($this->personsInHousehold === 7) {
                    $povertyGuideline = 40950;
                } else if ($this->personsInHousehold === 8) {
                    $povertyGuideline = 45570;
                } else if ($this->personsInHousehold > 8) {
                    $additionalPersons = 4620;
                    $povertyGuideline = 45570 + ($additionalPersons * ($this->personsInHousehold - 8));
                }

                break;

            default:

                if ($this->personsInHousehold === 1) {
                    $povertyGuideline = 11490;
                } else if ($this->personsInHousehold === 2) {
                    $povertyGuideline = 15510;
                } else if ($this->personsInHousehold === 3) {
                    $povertyGuideline = 19530;
                } else if ($this->personsInHousehold === 4) {
                    $povertyGuideline = 23550;
                } else if ($this->personsInHousehold === 5) {
                    $povertyGuideline = 27570;
                } else if ($this->personsInHousehold === 6) {
                    $povertyGuideline = 31590;
                } else if ($this->personsInHousehold === 7) {
                    $povertyGuideline = 35610;
                } else if ($this->personsInHousehold === 8) {
                    $povertyGuideline = 39630;
                } else if ($this->personsInHousehold > 8) {
                    $additionalPersons = 4020;
                    $povertyGuideline = 39630 + ($additionalPersons * ($this->personsInHousehold - 8));
                }

                break;
        }

        return $povertyGuideline;
    }


    /**
     * Get Poverty Guideline as Percentage
     *
     * @param int $precision Precision of return value
     * @return int|float Value e.g. 1%, 100%, 150%
     */
    public function getPovertyGuidelineAsPercentage($precision = 2)
    {
        $povertyGuideline = $this->getPovertyGuideline();
        $percentageOfPovertyLevel = $this->householdIncome / $povertyGuideline;
        $percentageOfPovertyLevel = $percentageOfPovertyLevel * 100;
        $percentageOfPovertyLevel = round($percentageOfPovertyLevel, $precision);

        return $percentageOfPovertyLevel;
    }


    /**
     * Get Poverty Guideline as Decimal
     *
     * @param int $precision Precision of return value
     * @return int|float Decimal value of poverty guideline, e.g. 0.5, 1.0, 4.0
     */
    public function getPovertyGuidelineAsDecimal($precision = 2)
    {
        $povertyGuideline = $this->getPovertyGuideline();
        $percentageOfPovertyLevel = $this->householdIncome / $povertyGuideline;
        $percentageOfPovertyLevel = round($percentageOfPovertyLevel, $precision);

        return $percentageOfPovertyLevel;
    }


    /**
     * Factory
     *
     * @param  string $state State Abbreviation
     * @param  int $year Year
     * @param  int $householdIncome Modified adjusted gross household income
     * @param  int $personsInHousehold Number of persons in household
     * @return FederalPovertyLevel                     Populated object
     */
    public static function factory($state, $householdIncome, $personsInHousehold, $year = null)
    {
        // If no year is defined, use the current
        if ($year === null) {
            $now = new DateTime();
            $year = (int)$now->format("Y");
        }

        $object = new FederalPovertyLevel();

        $object->setState($state)
            ->setYear($year)
            ->setHouseholdIncome($householdIncome)
            ->setPersonsInHousehold($personsInHousehold);

        return $object;
    }
}