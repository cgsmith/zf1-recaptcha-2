<?php
namespace Cgsmith\View\Helper;

/**
 * Class FormRecaptcha
 *
 * @package Cgsmith
 * @license MIT
 * @author  Chris Smith
 */
class FormRecaptcha extends \Zend_View_Helper_FormElement
{
    /**
     * For google recaptcha div to render properly
     *
     * @param $name
     * @param null $value
     * @param null $attribs
     * @param null $options
     * @param string $listsep
     * @return string
     * @throws \Zend_Exception
     */
    public function formRecaptcha($name, $value = null, $attribs = null, $options = null, $listsep = '')
    {
        if (!isset($attribs['siteKey']) || !isset($attribs['secretKey'])) {
            throw new \Zend_Exception('Site key is not set in the view helper');
        }
        return '<div class="g-recaptcha" data-sitekey="' . $attribs['siteKey'] . '"></div>';
    }

}
