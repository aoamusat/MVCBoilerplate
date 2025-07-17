<?php

namespace App\Core;

use App\Core\Exceptions\ServiceNotFoundException;

/**
 * Class App
 *
 * Represents a simple Dependency Injection (DI) Container for managing and retrieving application services.
 * This class provides a facade for the Container class to maintain backward compatibility.
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
        Container::getInstance()->bind($key, $value);
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
        if (array_key_exists($key, static::$registry)) {
            return self::$registry[$key];
        }

        if (Container::getInstance()->has($key)) {
            return Container::getInstance()->resolve($key);
        }

        throw new ServiceNotFoundException($key);
    }

    /**
     * Register a singleton in the container.
     *
     * @param string $key The key under which the value will be stored.
     * @param mixed $value The value to be stored.
     * @return null
     */
    public static function singleton(string $key, $value)
    {
        Container::getInstance()->singleton($key, $value);
    }

    /**
     * Resolve a service from the container.
     *
     * @param string $key The key of the service to resolve.
     * @return mixed The resolved service.
     */
    public static function resolve(string $key)
    {
        return Container::getInstance()->resolve($key);
    }
}
