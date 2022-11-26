<?php

declare(strict_types=1);

namespace MyRoutine\Support;

/**
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class Session
{
    public function __construct()
    {
        if (! session_id()) {
            if (! is_dir(SESSION_STORAGE)) {
                mkdir(SESSION_STORAGE, 0700, true);
            }
            session_start();
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (! empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return $this->has($name);
    }

    /**
     * @return object|null
     */
    public function all(): ?object
    {
        return (object)$_SESSION;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Session
     */
    public function set(string $key, $value): Session
    {
        $_SESSION[$key] = (is_array($value) ? (object)$value : $value);
        return $this;
    }

    /**
     * @param string $key
     * @return Session
     */
    public function unset(string $key): Session
    {
        unset($_SESSION[$key]);
        return $this;
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @return Session
     */
    public function regenerate(): Session
    {
        session_regenerate_id(true);
        return $this;
    }

    /**
     * @return Session
     */
    public function destroy(): Session
    {
        session_destroy();
        return $this;
    }
}
