<?php
/**
 * @author Joachim Justh
 */

class Application_Form_Contact extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $this->addElement('hash','csrf',[
           'ignore'     => true,
        ]);

        $this->addElement('text','name', [
            'label'     => 'Your name:',
            'required'  => true,
            'filters'   => ['StringTrim'],
        ]);

        $this->addElement('text','email', [
            'label'     => 'Your email:',
            'required'  => true,
            'filters'   => ['StringTrim'],
            'validators'=> ['EmailAddress'],
        ]);

        $this->addElement('textarea','body', [
            'label'     => 'Your comment:',
            'required'  => true,
            'filters'   => ['StringTrim'],
            'validators'=> [
                [
                  'validator' => 'StringLength',
                  'options'   => [0,255]
                ],
            ],
        ]);

        $this->addElement(new \Cgsmith\Form\Element\Recaptcha());

        $this->addElement('submit','submit',[
            'ignore'    => true,
            'label'     => 'Send',
        ]);
    }
}
