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
namespace PhoneHelper\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

/**
 * PhoneHelper Main Class
 *
 * This class extends the NumberHelper built into CakePHP 3.x and adds the ability
 * to parse and prettify a US telephone number.
 */
class PhoneHelper extends Helper
{
    use StringTemplateTrait;

    /**
     * Default config for this class
     *
     * @var array
     */
    protected $_defaultConfig = [
        'templates' => [
            'phone' => '<a href="{{url}}"{{attrs}}>{{content}}</a>'
        ]
    ];

    /**
     * Prettify a phone number.
     *
     * This function can take either a 10 digit or 7 digit phone number and returns
     * a more human readable version.
     *
     * @param int $number The phone number to be prettified
     * @return string The prettified phone number
     */
    public function format($number)
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

    /**
     * Creates an HTML telephone link.
     *
     * If the $url is empty, $title is used instead.
     *
     * ### Options
     *
     * - `escape` Set to false to disable escaping of title and attributes.
     * - `escapeTitle` Set to false to disable escaping of title. Takes precedence
     *   over value of `escape`)
     *
     * @param string $title The content to be wrapped by `<a>` tags.
     * @param string|null $url string The phone number to link to.
     * @param array $options Array of options and HTML attributes.
     * @return string An `<a />` element.
     */
    public function link($title, $url = null, array $options = [])
    {
        $escapeTitle = true;
        if ($url !== null) {
            $url = $this->buildUrl($url);
        } else {
            $url = $this->buildUrl($title);
            $title = htmlspecialchars_decode($title, ENT_QUOTES);
            $title = h(urldecode($title));
            $escapeTitle = false;
        }

        if (isset($options['escapeTitle'])) {
            $escapeTitle = $options['escapeTitle'];
            unset($options['escapeTitle']);
        } elseif (isset($options['escape'])) {
            $escapeTitle = $options['escape'];
        }

        if ($escapeTitle === true) {
            $title = h($title);
        } elseif (is_string($escapeTitle)) {
            $title = htmlentities($title, ENT_QUOTES, $escapeTitle);
        }

        $templater = $this->templater();

        return $templater->format('phone', [
            'url' => $url,
            'attrs' => $templater->formatAttributes($options),
            'content' => $title
        ]);
    }

    /**
     * Builds a telephone link from a passed in string
     *
     * The string passed in can be a number, formatted number, or tel url
     *
     * @param string $url The number or tel url to use in the link
     * @return string rfc3966 formatted tel URL
     */
    public function buildUrl($url)
    {
        $number = preg_replace("/[^0-9]+/", "", $url);

        return "tel:+" . $number;
    }
}
