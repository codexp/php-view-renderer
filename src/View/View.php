<?php

namespace View;

use View\FilterSupport;
use View\Renderer;

/**
 * PHP View renderer
 *
 * - Defines a predictable context for php view files
 * - Buffered content rendering (returnable)
 * - Including views inside other views
 * - Support for view variables (inherited or restricted)
 * - Support for global variables (available in every view, even in restricted views)
 * - Chainable filters (can be disabled by removing FilterSupport trait)
 * - Resolvable custom View classes (requires registered resolver)
 */
class View extends Renderer
{
    use FilterSupport;

    public function __construct(string $view = null)
    {
        if (isset($view)) {
            $this->view = $view;
        }
    }
}
