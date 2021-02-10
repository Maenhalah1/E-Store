<?php

namespace STORE\Controllers;


class NotFoundController extends AbstractController
{

    public function defaultAction(){
        $this->view();
    }

    public function noviewAction(){
        $this->view();
    }

}