<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ff8b857cb27beaa87db27c9cea37338
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
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ff8b857cb27beaa87db27c9cea37338::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ff8b857cb27beaa87db27c9cea37338::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ff8b857cb27beaa87db27c9cea37338::$classMap;

        }, null, ClassLoader::class);
    }
}
