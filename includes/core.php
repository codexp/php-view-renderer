<?php

spl_autoload_register(function ($class) {
    $classFile = 'src/' . $class . '.php';

    if (!is_file($classFile)) {
        $classFile = 'controller/' . $class . '.php';
    }

    require $classFile;
});
