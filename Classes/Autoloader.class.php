<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 ã.
 * Time: 16:00 ÷.
 */

class Autoloader {
    protected static $path = array('Classes', 'Templates');

    public static function autoload($className) {
        foreach(self::$path as $path) {
            $file = "$path/$className.class.php";
            if(file_exists($file)) {
                require_once ($file);
            }
        }
    }
}

spl_autoload_register(array('Autoloader', 'autoload'));