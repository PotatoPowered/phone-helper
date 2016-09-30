<?php
/**
 * Phone Helper (https://github.com/PotatoPowered/phone-helper)
 *
 * Licensed under The MIT License
 * For full copyrgiht and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      Blake Sutton <blake@potatopowered.net>
 * @copyright   Copyright (c) Potato Powered Software
 * @link        http://potatopowered.net
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace PhoneHelper\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use PhoneHelper\View\Helper\PhoneHelper;

/**
 * PhoneHelper Test Class
 *
 * This class contains the main tests for the PhoneHelper Class.
 */
class ProgressHelperTest extends TestCase
{
    /**
     * Setup the application so that we can run the tests.
     *
     * The setup involves initializing a new CakePHP view and using that to
     * get a copy of the PhoneHelper.
     */
    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->Phone = new PhoneHelper($View);
    }

    /**
     * Run the plugin tests
     *
     * This function runs a few tests to check if 7 and 10 digit phone number
     * prettifying is working correctly.
     */
    public function testPhoneFormat()
    {
        $tenDigit = $this->Phone->format('1234567890');
        $sevenDigit = $this->Phone->format('1234567');
        $original = $this->Phone->format('12345678901');

        $this->assertEquals('(123) 456-7890', $tenDigit);
        $this->assertEquals('123-4567', $sevenDigit);
        $this->assertEquals('12345678901', $original);
    }

    /**
     * Run the plugin phone link tests
     *
     * This function runs a few tests to check that the phone links work correctly
     */
    public function testBuildPhoneUrl()
    {
        $number = '123-456-7890';
        $number2 = '(123) 456-7890';
        $expected = 'tel:+1234567890';

        $this->assertEquals($expected, $this->Phone->buildUrl($number));
        $this->assertEquals($expected, $this->Phone->buildUrl($number2));
    }

    /**
     * Run the plugin phone link tests
     *
     * This function runs a few tests to check that the phone links work correctly
     */
    public function testPhoneLink()
    {
        $title = "phone";
        $number = "123-456-7890";
        $phoneLink = $this->Phone->link($number);
        $phoneLinkWithTitle = $this->Phone->link($title, $number);

        $this->assertEquals('<a href="tel:+1234567890">123-456-7890</a>', $phoneLink);
        $this->assertEquals('<a href="tel:+1234567890">phone</a>', $phoneLinkWithTitle);
    }
}
