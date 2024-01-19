<?php

namespace App\Core;

/**
 * Class Session
 *
 * A simple wrapper for working with PHP sessions, providing methods for pushing, retrieving, and checking the existence
 * of items in the global $_SESSION variable.
 */
class Session
{
    /**
     * Push a new item into the global $_SESSION variable.
     *
     * @param string $name The name of the item.
     * @param mixed $data The data to be pushed.
     * @return null
     */
    public static function push(string $name, $data)
    {
        session_start();
        $_SESSION[$name] = $data;
    }

    /**
     * Retrieve an item from the global $_SESSION variable.
     *
     * @param string $name The name of the item to retrieve.
     * @throws Exception If the specified item does not exist in the $_SESSION variable.
     * @return mixed The value of the specified item in the $_SESSION variable.
     */
    public static function get(string $name)
    {
        if (self::has($name)) {
            return $_SESSION[$name];
        }

        throw new Exception("Session item '{$name}' not found.");
    }

    /**
     * Check if an item exists in the global $_SESSION variable.
     *
     * @param string $name The name of the item to check for.
     * @return bool Returns true if the item exists in the $_SESSION variable, false otherwise.
     */
    public static function has(string $name): bool
    {
        return array_key_exists($name, $_SESSION);
    }
}
