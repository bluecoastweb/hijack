hijack
======

Inject arbitrary Javascript into the ExpressionEngine control panel.

**Hook** `cp_js_end`

Settings
--------

1. Javascript content to be injected into every page of the Control Panel:

For example, supposing you'd like to hide the `URL Title` field in the `Edit Entry` page:

    $('form#publishForm div#hold_field_url_title').hide();

Or perhaps you'd like to prevent the ability to delete multiple entries in the `Edit Channel Entries` page:

    $('form#entries_form div.tableSubmit select').find('option[value="delete"]').remove();

Or maybe you'd just like to see yourself in a different light:

    $('div#activeUser a.userName').html('Your Eminence');

2. Wrap Javascript content in jQuery document ready function:

The default is `Yes`, and you *probably* don't want to change it.
