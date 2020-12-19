<?php

namespace ViewModel;

use View\View;

/**
 * Layout View Model
 *
 * @property string $content content view template name
 */
class Layout extends View
{
    protected string $view = 'layout';
}
