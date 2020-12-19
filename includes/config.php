<?php

use View\View;

View::setGlobals([
    'app_title' => 'PHP View renderer example',
]);

View::registerFilter('camelCase', function ($v) {
    return preg_replace('/[\s]+/', '', ucwords($v));
});

View::registerViewClassResolver(new \ViewModel\Resolver());
