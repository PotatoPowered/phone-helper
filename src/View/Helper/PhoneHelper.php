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
 * @since       1.0
 * @version     1.0
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace PhoneHelper\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\NumberHelper;

/**
 * PhoneHelper Main Class
 *
 * This class extends the NumberHelper built into CakePHP 3.x and adds the ability
 * to parse and prettify a US telephone number.
 */
class PhoneHelper extends NumberHelper
{
    /**
     * Prettify a phone number.
     *
     * This function can take either a 10 digit or 7 digit phone number and returns
     * a more human readable version.
     *
     * @param int $number The phone number to be prettified
     * @return string The prettified phone number
     */
    public function phone($number)
    {
        $number = preg_replace("/[^0-9]/", "", $number);
        if (strlen($number) == 7) {
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $number);
        } elseif (strlen($number) == 10) {
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $number);
        } else {
            return $number;
        }
    }
}
