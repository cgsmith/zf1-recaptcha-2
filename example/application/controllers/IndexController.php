<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Contact();

        if($request->isPost() && $form->isValid($_POST)) {
            $values = $form->getValues();
            unset($values['g-recaptcha-response']);

            $this->view->values = $values;
        }

        $this->view->form = $form;
    }
}
