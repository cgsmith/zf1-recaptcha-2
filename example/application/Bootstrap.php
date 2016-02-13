<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
    }

    protected function _initConfig()
    {
      $config = new Zend_Config($this->getOptions(),true);
      Zend_Registry::set('application',$config);
      return $config;
    }

}
