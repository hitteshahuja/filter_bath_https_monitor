<?php


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
        global $CFG, $PAGE;
        /*if (!is_https()) {
            return $text;
        }*/
        $message = get_config('filter_bath_https_monitor', 'https_message');
        $bs_label = get_config('filter_bath_https_monitor', 'https_message_type');
        $position = get_config('filter_bath_https_monitor', 'https_message_position');
        if ($message == '') {
            $https_warning_label = "<p class='label label-$bs_label'>" . self::MESSAGE . "</p>";
        } else {
            $https_warning_label = "<p class='label label-$bs_label'>" . $message . "</p>";
        }
        $newtext = $text;
        if (!is_string($text) or empty($text)) {
            // non string data can not be filtered anyway
            return $text;
        }
        $re1 = "~<iframe[^>]+>.*?</iframe>~i";
        $re2 = "~<embed[^>]+>.*?</embed>~i";
        //Dont bother if the site is not https to begin with
        if (preg_match($re1, $text) || preg_match($re2, $text)) {
            if (stripos($text, "https://") === false) {
                if ($position == 0) {
                    $newtext = $https_warning_label . $text;
                } else {
                    $newtext = $text . $https_warning_label;

                }

            }
        }
        return $newtext;
    }
}