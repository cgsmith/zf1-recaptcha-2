ZF1 reCAPTCHA2 - Google reCAPTCHA integration
==============================

ZF1 ships with Google reCAPTCHA version 1.  Now that version 2 is available
you will probably want to use an up-to-date element for your Zend Framework installations.

Usage
-----

Install the latest version (1.0.0) and setup your plugins and form abstract with the following information:

```php
<?php
// important view settings that you will have to place
$view->headScript()->appendFile('//www.google.com/recaptcha/api.js'); // pulls in google js api

// setup your helper path
$view->addHelperPath('/src/Cgsmith/View/Helper', 'Cgsmith\\View\\Helper\\'); 

// setup prefix path for form element (form abstract) 
$this->addPrefixPath('Cgsmith\\Form\\Element', '/src/Cgsmith/Form/Element', Zend_Form::ELEMENT);
$this->addElementPrefixPath('Cgsmith\\Validate\\', '/src/Cgsmith/Validate/', Zend_Form_Element::VALIDATE);

```

Below is what you would setup in your form.

```php
<?php

// create your element and pass through your site key and secret key
$this->addElement('Recaptcha', 'g-recaptcha-response', array(
    'siteKey'   => Zend_Registry::get('options')->recaptcha->sitekey,
    'secretKey' => Zend_Registry::get('options')->recaptcha->secretkey,
));

```

After you run `$form->isValid($post)` you will need to run something similar to:

```php
$values = $form->getValues();
unset($values['g-recaptcha-response']);

```

About
=====

Requirements
------------

- ZF1 reCAPTCHA2 works with PHP 5.3 or above.

Submitting bugs and feature requests
------------------------------------

Bugs and feature request are tracked on [GitHub](https://github.com/cgsmith/zf1-recaptcha-2/issues)

Author
------

Chris Smith - <chris@cgsmith.net> - <http://twitter.com/cgsmith105>

License
-------

ZF1 reCAPTCHA2 is licensed under the MIT License - see the `LICENSE` file for details
