<?php

namespace View;

abstract class Renderer extends VariableAccess
{
    /**
     * View name
     */
    protected string $view;

    public function render(array $vars = null, bool $mergeVariables = true)
    {
        if (isset($vars)) {
            $this->setVariables($vars, $mergeVariables);
        }

        extract(array_replace(self::$globals, $this->vars));
        $view = $this;

        ob_start();
        include sprintf('views/%s.html.php', $this->view);
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    /**
     * Include (render) another view
     *
     * @param string $view view template name
     * @param array $vars view variables
     * @param bool $return return rendered contents if true, output otherwise
     *
     * @return static|string
     */
    public function include(string $view, array $vars = [], bool $return = false)
    {
        $only = isset($vars['only']) && is_array($vars['only']) && count($vars) === 1;
        $vars = $only ? $vars['only'] : array_replace($this->vars, $vars);

        $content = (new View($view))
            ->render($vars)
        ;

        if ($return) {
            return $content;
        }

        echo $content;

        return $this;
    }

    public function __invoke(array $vars = null, bool $mergeVariables = true): string
    {
        return $this->render($vars, $mergeVariables);
    }

    public function __toString(): string
    {
        return $this->render();
    }
}