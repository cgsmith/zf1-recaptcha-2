<?php
/**
 * @author Joachim Justh
 */

class Application_Form_Contact extends Zend_Form
{
    public function init()
    {
        $this->addPrefixPath('Cgsmith\\Form\\Element', APPLICATION_PATH . '/../vendor/cgsmith/zf1-recaptcha-2/src/Cgsmith/Form/Element', Zend_Form::ELEMENT);
        $this->addElementPrefixPath('Cgsmith\\Validate\\', APPLICATION_PATH . '/../vendor/cgsmith/zf1-recaptcha-2/src/Cgsmith/Validate/', Zend_Form_Element::VALIDATE);

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

        $this->addElement('recaptcha','g-recaptcha-response', [
            'siteKey'   => Zend_Registry::get('application')->recaptcha->sitekey,
            'secretKey' => Zend_Registry::get('application')->recaptcha->secretkey,
        ]);

        $this->addElement('submit','submit',[
            'ignore'    => true,
            'label'     => 'Send',
        ]);
    }
}
