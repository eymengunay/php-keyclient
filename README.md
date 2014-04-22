# PHP KEYCLIENT LIBRARY

[![Build Status](https://travis-ci.org/eymengunay/php-keyclient.png?branch=master)](https://travis-ci.org/eymengunay/php-keyclient)
[![Total Downloads](https://poser.pugx.org/eo/keyclient/downloads.png)](https://packagist.org/packages/eo/keyclient)
[![Latest Stable Version](https://poser.pugx.org/eo/keyclient/v/stable.png)](https://packagist.org/packages/eo/keyclient)

KeyClient library for PHP 5.3+

## Installing

### Using Composer

To add PHP-KeyClient as a local, per-project dependency to your project, simply add a dependency on eo/keyclient to your project's composer.json file. Here is a minimal example of a composer.json file that just defines a development-time dependency on the latest version of the library:

```
{
    "require": {
        "eo/keyclient": "dev-master"
    }
}
```

## Usage Example

```
<?php

use Eo\KeyClient\Client;
use Eo\KeyClient\Payment\PaymentRequest;
use Eo\KeyClient\Notification\RedirectNotification;

$client   = new Client('YOUR-ALIAS', 'YOUR-SECRET');
$payment  = new PaymentRequest(5000, 'EUR', 'UNIQUE-ID', 'http://example.com/canceled');
$redirect = new RedirectNotification('http://example.com/completed');
$payment->addNotification($redirect);

$url = $client->createPaymentUrl($payment);

// Redirect to payment url
header( "Location: $url" );
```

## Requirements
* PHP 5.3+
* [zip](http://php.net/manual/en/book.zip.php)
* [OpenSSL](http://www.php.net/manual/en/book.openssl.php)

## Running Tests
Before submitting a patch for inclusion, you need to run the test suite to check that you have not broken anything.

To run the test suite, install PHPUnit 3.7 (or later) first.

### Dependencies
To run the entire test suite, including tests that depend on external dependencies, php-keyclient needs to be able to autoload them. By default, they are autoloaded from vendor/ under the main root directory (see vendor/autoload.php).

To install them all, use [Composer](http://getcomposer.org):

Step 1: Get [Composer](http://getcomposer.org)
```
curl -s http://getcomposer.org/installer | php
```
Make sure you download composer.phar in the same folder where the composer.json file is located.

Step 2: Install vendors
```
php composer.phar --dev install
```

> Note that the script takes some time to finish.

### Running
First, install the vendors (see above).

Then, run the test suite from the package root directory with the following command:
```
phpunit
```

The output should display OK. If not, you need to figure out what's going on and if the tests are broken because of your modifications.

## Reporting an issue or a feature request
Issues and feature requests related to this library are tracked in the Github issue tracker: https://github.com/eymengunay/php-keyclient/issues
