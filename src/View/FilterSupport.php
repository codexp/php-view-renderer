<?php

namespace View;

trait FilterSupport
{
    /**
     * Registered View filters
     */
    protected static array $filters = [
        'esc' => 'htmlspecialchars',
        'escape' => 'htmlspecialchars',
        'join' => [self::class, 'filterJoin'],
        'json' => 'json_encode',
        'lower' => 'mb_strtolower',
        'number' => 'number_format',
        'price' => [self::class, 'filterPrice'],
        'upper' => 'mb_strtoupper',
    ];

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
