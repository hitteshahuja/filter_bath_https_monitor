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
 * https_monitor filter settings
 *
 * @package    filter
 * @subpackage bath_https_monitor
 * @copyright  2016 Hittesh Ahuja {@link http://bath.ac.uk}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
if ($ADMIN->fulltree) {
    // Text message.
    $settings->add(
        new admin_setting_confightmleditor(
            'filter_bath_https_monitor/https_message',
            get_string('https_message_label', 'filter_bath_https_monitor'),
            get_string('https_message_desc', 'filter_bath_https_monitor'), 'Make sure embedded content on this site is HTTPS'
        )
    );
    // Types.
    $types = ['warning' => 'warning', 'info' => 'info', 'danger' => 'danger',
        'default' => 'default', 'primary' => 'primary', 'success' => 'success'];
    $settings->add(
        new admin_setting_configselect(
            'filter_bath_https_monitor/https_message_type',
            get_string('https_message_type_label', 'filter_bath_https_monitor'),
            get_string('https_message_type_desc', 'filter_bath_https_monitor'), 'primary', $types
        )
    );
    $positions = ['top', 'bottom'];
    $settings->add(
        new admin_setting_configselect(
            'filter_bath_https_monitor/https_message_position',
            get_string('https_message_position_label', 'filter_bath_https_monitor'),
            get_string('https_message_position_desc', 'filter_bath_https_monitor'), 'top', $positions
        )
    );
}
