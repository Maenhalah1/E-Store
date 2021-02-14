<?php
namespace STORE\CORE;
use STORE\CORE\functions;

class Template {

    use functions;
    private $_template_parts;
    private $_view_path;
    private $_data;
    private $_head_data=[];

    private $controller;
    private $_registry;


    public function __construct(array $templateparts)
    {
        $this->_template_parts = $templateparts;
    }

    public function __get($name)
    {
        return isset($this->_registry->$name) ? $this->_registry->$name : "";
    }

    public function setView($viewpath) {
        $this->_view_path = $viewpath;
    }

    public function setData($data) {
        $this->_data = $data;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setHeadData($headdata) {
        $this->_head_data = $headdata;
    }

    public function set_Registry($registry){
        $this->_registry = $registry;
    }
    

    private function RenderStartTemplateHeader(){
        if(!empty($this->_head_data)) extract($this->_head_data);
        require_once(TEMPLATE_PATH . DS . "starttemplateheader.php");
    }

    private function RenderResrouseTemplateHeader(){       
        $output = '';
        if(isset($this->_template_parts['HeaderResourses'])){
            $parts = $this->_template_parts['HeaderResourses'];
            if(isset($parts['CSS']) && !empty($parts['CSS'])){
                $cssparts = $parts['CSS'];
                foreach($cssparts as $name => $path){
                    $output .= "<link rel='stylesheet' " . "href='" . $path . "'>";
                }
            }
            if(isset($parts['JS']) && !empty($parts['JS'])){
                $jsparts = $parts['JS'];
                foreach($jsparts as $name => $path){
                    $output .= "<script src='" . $path . "'></script>";
                }
            }
        }
        echo $output;
    }

    private function RenderEndTemplateHeader(){
        require_once(TEMPLATE_PATH . DS . "endtemplateheader.php");
    }

    private function RenderContent(){
        if(isset($this->_template_parts['content'])){
            extract($this->_data);
            $parts = $this->_template_parts['content'];
            foreach($parts as $partname => $filepath){
                if($partname == "view")
                    require_once $this->_view_path;
                else
                    require_once $filepath;
            }
        }else{
            trigger_error("Your Dont Set the content to be render the application", E_USER_WARNING);
        }
    }

    private function RenderResourseTemplateFooter(){
        $output = '';
        if(isset($this->_template_parts['FooterResourses'])){
            $parts = $this->_template_parts['FooterResourses'];
            if(isset($parts['JS']) && !empty($parts['JS'])){
                $jsparts = $parts['JS'];
                foreach($jsparts as $name => $path){
                    $output .= "<script src='" . $path . "'></script>";
                }
            }
        }
        echo $output;
    }

    private function RenderTemplateFooter(){
        require_once(TEMPLATE_PATH . DS . "templatefooter.php");
    }

    public function RenderApplication(){
        $this->RenderStartTemplateHeader();
        $this->RenderResrouseTemplateHeader();
        $this->RenderEndTemplateHeader();
        $this->RenderContent();
        $this->RenderResourseTemplateFooter();
        $this->RenderTemplateFooter();
    }
}