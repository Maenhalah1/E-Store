<?php

namespace STORE\Controllers;


class NotFoundController extends AbstractController
{

    public function defaultAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->view();
    }

    public function noviewAction(){
        $this->view();
    }

}