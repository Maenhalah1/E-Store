<?php
ob_start();
!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : "";

use STORE\controllers\abstractcontroller;
use STORE\CORE\DATABASE\DBHandler;
use STORE\CORE\Language;
use STORE\CORE\Messenger;
use STORE\CORE\Registry;
use STORE\CORE\Router;
use STORE\CORE\SessionManager;
use STORE\CORE\Template;
require_once (".." . DS . 'app' . DS . 'config' . DS . 'config.php');
require_once (APP_PATH . DS . 'core' . DS . 'autoloading.php');

$session = new SessionManager();
$session->start();
if (!$session->checkFingerprint()){
    $session->endSession();
}

$template_parts = require_once (".." . DS . 'app' . DS . 'config' . DS . 'templateconfig.php');

$db = new DBHandler();
if(!isset($session->lang))
    $session->lang = LANGUAGE_DEFAULT;

$language = new Language();
$Messenger = Messenger::getInstance($session);

$registry = Registry::getInstance();
$registry->session  = $session;
$registry->language = $language;
$registry->masseges = $Messenger;

$template = new Template($template_parts);
$con = $db->PDOconn;
$run = new Router($template, $registry);
$run->dispatch();
ob_flush();
?>