<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

defined('SERP_ROOT') || define('SERP_ROOT', dirname(dirname(__FILE__)));

// Set configuration array
$configuration = require SERP_ROOT . '/config/application.config.php';

// Setup autoloading
include SERP_ROOT . '/vendor/Zend/Loader/AutoloaderFactory.php';
include SERP_ROOT . '/vendor/Zend/Loader/StandardAutoloader.php';

Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => $configuration['autoloader']
));

// Run the application!
Zend\Mvc\Application::init($configuration)->run();
