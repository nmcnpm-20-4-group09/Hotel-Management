<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfc1a0e8b50aa9a08a01892a6916457d1
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

        spl_autoload_register(array('ComposerAutoloaderInitfc1a0e8b50aa9a08a01892a6916457d1', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfc1a0e8b50aa9a08a01892a6916457d1', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfc1a0e8b50aa9a08a01892a6916457d1::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
