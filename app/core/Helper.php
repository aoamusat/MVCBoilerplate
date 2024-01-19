<?php

namespace App\Core;
/**
 * Class Helper
 *
 * A utility class providing common helper functions for debugging, view rendering, and HTTP redirection.
 */
class Helper
{
    /**
     * Prints human-readable information about a variable.
     *
     * @param mixed $data The variable to be printed.
     * @return void
     */
    public static function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * Loads up a view.
     *
     * @param string $view The name of the view.
     * @param array $data Data to pass into the view.
     * @return mixed The result of requiring the specified view file.
     */
    public static function view(string $view, array $data = [])
    {
        extract($data);
        return include "app/views/{$view}.view.php";
    }

    /**
     * HTTP Redirect to a specified path.
     *
     * @param string $path The path to redirect to, e.g., "user/add".
     * @return void Redirects to the specified path.
     */
    public static function redirect($path)
    {
        header("Location: {$path}");
        exit(); // Ensure that no further code is executed after the redirect.
    }
}
