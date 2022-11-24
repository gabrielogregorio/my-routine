<?php

declare(strict_types=1);

if (! function_exists('env')) {
    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}
