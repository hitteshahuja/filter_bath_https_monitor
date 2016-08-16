<?php
defined('MOODLE_INTERNAL') || die;
if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext('filter_bath_https_monitor/https_message',
        get_string('https_message_label', 'filter_bath_https_monitor'),
        get_string('https_message_desc', 'filter_bath_https_monitor'), ''));
}
