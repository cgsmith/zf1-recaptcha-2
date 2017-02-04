<?php
namespace Cgsmith\Form\Element;

/**
 * Class Recaptcha
 * Renders a div for google recaptcha to allow for use of the Google Recaptcha API
 *
 * @package Cgsmith
 * @license MIT
 * @author  Chris Smith
 */
class Recaptcha extends \Zend_Form_Element
{
    /** @var string specify formRecaptcha helper */
    public $helper = 'formRecaptcha';

    /** @var string siteKey for Google Recaptcha */
    protected $_siteKey = '';

    /** @var string secretKey for Google Recaptcha */
    protected $_secretKey = '';

    /**
     * Constructor for element and adds validator
     *
     * @param array|string|Zend_Config $spec
     * @param array $options
     *
     * @throws \Zend_Exception
     * @throws \Zend_Form_Exception
     */
    public function __construct($spec = null, $options = null) {
        $options = $this->_setKeysFromConfig($options);
        $spec = $this->_setDefaultSpec($spec);
        if (empty($options['siteKey']) || empty($options['secretKey'])) {
            throw new \Zend_Exception('Site key and secret key must be specified.');
        }
        $this->_siteKey = trim($options['siteKey']); // trim the white space if there is any just to be sure
        $this->_secretKey = trim($options['secretKey']); // trim the white space if there is any just to be sure
        $this->addValidator('Recaptcha', false, ['secretKey' => $this->_secretKey]);
        $this->setAllowEmpty(false);
        parent::__construct($spec, $options);
    }

    public function init() {
        $this->addPrefixPath(
            'Cgsmith\\Validate\\',
            APPLICATION_PATH . '/../vendor/cgsmith/zf1-recaptcha-2/src/Cgsmith/Validate/',
            \Zend_Form_Element::VALIDATE
        );
    }

    /**
     * @param array $options
     *
     * @return array
     */
    private function _setKeysFromConfig($options) {
        $params = \Zend_Registry::get('recaptcha');
        if (!empty($params['sitekey'])) {
            $options['siteKey'] = $params['sitekey'];
        }
        if (!empty($params['secretkey'])) {
            $options['secretKey'] = $params['secretkey'];
        }
        return $options;
    }

    /**
     * @param string $spec
     *
     * @return string
     */
    private function _setDefaultSpec($spec) {
        if (empty($spec)) {
            $spec = 'g-recaptcha-response';
        }
        return $spec;
    }
}
