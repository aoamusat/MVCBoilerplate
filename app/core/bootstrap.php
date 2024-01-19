<?php

use App\Core\App;

/**
 * Register bindings in the app's service container.
 * More bindings may be added by following the convention that's used.
 */

// Bind the 'config' key to the configuration array loaded from 'config.php'.
App::bind('config', require 'config.php');

// Bind the 'database' key to a new instance of the QueryBuilder class
// with a database connection created using the configuration settings.
App::bind(
    'database',
    new QueryBuilder(
        Connection::make(App::get('config')['database'])
    )
);
