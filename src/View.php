<?php

use View\FilterSupport;

/**
 * PHP View renderer
 *
 * - Defines a predictable context for php view files
 * - Buffered content rendering (returnable)
 * - Including views inside other views
 * - Support for view variables (inherited or restricted)
 * - Support for global variables (available in every view, even in restricted views)
 * - Chainable filters (can be disabled by removing FilterSupport trait)
 */
class View implements ArrayAccess
{
    use FilterSupport;

    /**
     * Global View variables
     */
    protected static array $globals = [];

    /**
     * View name
     */
    protected string $view;

    /**
     * Current View Variables
     */
    protected array $vars = [];

    public function __construct(string $view)
    {
        $this->view = $view;
    }

    public function getVariables(bool $includeGlobals = false): array
    {
        return $includeGlobals ? array_replace(self::$globals, $this->vars) : $this->vars;
    }

    public function render(array $vars = null, bool $mergeVariables = true)
    {
        if (isset($vars)) {
            $this->vars = $mergeVariables ? array_replace($this->vars, $vars) : $vars;
        }

        extract(array_replace(self::$globals, $this->vars));
        $view = $this;

        ob_start();
        include sprintf('views/%s.html.php', $this->view);
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    public function include(string $view, array $vars = []): self
    {
        $only = isset($vars['only']) && is_array($vars['only']) && count($vars) === 1;
        $vars = $only ? $vars['only'] : array_replace($this->vars, $vars);

        echo (new View($view))
            ->render($vars)
        ;

        return $this;
    }

    public static function setGlobals(array $globals, bool $replace = false)
    {
        self::$globals = $replace ? $globals : array_replace(self::$globals, $globals);
    }

    public function offsetExists($key)
    {
        return array_key_exists($key, $this->vars);
    }

    public function offsetGet($key)
    {
        return $this->vars[$key] ?? static::$globals[$key];
    }

    public function offsetSet($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function offsetUnset($key)
    {
        unset($this->vars[$key]);
    }

    public function __get($key)
    {
        return $this->vars[$key] ?? static::$globals[$key];
    }

    public function __set($key, $value)
    {
        $this->vars[$key] = $value;
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
