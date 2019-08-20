<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitde43ef9d45c41731e03ebca7bdf5319e
{
    public static $files = array (
        '63c16acadd38c6248f9fb7b5254e5f8e' => __DIR__ . '/..' . '/oblik/pluralization/index.php',
    );

    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Oblik\\Pluralization\\' => 20,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Oblik\\Pluralization\\' => 
        array (
            0 => __DIR__ . '/..' . '/oblik/pluralization/src',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitde43ef9d45c41731e03ebca7bdf5319e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitde43ef9d45c41731e03ebca7bdf5319e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}