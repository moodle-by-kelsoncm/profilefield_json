Uso
===

Editar um documento
-------------------

Na página de edição do perfil (e na de cadastro, se o campo aparece lá), o campo JSON abre o editor visual:

* **Árvore:** expanda objetos e listas, acrescente, duplique, mova ou remova itens e mude o tipo de um valor pelo menu de cada item.
* **Formulário:** edite só os valores, mantendo a estrutura.
* **Texto:** edite o JSON como texto, com botões para formatar ou compactar.
* **Visualização:** árvore só de leitura.

Cada alteração é gravada no campo do formulário. Se o texto não for JSON válido, uma mensagem abaixo do editor mostra o erro do parser, e o formulário só salva depois da correção.

Sem JavaScript, ou se o editor não iniciar, o campo é um textarea simples em fonte monoespaçada, e as mesmas checagens do servidor valem.

Exibição
--------

No perfil do usuário, o documento aparece formatado num bloco de código com rolagem. O conteúdo sempre é escapado: HTML dentro das strings aparece como texto.

.. figure:: img/profile.png
   :alt: Perfil de um usuário mostrando o campo JSON como um bloco de código formatado.
   :width: 100%

   O campo JSON no perfil do usuário.

Web services e upload de usuários
---------------------------------

O campo fica disponível para web services e para o upload de usuários (coluna ``profile_field_<nome curto>``), como qualquer campo de perfil. Esses caminhos não passam pela validação do formulário, então o próprio campo confere o valor: um valor válido é gravado na forma canônica, e um inválido é ignorado, mantendo o valor já gravado.
