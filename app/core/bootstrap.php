<?php

/**
 * Register bindings in the app's service container.
 * More may be added by following the convention that's used.
 */

	App::bind('config', require 'config.php');

	App::bind('database',
			new QueryBuilder(
				Connection::make(App::get('config')['database'])
		));
