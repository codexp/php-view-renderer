<?php

namespace ViewModel;

use View\ViewClassResolver;

class Resolver implements ViewClassResolver
{
    const NS = '\\ViewModel\\';

    private $cache = [];

    /**
     * @inheritDoc
     */
    function resolve($view)
    {
        if (array_key_exists($view, $this->cache)) {
            return $this->cache[$view];
        }

        if (
            substr($view, 0, 1) === '@'
            && class_exists(self::NS . substr($view, 1))
        ) {
            $this->cache[$view] = self::NS . substr($view, 1);
        } else {
            $this->cache[$view] = null;
        }

        return $this->cache[$view];
    }
}
