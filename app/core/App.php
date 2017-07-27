<?php
	
	
	class App
	{
		protected static $registry = [];

		/**
		 * Inject new value into the DI Container
		 * @param  string $key   
		 * @param  mixed $value 
		 * @return null
		 */
		public static function bind(string $key, $value)
		{
			self::$registry[$key] = $value;
		}

		/**
		 * Get the key
		 * @param  string $key 
		 * @return null
		 */
		public static function get(string $key)
		{
			if (!array_key_exists($key, static::$registry)) {
				throw new Exception;
			}

			return self::$registry[$key];
		}
	}