<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\Router;
use STORE\CORE\Template;
use STORE\CORE\Language;
use STORE\CORE\Registry;

abstract class AbstractController
{

    protected $_controller;
    protected $_action;
    protected $_params;

    protected $_template;
    protected $_registry; // Registry all features
    protected $_data = [];
    protected $_head_data = [];


    public function __get($name)
    {
        return isset($this->_registry->$name) ? $this->_registry->$name : "";
    }

    public function set_Controller_Action_Params($controller,$action,array $params){
        $this->_controller  = $controller;
        $this->_action      = $action;
        $this->_params      = $params;
    }

    public function set_Template(Template $template){
        $this->_template = $template;
    }

    public function set_Registry(Registry $registry){
        $this->_registry = $registry;
    }

    protected function view(){
        $viewPath = VIEWS_PATH . DS . $this->_controller . DS . $this->_action . ".view.php";
        if(!file_exists($viewPath))
            $viewPath = VIEWS_PATH . DS . Router::NotFoundDir . DS . Router::NotFoundView . ".view.php";
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->_data = array_merge($this->language->getContentDictionary(), $this->_data);
        $this->_head_data = array_merge($this->language->getheadDictionary(), $this->_head_data);
        $this->_template->setView($viewPath);
        $this->_template->setData($this->_data);
        $this->_template->setHeadData($this->_head_data);
        $this->_template->set_Registry($this->_registry);
        $this->_template->RenderApplication();     
    }
}