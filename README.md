# Defacto_FixFormKeyException

Prevent uncaught exceptions for ajax calls.

The two routes `/checkout/cart/ajaxUpdate` and `/checkout/cart/ajaxDelete` both require a
valid form_key. If the validation check fails an exception is thrown which is uncaught,
thus showing the customer the report page (and potentially triggering an annoying e-mail
to your developers).

Since the ajax actions already support error responses in the json object, we added
an event observer to detect an invalid form_key and return a json object instead.

Pull requests welcome.

developers@de-facto.com
