<?php

namespace STORE\CORE;

class Router
{
    const ControllersNameSpace  = "STORE\Controllers\\";
    const NotFoundController    = "NotFoundController";
    const NotFoundDir           = "notfound";
    const NotFoundView          = "default";

    private $_controller="index";
    private $_action="default";
    private $_params = array();

    private $_template;
    private $_registry;

    public function __construct(Template $template ,Registry $registry) {
        $this->_parseUrl();
        $this->_template = $template;
        $this->_registry = $registry;
    }
    private function _parseUrl(){
        $url_parts = trim($_SERVER['REQUEST_URI'],"/");
        $url_parts = parse_url($url_parts, PHP_URL_PATH);
        $url_parts = explode("/", $url_parts, 3);
        if(isset($url_parts[0]) && !empty($url_parts[0])){
            $this->_controller = $url_parts[0];
        }
        if(isset($url_parts[1]) && !empty($url_parts[1])){
            $this->_action = $url_parts[1];
        }
        if(isset($url_parts[2]) && !empty($url_parts[2])){
//            $url_parts = strtolower($url_parts[2]);
            $this->_params = explode("/", $url_parts[2]);
        }
    }

    public function dispatch(){
        $controllerClass = self::ControllersNameSpace . ucfirst($this->_controller) . "Controller";
        if(!class_exists($controllerClass)){
            $this->_controller = "notfound";
            $this->_action = "default";
            $controllerClass = self::ControllersNameSpace . self::NotFoundController;
        }
        $controller = new $controllerClass();
        $this->_action      = strtolower($this->_action);
        $this->_controller  = strtolower($this->_controller);

        if(!method_exists($controller, $this->_action . "Action")){
            $this->_action = "default";
        }

        $actionName = $this->_action . "Action";
        $controller->set_Controller_Action_Params($this->_controller, $this->_action, $this->_params);
        $controller->set_Registry($this->_registry);
        $controller->set_Template($this->_template);
        $controller->$actionName();
        //var_dump($controller);
    }


}