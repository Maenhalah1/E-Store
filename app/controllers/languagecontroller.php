<?php 
namespace STORE\Controllers;

use STORE\MODELS\AbstractModal;
use STORE\CORE\functions;

class LanguageController extends AbstractController {

    use functions;
    public function defaultAction(){
        if(!isset($_SESSION['lang']) || $_SESSION['lang'] == 'en')
            $_SESSION['lang'] = 'ar';
        else
            $_SESSION['lang'] = 'en';
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}