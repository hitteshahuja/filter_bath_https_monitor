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
        $bsLabel = get_config('filter_bath_https_monitor', 'https_message_type');
        $position = get_config('filter_bath_https_monitor', 'https_message_position');
        if ($message == '') {
            $httpsWarningLabel = "<p class='label label-$bsLabel'>" . self::MESSAGE . "</p>";
        } else {
            $httpsWarningLabel = "<p class='label label-$bsLabel'>" . $message . "</p>";
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
                    $newtext = $httpsWarningLabel . $text;
                } else {
                    $newtext = $text . $httpsWarningLabel;

                }

            }
        }
        return $newtext;
    }
}