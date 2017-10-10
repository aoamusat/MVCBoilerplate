<?php
	
	
	class App
	{
		protected static $registry = [];

		/**
		 * Inject new value into the DI Container.
         *
		 * @param  string $key   
		 * @param  mixed $value 
		 * @return null
		 */
		public static function bind(string $key, $value)
		{
			self::$registry[$key] = $value;
		}

		/**
		 * Get an item by its key from the DI Container.
         *
		 * @param  string $key 
		 * @return null
         * @throws Exception if the service name that was passed into the method is not found.
		 */
		public static function get(string $key)
		{
			if (!array_key_exists($key, static::$registry)) {
				throw new Exception;
			}

			return self::$registry[$key];
		}
	}