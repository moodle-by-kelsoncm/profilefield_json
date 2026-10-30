# Changelog

## 1.1.0 - 2026-10-30

Rewrite of the field (the previous `field.class.php` was a copy of a CPF field and did not work as a JSON field).

### Added
- JSON validation on the server (syntax, nesting depth and a maximum size per field, 64 KB by default) with the parser error shown on the form.
- Canonical storage: pretty-printed JSON, with `<`, `>` and `&` escaped inside strings.
- Visual editor: [JSON Editor](https://github.com/josdejong/jsoneditor) 10.4.3 (full build, Apache-2.0) with tree, code (syntax highlighting with Ace), form and view modes; the textarea stays as a fallback.
- Display of the document pretty-printed with syntax highlighting on the profile, every token escaped (`profilefield_json/display` template).
- Values from the user upload and web services, which skip the form validation, are ignored when invalid.
- Privacy API provider (export and delete of the documents).
- PHPUnit tests, CI with moodle-plugin-ci (Moodle 4.5 and 5.3, PostgreSQL and MariaDB), documentation in English and Brazilian Portuguese, release by draft and verification.

### Changed
- Requires Moodle 4.5 LTS; supports 4.5 LTS and 5.3 LTS. Maturity: beta.
- Licence changed from MIT to GNU GPL v3 or later.
- Only English strings are shipped; other languages come through AMOS.

## 1.0.001 - 2023-08-08

- First alpha, not functional as a JSON field.
