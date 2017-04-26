<?php

namespace Seostat;

class Autoloader
{
	/**
     * @var экземпляр класса
     */
    private static $loader;
    
    /**
     * Регистрация подключенных файлов
     *
     * @return object
     */
    public static function register()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }
        spl_autoload_register(array(self, 'autoload'), true, true);
        self::$loader = $loader = new self;
        
        return $loader;
    }
    
    /**
     * Автоподключение файлов
     *
     * @param  $class подключаемый класс
     * @throws \ErrorException
     */
    public static function autoload($class)
	{
		$path = dirname(__FILE__) . '/../' . $class . ".php";
	    if (!is_file($path)) {
	       throw new \ErrorException("Ошибка при подключении файла.");
	    } else {
	       require_once $path;
           return;
	    }
	}
}
Autoloader::register();
?>