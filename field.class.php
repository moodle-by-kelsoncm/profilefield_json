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
 * JSON user profile field.
 *
 * @package    profilefield_json
 * @copyright  2023 onwards Kelson da Costa Medeiros
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use profilefield_json\local\json_value;

/**
 * A user profile field holding a JSON document, edited with a visual editor.
 *
 * @package    profilefield_json
 * @copyright  2023 onwards Kelson da Costa Medeiros
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_field_json extends profile_field_base {
    /**
     * Add the field to the profile edit form, with the visual editor on top of a textarea.
     *
     * @param moodleform $mform
     */
    public function edit_field_add($mform) {
        global $PAGE;

        $id = 'id_' . $this->inputname;
        $mform->addElement(
            'textarea',
            $this->inputname,
            format_string($this->field->name),
            ['rows' => 10, 'cols' => 60, 'data-profilefield-json-source' => '1', 'spellcheck' => 'false']
        );
        // Read as raw text, like the core textarea field: edit_validate_field() only accepts valid
        // JSON and edit_save_data_preprocess() stores it re-encoded, with HTML characters escaped.
        $mform->setType($this->inputname, PARAM_RAW);

        // Stylesheet of the bundled third-party editor (the plugin's own rules are in styles.css).
        // When the field is locked the element is frozen, there is no textarea and the module does nothing.
        $PAGE->requires->css('/user/profile/field/json/thirdparty/jsoneditor/jsoneditor.min.css');
        $PAGE->requires->js_call_amd('profilefield_json/editor', 'init', [$id]);
    }

    /**
     * Validate the value typed by the user.
     *
     * @param stdClass $usernew
     * @return array Errors by element name.
     */
    public function edit_validate_field($usernew) {
        $errors = parent::edit_validate_field($usernew);
        if (isset($usernew->{$this->inputname})) {
            $error = json_value::validate((string)$usernew->{$this->inputname}, $this->get_max_kb());
            if ($error !== null) {
                $errors[$this->inputname] = $error;
            }
        }
        return $errors;
    }

    /**
     * Save the value, unless it is not valid JSON.
     *
     * The user upload and the web services save profile data without running the form
     * validation; an invalid value coming from them is ignored and the stored value is kept.
     *
     * @param stdClass $usernew
     */
    public function edit_save_data($usernew) {
        if (isset($usernew->{$this->inputname})) {
            $value = $usernew->{$this->inputname};
            if (!is_string($value) || json_value::validate($value, $this->get_max_kb()) !== null) {
                debugging("Invalid JSON ignored for the profile field {$this->field->shortname}.", DEBUG_DEVELOPER);
                return;
            }
        }
        parent::edit_save_data($usernew);
    }

    /**
     * Store the value in canonical form.
     *
     * @param mixed $data
     * @param stdClass $datarecord
     * @return string
     */
    public function edit_save_data_preprocess($data, $datarecord) {
        return json_value::normalise(is_string($data) ? $data : '');
    }

    /**
     * Keep large documents out of the user object.
     *
     * @return bool
     */
    public function is_user_object_data() {
        return false;
    }

    /**
     * Display the document, escaped and pretty-printed.
     *
     * @return string HTML
     */
    public function display_data() {
        global $OUTPUT;

        if ($this->data === null || trim($this->data) === '') {
            return '';
        }
        return $OUTPUT->render_from_template('profilefield_json/display', ['html' => json_value::highlight($this->data)]);
    }

    /**
     * Param type and null property used by web services and data loading.
     *
     * @return array
     */
    public function get_field_properties() {
        // Validated and re-encoded in edit_validate_field() and edit_save_data_preprocess().
        return [PARAM_RAW, NULL_NOT_ALLOWED];
    }

    /**
     * Maximum size of a value, in kilobytes.
     *
     * @return int
     */
    protected function get_max_kb(): int {
        return json_value::max_kb($this->field->param1 ?? null);
    }
}
