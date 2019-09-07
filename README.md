# date-validator #

## Installation ##

I've added this to Packagist, so you can use:

```
composer require chrisharrison/date-validator
```

Alternatively, you can clone the repository and run:

```
composer install
```

## Running tests ##

Run tests with:

```
vendor/bin/phpunit
```

## Usage ##

You can inject the date validator like this:

```
final class SomeOtherFunctionality
{
    private $dateValidator;
    
    public function __construct(DateValidator $dateValidator)
    {
        $this->dateValidator = $dateValidator;
    }
    
    public function doSomethingWithDate(string $date)
    {
        if ($this->dateValidator->validate()->isValid()) {
            return 'A valid historical date';
        }
    }
}
```

This package comes with a default implementation. The `DefaultDateValidator` requires a `Clock` in order for it to compare dates. A `DefaultDateValidator` should be initialised within an IoC container. It can be constructed like this:

```$xslt
$dateValidator = new DefaultDateValidator(new SystemClock);
```

The `validate()` method returns a `DateValidatorResponse` value object with the following methods:

* `isValid(): bool` Whether the date is a valid historical date or not.
* `getMessage(): DateValidatorResponseMessage` Returns an enum with the following options:
    * `INVALID_DATE` The input date is not a valid date (e.g. 32/13/1994)
    * `NOT_A_DATE_IN_THE_PAST` The input date is valid but it's not in the past (e.g. 01/01/3033)
    * `INVALID_FORMAT` The input is not a date at all (e.g. 'jibberish')
    * If the date is valid then the message is a null version of `DateValidatorResponseMessage`
    
This package also [provides a singleton](src/Singleton) which can be used like this:
```
use ChrisHarrison\DateValidator\Singleton\DateValidator;

DateValidator::validateHistoricalDate('03/12/1999');
```

The singleton uses a DefaultDateValidator internally and `validateHistoricalDate()` works the same way as above.

## My strategy ##

You can see the way that I approached this task my looking at my commit history.

## Note on really historical dates ##

The solution I've written handles dates back to the year 1 CE. It doesn't handle dates BCE. And bizarrely thinks that there is a year zero. If I was to devote more time to this - and there was a business case for it - I'd investigate that. [OK I couldn't resist looking it up. It seems that PHP is using some implementation of ISO 8601 and not the Gregorian calendar]

## Note on PHP date formats ##

The stipulation that the input date format should be `DD/MM/YYYY` reminded me of an interesting quirk of certain PHP functions which I discussed in a [Stackoverflow answer](https://stackoverflow.com/questions/2444820/how-to-make-strtotime-parse-dates-in-australian-i-e-uk-format-dd-mm-yyyy/5619817#5619817) many years ago. Just a mildly interesting titbit 😄