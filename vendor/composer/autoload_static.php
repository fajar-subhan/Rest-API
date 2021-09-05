<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5a8a4d4bed4c3a169e2549a48a0b77f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Api\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Api\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5a8a4d4bed4c3a169e2549a48a0b77f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5a8a4d4bed4c3a169e2549a48a0b77f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf5a8a4d4bed4c3a169e2549a48a0b77f::$classMap;

        }, null, ClassLoader::class);
    }
}
