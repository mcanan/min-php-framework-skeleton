<?php
date_default_timezone_set('America/Montevideo');
ini_set('display_errors','on');
ini_set('log_errors','on');
$fch=strftime("%Y-%m-%d",time());
ini_set('error_log','errors_'.$fch.'.log');

require './vendor/autoload.php';
require './Security.php';

$app = new \mcanan\framework\Application();
$app->setSecurity(new \mcanan\Security());
$app->loadConfigurationFile('app/conf/conf.php');
$app->init();
?>
