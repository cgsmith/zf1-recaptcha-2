ZF1 reCAPTCHA2 - Google reCAPTCHA integration
==============================

ZF1 ships with Google reCAPTCHA version 1.  Now that version 2 is available
you will probably want to use an up-to-date element for your Zend Framework installations.

Installation
-----

#### Composer Install

    "require": {
        "cgsmith/zf1-recaptcha-2": "~1.0"
    }


Usage
-----

Install the latest version (1.0.1) and setup your plugins and form abstract with the following information:

* On your application.ini or where you want

```ini
recaptcha.sitekey = "YOUR SITE KEY GIVEN BY GOOGLE"
recaptcha.secretkey = "YOUR SECRET KEY GIVEN BY GOOGLE"
```

* In your bootstrap:

```php
public function _initView()
{
    $view = new Zend_View();

    $view->addHelperPath(
        APPLICATION_PATH . '/../vendor/cgsmith/zf1-recaptcha-2/src/Cgsmith/View/Helper',
        'Cgsmith\\View\\Helper\\'
    );

    Zend_Controller_Action_HelperBroker::addHelper(new Zend_Controller_Action_Helper_ViewRenderer($view));

    return $view;
}

public function _initRecaptcha()
{
    $config = \Zend_Registry::get('application');
    $params = $config->recaptcha->toArray();

    $params['messageTemplates'] = [
        \Cgsmith\Validate\Recaptcha::INVALID_CAPTCHA => 'The captcha was invalid', // set custom/translated message
        \Cgsmith\Validate\Recaptcha::CAPTCHA_EMPTY => 'The captcha must be completed'
    ];

    \Zend_Registry::set('recaptcha', $params);
}
```


* Below is what you would setup in your form.

```php
<?php

// create your element
$this->addElement(new \Cgsmith\Form\Element\Recaptcha());

```

* On your controller, after "validate the post data"

```php
if($form->isValid($_POST)) {
	$values = $form->getValues();
	unset($values['g-recaptcha-response']);
	// Your business logic must be here
}
```

About
=====

Requirements
------------

- ZF1 reCAPTCHA2 works with PHP 5.5 or above.

Submitting bugs and feature requests
------------------------------------

Bugs and feature request are tracked on [GitHub](https://github.com/cgsmith/zf1-recaptcha-2/issues)

Author
------

Chris Smith - <chris@cgsmith.net> - <http://twitter.com/cgsmith105>

License
-------

ZF1 reCAPTCHA2 is licensed under the MIT License - see the `LICENSE` file for details
