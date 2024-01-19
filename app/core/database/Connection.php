<?php

/**
 * Class Connection
 *
 * Represents a database connection using PDO (PHP Data Objects).
 */
class Connection
{
    /**
     * Create a new PDO database connection.
     *
     * @param array $config An associative array containing db connection configs.
     *
     * @return PDO Returns a PDO database connection instance.
     */
    public static function make(array $config)
    {
        try {
            return new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die();
        }
    }
}
