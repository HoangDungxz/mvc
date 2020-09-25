<?php
namespace MVC;
use MVC\Dispatcher;



define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . 'Config/db.php');
require('../vendor/autoload.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();

?>