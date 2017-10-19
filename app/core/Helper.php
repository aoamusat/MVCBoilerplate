<?php
	
	
	class Helper 
	{
        /**
         * Prints human-readable information about a variable.
         *
         * @param $data
         */
		public static function dd($data)
		{
			echo "<pre>";
				print_r($data);
			echo "</pre>";
		}

		/**
		 * Loads up a view
		 * @param  string $view name of the view
		 * @param  array $data Data to pass into the view
		 * @return [type]
		 */
		public static function view(string $view, array $data = [])
		{
			extract($data);
			return require "app/views/{$view}.view.php";
		}

		/**
		 * HTTP Redirect to a path
		 * @param  string $path E.g user/add
		 * @return null       redirect to the specified path
		 */
		public static function redirect($path)
		{
			header("Location: {$path}");
		}
	}