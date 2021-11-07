<?php
  @session_start();
date_default_timezone_set('Asia/Dhaka');
/**
 * @package App
 */


// Sabberworm
spl_autoload_register(function($class)
{
    if (strpos($class, 'Sabberworm') !== false) {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
    }
    return false;
});


require_once __DIR__ . '/App/Autoloader.php';

App\Autoloader::register();
