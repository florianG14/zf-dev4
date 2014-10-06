<?php

echo 'index.php (index principal)';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(dirname(__DIR__)));
define('SRC_PATH', ROOT_PATH . DS . 'src');
define('PUBLIC_PATH', SRC_PATH . DS . 'public');
define('APPLICATION_PATH', SRC_PATH . DS . 'application');
define('CONFIG_PATH', APPLICATION_PATH . DS . 'configs');

require_once ROOT_PATH . DS . 'vendor' . DS . 'autoload.php';

//$application = new Zend_Application('development', CONFIG_PATH . DS . 'application.ini');
// si la variable d'environnement est présente alors tu la prend sinon c'est un environnement production.
$application = new Zend_Application(getenv('APPLICATION_ENV') ?: 'production', CONFIG_PATH . DS . 'application.ini');
$application->bootstrap();
$application->run();
