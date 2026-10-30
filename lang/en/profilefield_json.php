<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Strings for the JSON user profile field.
 *
 * @package    profilefield_json
 * @copyright  2023 onwards Kelson da Costa Medeiros
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['editorinvalid'] = 'The text is not valid JSON yet: {$a}';
$string['errorinvalidjson'] = 'This is not valid JSON: {$a}';
$string['errormaxsize'] = 'Enter a size between 1 and {$a} KB.';
$string['errortoolarge'] = 'The JSON document is larger than {$a} KB.';
$string['maxsize'] = 'Maximum size (KB)';
$string['maxsize_help'] = 'Largest JSON document a user can save in this field, in kilobytes.';
$string['pluginname'] = 'JSON';
$string['privacy:metadata:profile_field_json:data'] = 'JSON document entered by the user';
$string['privacy:metadata:profile_field_json:dataformat'] = 'The format of the field data';
$string['privacy:metadata:profile_field_json:fieldid'] = 'The ID of the profile field';
$string['privacy:metadata:profile_field_json:tableexplanation'] = 'Additional profile data';
$string['privacy:metadata:profile_field_json:userid'] = 'The ID of the user whose data is stored by the JSON user profile field';
