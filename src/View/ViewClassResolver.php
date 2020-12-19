<?php

namespace View;

interface ViewClassResolver
{
    /**
     * Resolve custom view class
     *
     * @param string $view view identifier
     *
     * @return string|null returns class FQN for view class or null
     */
    function resolve($view);
}
