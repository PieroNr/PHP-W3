<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0542a20803047f95fb0db1d11e955f27
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Test' => __DIR__ . '/../..' . '/app/Test.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0542a20803047f95fb0db1d11e955f27::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0542a20803047f95fb0db1d11e955f27::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0542a20803047f95fb0db1d11e955f27::$classMap;

        }, null, ClassLoader::class);
    }
}