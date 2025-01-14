<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc67ee1ae3769643d4e6bbadfc6e50eed
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitc67ee1ae3769643d4e6bbadfc6e50eed', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc67ee1ae3769643d4e6bbadfc6e50eed', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc67ee1ae3769643d4e6bbadfc6e50eed::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
