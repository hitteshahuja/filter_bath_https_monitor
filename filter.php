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
        global $COURSE;
        $re1 = "~<iframe[^>]+>.*?</iframe>~i";
        $re2 = "~<embed[^>]+>.*?</embed>~i";
        $context = context_course::instance($COURSE->id);
        $embedtype = '';
        $match = false;
        $newtext = $text;
        // Dont bother if site is https
        // Dont bother if does not have the right capability
        if (!has_capability('moodle/course:update', $context) || is_https()) {
            return $text;
        }
        if (!is_string($text) or empty($text)) {
            // Non string data can not be filtered anyway.
            return $text;
        }
        $message = get_config('filter_bath_https_monitor', 'https_message');
        $bslabel = get_config('filter_bath_https_monitor', 'https_message_type');
        $position = get_config('filter_bath_https_monitor', 'https_message_position');
        if ($message == '') {
            $httpswarninglabel = "<p class='label label-$bslabel'>" . self::MESSAGE . "</p>";
        } else {
            $httpswarninglabel = "<p class='label label-$bslabel'>" . $message . "</p>";
        }
        if (preg_match($re1, $text)) {
            $embedtype = 'iframe';
            $match = true;
        }
        if (preg_match($re2, $text)) {
            $type = 'embed';
            $match = true;
        }
        if ($match) {
            // Get iframe SRC
            $url = parse_url($this->get_embed_src($text, $embedtype), PHP_URL_SCHEME);
            // Only do the magic if URL is HTTP
            if (stripos($text, "https://") === false && !empty($url) && $url == 'http') {
                if ($position == 0) {
                    $newtext = $httpswarninglabel . $text;
                } else {
                    $newtext = $text . $httpswarninglabel;

                }

            }
        }
        return $newtext;
    }

    /** Return source of the embed code
     * @param $text
     * @return string
     */
    private function get_embed_src($text, $type) {
        $src = '';
        $embedcode = simplexml_load_string($text);
        if ($type == 'iframe') {
            $src = (string)$embedcode->iframe['src'];
        } elseif ($type == 'embed') {
            $src = (string)$embedcode->embed['src'];
        }
        return $src;
    }
}
