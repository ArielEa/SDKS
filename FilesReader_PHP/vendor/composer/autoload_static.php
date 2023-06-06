<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf9ec76188bac768d3aeb9617aec5f969
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInitf9ec76188bac768d3aeb9617aec5f969::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf9ec76188bac768d3aeb9617aec5f969::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf9ec76188bac768d3aeb9617aec5f969::$classMap;

        }, null, ClassLoader::class);
    }
}
