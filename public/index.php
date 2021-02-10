<?php
!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : "";
session_start();
use STORE\controllers\abstractcontroller;
use STORE\CORE\DATABASE\DBHandler;
use STORE\CORE\Language;
use STORE\CORE\Router;
use STORE\CORE\Template;

require_once (".." . DS . 'app' . DS . 'config' . DS . 'config.php');
require_once (APP_PATH . DS . 'core' . DS . 'autoloading.php');
$template_parts = require_once (".." . DS . 'app' . DS . 'config' . DS . 'templateconfig.php');
$db = new DBHandler();

if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = LANGUAGE_DEFAULT;
}
$language = new Language();
$template = new Template($template_parts);
$con = $db->PDOconn;
$run = new Router($template,$language);
$run->dispatch();
?>