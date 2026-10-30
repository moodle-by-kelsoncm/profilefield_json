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
 * Definition of the JSON user profile field.
 *
 * @package    profilefield_json
 * @copyright  2023 onwards Kelson da Costa Medeiros
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use profilefield_json\local\json_value;

/**
 * Settings of a JSON profile field: default value and maximum size.
 *
 * @package    profilefield_json
 * @copyright  2023 onwards Kelson da Costa Medeiros
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_define_json extends profile_define_base {
    /**
     * Add the field-specific settings to the form.
     *
     * @param moodleform $form
     */
    public function define_form_specific($form) {
        $form->addElement('text', 'param1', get_string('maxsize', 'profilefield_json'), ['size' => 6]);
        $form->setType('param1', PARAM_INT);
        $form->setDefault('param1', json_value::DEFAULT_MAX_KB);
        $form->addHelpButton('param1', 'maxsize', 'profilefield_json');

        $form->addElement(
            'textarea',
            'defaultdata',
            get_string('profiledefaultdata', 'admin'),
            ['rows' => 6, 'cols' => 60, 'data-profilefield-json-source' => '1', 'spellcheck' => 'false']
        );
        // Read as raw text: it is validated as JSON below and stored in canonical form.
        $form->setType('defaultdata', PARAM_RAW);
    }

    /**
     * Validate the field-specific settings.
     *
     * @param stdClass $data
     * @param array $files
     * @return array Errors by element name.
     */
    public function define_validate_specific($data, $files) {
        $errors = [];
        $maxkb = (int)($data->param1 ?? 0);
        if ($maxkb < 1 || $maxkb > json_value::LIMIT_MAX_KB) {
            $errors['param1'] = get_string('errormaxsize', 'profilefield_json', json_value::LIMIT_MAX_KB);
        }
        $error = json_value::validate($data->defaultdata ?? '', json_value::max_kb($maxkb));
        if ($error !== null) {
            $errors['defaultdata'] = $error;
        }
        return $errors;
    }

    /**
     * Store the default value in canonical form.
     *
     * @param stdClass $data
     * @return stdClass
     */
    public function define_save_preprocess($data) {
        $data->defaultdata = json_value::normalise($data->defaultdata ?? '');
        $data->param1 = json_value::max_kb($data->param1 ?? 0);
        return $data;
    }
}
