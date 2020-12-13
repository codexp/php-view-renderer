<?php

View::setGlobals([
    'app_title' => 'PHP View renderer example',
]);

View::registerFilter('camelCase', function ($v) {
    return preg_replace('/[\s]+/', '', ucwords($v));
});
