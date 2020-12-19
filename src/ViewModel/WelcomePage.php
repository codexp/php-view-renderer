<?php

namespace ViewModel;

use View\View;

/**
 * Layout View Model
 *
 * @property string $name sample user name
 * @property string $sub_content sub-content view template name
 */
class WelcomePage extends View
{
    protected string $view = 'page/welcome';
}
