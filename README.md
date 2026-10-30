# moodle-profilefield_json

[English](#english) · [Português (Brasil)](#português-brasil)

Documentation / Documentação: <https://moodle-by-kelsoncm.github.io/profilefield_json/>

## English

User profile field that stores a JSON document. Users edit it in a visual tree editor ([JSON Editor](https://github.com/josdejong/jsoneditor)), the server only saves valid JSON within the size set for the field, and the profile shows it escaped and pretty-printed. Supports Moodle 4.5 LTS and 5.3 LTS.

Install: copy this repository to `user/profile/field/json` (`public/user/profile/field/json` on Moodle 5.1+) and visit *Site administration > Notifications*. Then create a field of type **JSON** at *Site administration > Users > Accounts > User profile fields*.

## Português (Brasil)

Campo de perfil de usuário que guarda um documento JSON. O usuário edita num editor visual em árvore ([JSON Editor](https://github.com/josdejong/jsoneditor)), o servidor só grava JSON válido dentro do tamanho definido para o campo, e o perfil mostra o documento escapado e formatado. Suporta Moodle 4.5 LTS e 5.3 LTS.

Instalação: copie este repositório para `user/profile/field/json` (`public/user/profile/field/json` no Moodle 5.1+) e acesse *Administração do site > Notificações*. Depois crie um campo do tipo **JSON** em *Administração do site > Usuários > Contas > Campos de perfil do usuário*.

## Development / Desenvolvimento

- JavaScript sources are in `amd/src`; rebuild `amd/build` with `npx grunt amd --root=public/user/profile/field/json` in a Moodle checkout.
- `thirdparty/jsoneditor` is the third-party JSON Editor 10.4.3 (minimalist build, Apache-2.0), listed in `thirdpartylibs.xml` and loaded by `amd/src/editor.js` through RequireJS.
- CI (`.github/workflows/ci.yml`) runs `moodle-plugin-ci` on Moodle 4.5 and 5.3 with PostgreSQL and MariaDB; run it locally with [`act`](https://github.com/nektos/act) before pushing.

## Support and privacy / Suporte e privacidade

- Issue tracker / Rastreador de issues: <https://github.com/moodle-by-kelsoncm/profilefield_json/issues>
- Privacy / Privacidade: the documents are personal data; they are exported and deleted with the user's data (Privacy API) / os documentos são dados pessoais; são exportados e apagados com os dados do usuário.
- Translations / Traduções: only English is shipped; other languages go through AMOS / o pacote traz só inglês; outros idiomas via AMOS.

## License / Licença

GNU GPL v3 or later. See [LICENSE](LICENSE). Earlier versions (up to 1.0.001) were published under the MIT License.
