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

namespace profilefield_json;

/**
 * Tests for saving, validating and displaying JSON profile fields.
 *
 * @package    profilefield_json
 * @category   test
 * @copyright  2023 onwards Kelson da Costa Medeiros
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \profile_field_json
 * @covers     \profile_define_json
 */
final class field_test extends \advanced_testcase {
    /** @var \stdClass Profile field definition. */
    private \stdClass $field;

    /**
     * Create a JSON profile field limited to 1 KB.
     */
    protected function setUp(): void {
        global $CFG;
        parent::setUp();
        require_once($CFG->dirroot . '/user/profile/lib.php');
        $this->resetAfterTest();
        $this->field = $this->getDataGenerator()->create_custom_profile_field([
            'datatype' => 'json',
            'shortname' => 'meta',
            'name' => 'Metadata',
            'param1' => 1,
        ]);
    }

    /**
     * A valid document is stored pretty-printed with HTML characters escaped.
     */
    public function test_save_stores_canonical_json(): void {
        global $DB;
        $user = $this->getDataGenerator()->create_user();

        profile_save_data((object)['id' => $user->id, 'profile_field_meta' => '{"b":[1,2],"a":"<script>"}']);

        $stored = $DB->get_field('user_info_data', 'data', ['userid' => $user->id, 'fieldid' => $this->field->id]);
        $this->assertSame("{\n    \"b\": [\n        1,\n        2\n    ],\n    \"a\": \"\\u003Cscript\\u003E\"\n}", $stored);
    }

    /**
     * Invalid or too large documents are refused by the form validation.
     */
    public function test_validation(): void {
        $user = $this->getDataGenerator()->create_user();

        $errors = profile_validation((object)['id' => $user->id, 'profile_field_meta' => '{"a":'], []);
        $this->assertArrayHasKey('profile_field_meta', $errors);

        $big = json_encode(str_repeat('x', 2000));
        $errors = profile_validation((object)['id' => $user->id, 'profile_field_meta' => $big], []);
        $this->assertArrayHasKey('profile_field_meta', $errors);

        $errors = profile_validation((object)['id' => $user->id, 'profile_field_meta' => '{"a": 1}'], []);
        $this->assertArrayNotHasKey('profile_field_meta', $errors);
    }

    /**
     * Saving without the form (user upload, web services) ignores an invalid value.
     */
    public function test_save_ignores_invalid_json(): void {
        global $DB;
        $user = $this->getDataGenerator()->create_user();
        profile_save_data((object)['id' => $user->id, 'profile_field_meta' => '{"a": 1}']);

        profile_save_data((object)['id' => $user->id, 'profile_field_meta' => 'not json']);
        $this->assertDebuggingCalled();

        $stored = $DB->get_field('user_info_data', 'data', ['userid' => $user->id, 'fieldid' => $this->field->id]);
        $this->assertSame("{\n    \"a\": 1\n}", $stored);
    }

    /**
     * The document is displayed escaped inside a pre element.
     */
    public function test_display(): void {
        $user = $this->getDataGenerator()->create_user();
        profile_save_data((object)['id' => $user->id, 'profile_field_meta' => '{"a":"<b>bold</b>"}']);

        $field = new \profile_field_json($this->field->id, $user->id);
        $html = $field->display_data();

        $this->assertStringContainsString('<pre class="profilefield-json-display">', $html);
        $this->assertStringNotContainsString('<b>', $html);
        $this->assertStringContainsString('&lt;b&gt;bold&lt;/b&gt;', $html);
    }

    /**
     * An empty value displays nothing.
     */
    public function test_display_empty(): void {
        $user = $this->getDataGenerator()->create_user();
        profile_save_data((object)['id' => $user->id, 'profile_field_meta' => '  ']);

        $field = new \profile_field_json($this->field->id, $user->id);
        $this->assertSame('', $field->display_data());
    }
}
