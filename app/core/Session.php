<?php
	

	class Session
	{

		/**
		 * Push new item into the global $_SESSION variable
         *
		 * @param  string $name name of the item
		 * @param  mixed $data item to be pushed
		 * @return null      
		 */
		public static function push(string $name, $data)
		{
			session_start();
			$_SESSION[$name] = $data;
		}

		/**
		 * Retrieve an item from the global $_SESSION variable
         *
		 * @param  string $name
         *@throws Exception
		 * @return mixed       
		 */
		public static function get(string $name)
		{
			if (self::has($name)) {
				return $_SESSION[$name];
			}

			throw new Exception();
			
		}

		/**
		 * Check if an item exists in the global $_SESSION variable
         *
		 * @param  string  $name item name
		 * @return boolean       
		 */
		public static function has(string $name) : bool
		{

			if (array_key_exists($name, $_SESSION)) {
				return true;
			}

			return false;
		}
	}