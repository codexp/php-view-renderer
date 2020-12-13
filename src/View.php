<?php

class View
{
    /**
     * Global View variables
     */
    protected static array $globals = [];

    /**
     * Registered View filters
     */
    protected static array $filters = [
        'esc' => 'htmlspecialchars',
        'escape' => 'htmlspecialchars',
        'join' => [View::class, 'filterJoin'],
        'json' => 'json_encode',
        'lower' => 'mb_strtolower',
        'number' => 'number_format',
        'price' => [View::class, 'filterPrice'],
        'upper' => 'mb_strtoupper',
    ];

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

    public function filter($var, ...$filters)
    {
        // set default filter if nothing is specified
        if (empty($filters)) {
            $filters = ['escape'];
        }

        foreach ($filters as $name) {
            // if array syntax is used
            if (is_array($name)) {
                // it has to be an associated array (key => value)
                $assoc = $name;
                // key is filter name and value is additional arguments
                foreach ($assoc as $name => $args) {
                    // use defined filter or fallback to global function
                    $filter = self::$filters[$name] ?? $name;
                    // pass var and arguments to filter
                    $var = $filter($var, ...(array)$args);
                }
            } else {
                // use defined filter or fallback to global function
                $filter = self::$filters[$name] ?? $name;
                // pass var to filter as the only argument
                $var = $filter($var);
            }
        }

        return $var;
    }

    public static function setGlobals(array $globals, bool $replace = false)
    {
        self::$globals = $replace ? $globals : array_replace(self::$globals, $globals);
    }

    public static function registerFilter(string $name, callable $callable)
    {
        self::$filters[$name] = $callable;
    }

    public static function filterJoin(array $parts, string $glue = ', '): string
    {
        return implode($glue, $parts);
    }

    public static function filterPrice(
        float $price,
        $currency = '€',
        $decimals = 2,
        $decimal_separator = ',',
        $thousands_separator = ''
    ): string {
        return sprintf(
            '<span class="price%s"><span class="value">%s</span> <span class="currency">%s</span></span>',
            $price < 0 ? ' negative' : '',
            number_format($price, $decimals, $decimal_separator, $thousands_separator),
            htmlentities($currency)
        );
    }
}
