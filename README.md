# MyFatoorah - Library

[![Latest Stable Version](http://poser.pugx.org/myfatoorah/lib-test/v)](https://github.com/my-fatoorah/testLib/releases)
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
[![Build Status](https://scrutinizer-ci.com/g/my-fatoorah/testLib/badges/build.png?b=main)](https://scrutinizer-ci.com/g/my-fatoorah/testLib/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/my-fatoorah/testLib/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)
[![Total Downloads](http://poser.pugx.org/myfatoorah/lib-test/downloads)](https://packagist.org/packages/myfatoorah/lib-test)

MyFatoorah Payment Gateway PHP library. It is a PHP library to integrate MyFatoorah APIs with your website.

## Install

Via Composer

``` bash
composer require myfatoorah/library
```

## Usage

### Payment Operations

``` php
$mfObj = new PaymentMyfatoorahApiV2($apiKey, $countryMode, $isTest);
$postFields = [
    'NotificationOption' => 'Lnk',
    'InvoiceValue'       => '50',
    'CustomerName'       => 'fname lname',
];

$data = $mfObj->getInvoiceURL($postFields);

$invoiceId   = $data->InvoiceId;
$paymentLink = $data->InvoiceURL;

echo "Click on <a href='$paymentLink' target='_blank'>$paymentLink</a> to pay with invoiceID $invoiceId.";

```

### Shipping Operations

``` php
$mfObj = new ShippingMyfatoorahApiV2($apiKey, $countryMode, $isTest);
$json  = $mfObj->getShippingCountries();

echo 'Country code: ' . $json->Data[0]->CountryCode;
echo 'Country name: ' . $json->Data[0]->CountryName;
```

### General Operations

``` php
$phone = MyfatoorahApiV2::getPhone('+2 01234567890');

echo 'Phone code: ' . $phone[0];
echo 'Phone number: ' . $phone[1];

```

## Testing

``` bash
phpunit
```

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](https://github.com/myfatoorah/:package_name/contributors)

## License

The GPL-3.0-only License.
