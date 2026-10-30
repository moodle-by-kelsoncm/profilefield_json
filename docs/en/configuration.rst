Configuration
=============

Create a JSON field
-------------------

1. Go to *Site administration > Users > Accounts > User profile fields*.
2. In *Create a new profile field*, choose **JSON**.
3. Fill in the common settings (short name, name, description, required, locked, unique, signup, visibility).
4. Set the JSON-specific settings and save.

.. figure:: img/settings.png
   :alt: Settings of a JSON profile field: maximum size and default value.
   :width: 100%

   JSON-specific settings.

JSON-specific settings
----------------------

* **Maximum size (KB):** largest document a user can save in the field, from 1 to 1024 KB. Default: 64 KB.
* **Default value:** optional JSON document used for new users. It must be valid JSON and is stored in canonical form.

How values are stored
---------------------

Every value is checked on the server before it is saved:

* it must be valid JSON (objects, arrays, strings, numbers, booleans or ``null``), with at most 64 levels of nesting;
* it must fit in the maximum size of the field.

Accepted values are re-encoded: pretty-printed with four spaces, Unicode kept as text, and ``<``, ``>`` and ``&`` escaped inside strings (``<``, ``>``, ``&``). An empty value means "no data".

Privacy
-------

The documents are personal data of the user. They are listed in the plugin's privacy metadata, exported with the user's data and deleted when the user's data is deleted.
