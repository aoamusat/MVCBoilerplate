<?php


	class Request
	{
        /**
         * Get the uri of a request.
         * @return string
         */
		public static function uri()
		{
			$uri = trim(
					parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
				);
			return $uri;
		}

        /**
         * Get the request method.
         *
         * @return string
         */
		public static function method()
		{
			$method = $_SERVER['REQUEST_METHOD'];
			return $method;
		}
	}