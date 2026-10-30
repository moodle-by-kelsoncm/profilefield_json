moodle-profilefield_json
========================

**Um campo de perfil de usuário que guarda um documento JSON, editado num editor visual em árvore e sempre válido.**

.. figure:: img/edit.png
   :alt: Edição do perfil de um usuário: o campo JSON mostra um editor em árvore com objetos, listas e valores.
   :width: 100%

   Edição do perfil: o campo JSON abre um editor em árvore.

* **Dados estruturados no perfil.** Guarde identificadores de integração, preferências ou qualquer dado aninhado num só campo, em vez de vários campos de texto.
* **Editor visual.** Modos árvore, formulário e texto do `JSON Editor <https://github.com/josdejong/jsoneditor>`_, com o textarea simples como alternativa.
* **Sempre válido.** O servidor só grava JSON válido, dentro do tamanho definido para o campo, e guarda numa forma canônica, formatada.
* **Exibição segura.** O documento aparece escapado num bloco de código; HTML dentro das strings nunca é renderizado.

English version: `English <../en/index.html>`_.

.. toctree::
   :maxdepth: 2
   :caption: Conteúdo

   installation
   configuration
   usage

Principais recursos
-------------------

* Novo tipo de campo de perfil **JSON**, criado em *Administração do site > Usuários > Contas > Campos de perfil do usuário*.
* Tamanho máximo por campo (64 KB por padrão, até 1024 KB) e valor padrão validado.
* Validação nos formulários de perfil e de cadastro, com o erro do parser mostrado ao usuário; valores inválidos vindos do upload de usuários ou de web services são ignorados.
* Armazenamento canônico: formatado, com ``<``, ``>`` e ``&`` escapados dentro das strings.
* Privacy API: os documentos são exportados e apagados junto com os dados do usuário.
* **Moodle 4.5 LTS e 5.3 LTS**: testado numa matriz de CI com PostgreSQL e MariaDB.

Links
-----

* Código-fonte e issues: https://github.com/moodle-by-kelsoncm/profilefield_json
