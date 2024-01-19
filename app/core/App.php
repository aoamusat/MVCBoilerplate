<?php

namespace App\Core;

/**
 * Class App
 *
 * Represents a simple Dependency Injection (DI) Container for managing and retrieving application services.
 */
class App
{
    // @var array The registry holding key-value pairs for injected services.
    protected static $registry = [];

    /**
     * Inject a new value into the DI Container.
     *
     * @param string $key The key under which the value will be stored.
     * @param mixed $value The value to be stored.
     * @return null
     */
    public static function bind(string $key, $value)
    {
        self::$registry[$key] = $value;
    }

    /**
     * Get an item by its key from the DI Container.
     *
     * @param string $key The key of the item to retrieve.
     * @return mixed The value associated with the specified key.
     * @throws \Exception if the specified key is not found in the DI Container.
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new \Exception("Service '{$key}' not found in the DI Container.");
        }

        return self::$registry[$key];
    }
}
