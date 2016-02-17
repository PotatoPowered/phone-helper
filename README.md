# Phone Helper
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md) 
[![Travis](https://img.shields.io/travis/PotatoPowered/phone-helper.svg?style=flat-square)](https://travis-ci.org/PotatoPowered/phone-helper/builds) 
[![Codecov](https://img.shields.io/codecov/c/github/PotatoPowered/phone-helper.svg?style=flat-square)](https://codecov.io/github/PotatoPowered/phone-helper) 
[![Scrutinizer](https://img.shields.io/scrutinizer/g/PotatoPowered/phone-helper.svg?style=flat-square)](https://scrutinizer-ci.com/g/PotatoPowered/phone-helper/)

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
Add the plugin load command to `config/bootstrap.php`
```
Plugin::load('phone-helper');
```
Add the helper to the initialize function of the controller you need it on or in the AppController
to have it accessable in all controllers.
```
'Number' => [
    'className' => 'potatopowered.Phone'
]
```

## Usage

To use the phone number formatter you must have the helper loaded in your controller. 
Once loaded in the controller as shown above you can call the number helper's `phone($number)`
function.
```
// (123) 456-789
$this->Number->phone('1234567890');

// 456-7890
$this->Number->phone('4567890');
```