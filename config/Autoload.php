<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:45
 */
class Autoload
{
    private static $_instance=null;

    public static function charger() {
        if (null!==self::$_instance) {
            throw new RuntimeException(sprintf('%s is already started',__CLASS__));
        }
        self::$_instance=new self();
    }

    function __autoload($class) {
        $dir = array('models/','./','config/','controller/','DAL/','views/');
        $filename = $class.'.php';
        foreach ($dir as $d) {
            $file = __DIR__.'/../'.$d.$filename;
            if (file_exists($file)) {
                require($file);
            }
        }
    }
}