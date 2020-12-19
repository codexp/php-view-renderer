<?php

set_include_path(implode(PATH_SEPARATOR, [
    get_include_path(),
    './src',
    './controller',
]));

spl_autoload_register(function ($class) {
    $classFile = strtr($class, ['\\' => '/']) . '.php';

    $filePath = stream_resolve_include_path($classFile);
    if ($filePath !== false) {
        require $classFile;
    }
});
