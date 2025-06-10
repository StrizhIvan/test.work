<?php 
require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__."/config/config.php");
require_once(__DIR__."/config/database.php");
require_once(__DIR__."/config/routes.php");

use App\Application;

$app = new Application($config);
$app->run();