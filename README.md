federalPovertyLevel
=====================

A PHP library for working with data associated with the United States Federal Poverty Level (FPL).  Household income, as a percentage of FPL is often used to determine eligibility for government assistance programs such as Medicaid.

More information about the Federal Poverty Limit can be found [here](http://aspe.hhs.gov/poverty/index.cfm).

```php
$fpl = new FederalPovertyLevel();

$fpl->setYear(2014)
    ->setState('MO')
    ->setPersonsInHousehold(2)
    ->setHouseholdIncome(15000);


// Get Household's percentage of Federal Poverty Level
$percentageOfFpl = $fpl->getPovertyGuidelineAsPercentage(); // e.g. 50

// Get Household's percentage of Federal Poverty Level as decimal
$percentageOfFpl = $fpl->getPovertyGuidelineAsDecimal(); // e.g. 0.5


```

<a name="install"/>
## Installation

### Via Composer

1. federalPovertyLevel is available on [Packagist](https://packagist.org).
2. It can be installed as a dependency of your project by running

        $ composer require-dev johnkramlich/federal-poverty-level

<a name="about-author"/>
## Author

John Kramlich - <me@johnkramlich.com> - <http://twitter.com/jkramlich>

If you use this library please send me an email / tweet and let me know.  I always like to know when my code is useful to others.

<a name="about-license"/>
## License

federalPovertyLevel is licensed under the MIT License - see the `LICENSE` file for details
