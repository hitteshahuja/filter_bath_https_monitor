<?php

class filter_bath_https_monitor extends filter_mediaplugin
{

    public function filter($text, array $options = array()) {
        global $CFG, $PAGE;
        $https_warning_label = "<p class='label label-warning'>naughty ! naughty ! you need to it be https</p>";
        $newtext = $text;
        if (!is_string($text) or empty($text)) {
            // non string data can not be filtered anyway
            return $text;
        }
        $re1 = "~<iframe[^>]+>.*?</iframe>~i";
        $re2 = "~<embed[^>]+>.*?</embed>~i";
        //Dont bother if the site is not https to begin with
        $is_https = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? true : false;
        if (!$is_https) {
            //return $text;
        }
        if (preg_match($re, $text)) {
            if (stripos($text, "https://") === false) {
                //echo "naughty ! naughty ! you need to it be https";
                $newtext = $https_warning_label . $text;
            }
        }
        return $newtext;
    }

    protected function find_https_links() {

    }
}