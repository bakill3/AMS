<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita624778db5570fe8361ea7f6c15931ca
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'ParagonIE\\ConstantTime\\' => 23,
        ),
        'O' => 
        array (
            'OTPHP\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ParagonIE\\ConstantTime\\' => 
        array (
            0 => __DIR__ . '/..' . '/paragonie/constant_time_encoding/src',
        ),
        'OTPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/spomky-labs/otphp/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita624778db5570fe8361ea7f6c15931ca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita624778db5570fe8361ea7f6c15931ca::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita624778db5570fe8361ea7f6c15931ca::$classMap;

        }, null, ClassLoader::class);
    }
}
