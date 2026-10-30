Installation
============

Requirements
------------

* Moodle 4.5 LTS or 5.3 LTS.
* PHP supported by your Moodle version.

From a ZIP file
---------------

1. Download ``profilefield_json-<version>.zip`` from the `releases <https://github.com/moodle-by-kelsoncm/profilefield_json/releases>`_.
2. Go to *Site administration > Plugins > Install plugins*, upload the ZIP and follow the steps.
3. Finish the upgrade at *Site administration > Notifications*.

From the source code
--------------------

Copy the repository to ``user/profile/field/json`` (``public/user/profile/field/json`` on Moodle 5.1 and later) and visit *Site administration > Notifications*:

.. code-block:: bash

   git clone https://github.com/moodle-by-kelsoncm/profilefield_json.git public/user/profile/field/json

Languages
---------

The package ships the English strings only. Other languages, including Brazilian Portuguese, come from the Moodle translation tool (AMOS) through the language packs.

Third-party code
----------------

The visual editor is `JSON Editor <https://github.com/josdejong/jsoneditor>`_ 10.4.3 by Jos de Jong (Apache License 2.0), in its minimalist build: no code mode and no schema validator. It is listed in ``thirdpartylibs.xml``.
