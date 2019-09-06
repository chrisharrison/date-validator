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

## My strategy ##

You can see the way that I approached this task my looking at my commit history.

## Note on really historical dates ##

The solution I've written handles dates back to the year 1 CE. It doesn't handle dates BCE. And bizarrely thinks that there is a year zero. If I was to devote more time to this - and there was a business case for it - I'd investigate that.

## Note on the singleton ##

I designed this solution to be an injectable dependency with an interface. This is how I would normally design a new piece of behaviour/functionality. I'm a believer in completing code tests using the methodology I would normally use in my day-to-day work, rather than trying to guess what the examiner is looking for.

However, I realise that this approach is incompatible with the interface that was suggested as part of the test. Therefore I have also [provided a singleton](src/Singleton) which conforms to the suggested interface while still using the default concrete implementation of my interface.

## Note on PHP date formats ##

The stipulation that the input date format should be `DD/MM/YYYY` reminded me of an interesting quirk of certain PHP functions which I discussed in a [Stackoverflow answer](https://stackoverflow.com/questions/2444820/how-to-make-strtotime-parse-dates-in-australian-i-e-uk-format-dd-mm-yyyy/5619817#5619817) many years ago. Just a mildly interesting titbit 😄