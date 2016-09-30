# Phone Helper
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE) 
[![Travis](https://img.shields.io/travis/PotatoPowered/phone-helper.svg?style=flat-square)](https://travis-ci.org/PotatoPowered/phone-helper/builds) 
[![Codecov](https://img.shields.io/codecov/c/github/PotatoPowered/phone-helper.svg?style=flat-square)](https://codecov.io/github/PotatoPowered/phone-helper) 
[![Scrutinizer](https://img.shields.io/scrutinizer/g/PotatoPowered/phone-helper.svg?style=flat-square)](https://scrutinizer-ci.com/g/PotatoPowered/phone-helper/)
[![Packagist](https://img.shields.io/packagist/dt/potatopowered/phone-helper.svg?style=flat-square)](https://packagist.org/packages/potatopowered/phone-helper)

A phone number formatting helper for CakePHP 3.x

## Description

The phone number helper will extend the [NumberHelper](http://book.cakephp.org/3.0/en/core-libraries/number.html) 
that is already built into CakePHP 3.x. This means that you will be able to use 
all of the number helper functionality with the addition of the phone number 
formatter functions. 

## Installation

```
composer require potatopowered/phone-helper
```
Add the helper to the public helpers variable of the controller you need it on or in the AppController
to have it accessible in all controllers.
```
public $helpers = [
    'Phone' => [
        'className' => 'PhoneHelper.Phone'
    ]
];
```

## Usage

To use the phone number formatter you must have the helper loaded in your controller. 
Once loaded in the controller as shown above you can call the number helper's `format($number)`
function.
```
// (123) 456-789
$this->Phone->format('1234567890');

// 456-7890
$this->Phone->format('4567890');
```
You can also add telephone links in RFC3966 format using the 'link' method
```
// <a href="tel:+1234567890">123-456-7890</a>
$this->Phone->link('123-456-7890');

// <a href="tel:+1234567890">Call Us</a>
$this->Phone->link(h('Call Us'), '1234567890');
```