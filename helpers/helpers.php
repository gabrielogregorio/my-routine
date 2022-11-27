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

if (! function_exists('password_is_valid')) {
    /**
     * @param string $password
     * @return boolean
     */
    function password_is_valid(string $password): bool
    {
        if (password_get_info($password['algo'])) {
            return true;
        }

        if (mb_strlen($password) >= PASSWORD_MIN_LEN && mb_strlen($password) <= PASSWORD_MAX_LEN) {
            return true;
        }
        return false;
    }
}

if (! function_exists('password_encryption')) {
    /**
     * @param string $password
     * @return string
     */
    function password_encryption(string $password): string
    {
        return password_hash($password, PASSWORD_ENCRYPT, PASSWORD_OPTIONS);
    }
}

if (! function_exists('password_checker')) {
    /**
     * @param string $password
     * @param string $hash
     * @return boolean
     */
    function password_checker(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}

if (! function_exists('password_rehash')) {
    /**
     * @param string $hash
     * @return boolean
     */
    function password_rehash(string $hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_ENCRYPT, PASSWORD_OPTIONS);
    }
}
