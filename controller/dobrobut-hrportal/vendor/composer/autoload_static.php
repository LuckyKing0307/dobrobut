<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5271ee0f3573d7d5986de209af6e0e9a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Datto\\JsonRpc\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Datto\\JsonRpc\\' => 
        array (
            0 => __DIR__ . '/..' . '/datto/json-rpc/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5271ee0f3573d7d5986de209af6e0e9a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5271ee0f3573d7d5986de209af6e0e9a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5271ee0f3573d7d5986de209af6e0e9a::$classMap;

        }, null, ClassLoader::class);
    }
}
