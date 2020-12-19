<?php

namespace View;

use ArrayAccess;

abstract class VariableAccess implements ArrayAccess
{
    /**
     * Global View variables
     */
    protected static array $globals = [];

    /**
     * Current View variables
     */
    protected array $vars = [];

    public static function getGlobals(): array
    {
        return self::$globals;
    }

    public static function setGlobals(array $globals, bool $replace = false)
    {
        self::$globals = $replace ? $globals : array_replace(self::$globals, $globals);
    }

    public function getVariables(bool $includeGlobals = false): array
    {
        return $includeGlobals ? array_replace(self::$globals, $this->vars) : $this->vars;
    }

    public function setVariables(array $vars, bool $mergeVariables = true): self
    {
        $this->vars = $mergeVariables ? array_replace($this->vars, $vars) : $vars;

        return $this;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->vars);
    }

    public function get(string $key)
    {
        return $this->vars[$key] ?? static::$globals[$key];
    }

    public function set(string $key, $value): self
    {
        $this->vars[$key] = $value;

        return $this;
    }

    public function unset(string $key): self
    {
        unset($this->vars[$key]);

        return $this;
    }

    public function offsetExists($key)
    {
        return $this->has($key);
    }

    public function offsetGet($key)
    {
        return $this->get($key);
    }

    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    public function offsetUnset($key)
    {
        $this->unset($key);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }
}