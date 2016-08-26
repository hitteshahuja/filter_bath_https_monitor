<?php
defined('MOODLE_INTERNAL') || die;
if ($ADMIN->fulltree) {
    //Text message
    $settings->add(new admin_setting_confightmleditor('filter_bath_https_monitor/https_message',
        get_string('https_message_label', 'filter_bath_https_monitor'),
        get_string('https_message_desc', 'filter_bath_https_monitor'), 'Make sure embedded content on this site is HTTPS'));
    //Types
    $types = ['warning' => 'warning', 'info' => 'info', 'danger' => 'danger', 'default' => 'default', 'primary' => 'primary', 'success' => 'success'];
    $settings->add(new admin_setting_configselect('filter_bath_https_monitor/https_message_type',
        get_string('https_message_type_label', 'filter_bath_https_monitor'),
        get_string('https_message_type_desc', 'filter_bath_https_monitor'), 'primary', $types));
    $positions = ['top', 'bottom'];
    $settings->add(new admin_setting_configselect('filter_bath_https_monitor/https_message_position',
        get_string('https_message_position_label', 'filter_bath_https_monitor'),
        get_string('https_message_position_desc', 'filter_bath_https_monitor'), 'top', $positions));
}
