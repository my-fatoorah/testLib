# MyFatoorah - Library

[![Latest Version](https://img.shields.io/github/release/myfatoorah/library.svg?style=flat-square)](https://github.com/myfatoorah/library/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/myfatoorah/library/master.svg?style=flat-square)](https://travis-ci.org/myfatoorah/library)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/myfatoorah/library.svg?style=flat-square)](https://scrutinizer-ci.com/g/myfatoorah/library/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/myfatoorah/library.svg?style=flat-square)](https://scrutinizer-ci.com/g/myfatoorah/library)
[![Total Downloads](https://img.shields.io/packagist/dt/myfatoorah/library.svg?style=flat-square)](https://packagist.org/packages/myfatoorah/lib-test)


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

The OSL-3.0 License.
