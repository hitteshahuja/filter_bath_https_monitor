<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *  Filter for warning users of non-https content on an https site
 *
 * @package    filter
 * @subpackage bath_https_monitor
 * @copyright  2016 Hittesh Ahuja (University of Bath) {@link moodle.bath.ac.uk}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
/**
 * Class filter_bath_https_monitor
 */
class filter_bath_https_monitor extends filter_mediaplugin
{
    /**
     * Default message if not set by the admin
     */
    const MESSAGE = 'Make sure embedded content on this site is HTTPS';

    /**
     * @param $text
     * @param array $options
     * @return string
     */
    public function filter($text, array $options = array()) {
        /*if (!is_https()) {
            return $text;
        }*/
        $message = get_config('filter_bath_https_monitor', 'https_message');
        $bslabel = get_config('filter_bath_https_monitor', 'https_message_type');
        $position = get_config('filter_bath_https_monitor', 'https_message_position');
        if ($message == '') {
            $httpswarninglabel = "<p class='label label-$bslabel'>" . self::MESSAGE . "</p>";
        } else {
            $httpswarninglabel = "<p class='label label-$bslabel'>" . $message . "</p>";
        }
        $newtext = $text;
        if (!is_string($text) or empty($text)) {
            // Non string data can not be filtered anyway.
            return $text;
        }
        $re1 = "~<iframe[^>]+>.*?</iframe>~i";
        $re2 = "~<embed[^>]+>.*?</embed>~i";
        // Dont bother if the site is not https to begin with.
        if (preg_match($re1, $text) || preg_match($re2, $text)) {
            if (stripos($text, "https://") === false) {
                if ($position == 0) {
                    $newtext = $httpswarninglabel . $text;
                } else {
                    $newtext = $text . $httpswarninglabel;

                }

            }
        }
        return $newtext;
    }
}