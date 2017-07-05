<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit358f72da130a870d12e428f9c2d92c00
{
    public static $files = array (
        '1a1306fe0852669a19a447d114c685d0' => __DIR__ . '/../..' . '/src/Support/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hpkns\\Rss\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hpkns\\Rss\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit358f72da130a870d12e428f9c2d92c00::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit358f72da130a870d12e428f9c2d92c00::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}