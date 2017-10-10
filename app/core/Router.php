<?php


	class Router
	{
		public $routes = array(
				'GET' => [],
				'POST' => [],
				'PUT' => [],
				'DELETE' => [],
				'PATCH' => []
			);

		/**
		 * Route registrar
		 * @param  array $routes
		 */
		public function register($routes)
		{
			$this->routes = $routes;
		}

		/**
		 * Forward HTTP Requests to a controller method
         *
		 * @param  string $uri
		 * @param  string $requestType GET/POST/PATCH/DELETE/PUT
         * @throws Exception
		 * @return null
		 */
		public function direct($uri, $requestType)
		{
			if(array_key_exists($uri, $this->routes[$requestType]))
			{
				$this->callAction(
						...explode('@', $this->routes[$requestType][$uri])
					);
			}
			else {
					throw new Exception("No Route Defined For This URI. ");
			}
		}

		/**
		 * Call the specified controller method
         *
		 * @param  string $controller [description]
		 * @param  string $method     [description]
         * @throws Exception
		 * @return [type]             [description]
		 */
		protected function callAction(string $controller, string $method)
		{
			if (!method_exists($controller, $method)) {
				throw new Exception("Error Processing Request");
			}

			return (new $controller)->$method();
		}

		/**
		 * Handles http get requests
         *
		 * @param  string $uri
		 * @param  string $controller
		 * @return null
		 */
		public function get($uri, $controller)
		{
			$this->routes['GET'][$uri] = $controller;
		}

		/**
		 * Handles HTTP POST Requests
         *
		 * @param  string $uri
		 * @param  string $controller
		 * @return null
		 */
		public function post($uri, $controller)
		{
			$this->routes['POST'][$uri] = $controller;
		}

		/**
		 * Handles HTTP PUT Requests
         *
		 * @param  string $uri
		 * @param  string $controller
		 * @return null
		 */
		public function put($uri, $controller)
		{
			$this->routes['PUT'][$uri] = $controller;
		}

		/**
		 * Handles HTTP DELETE Requests
         *
		 * @param  string $uri
		 * @param  string $controller
		 * @return null
		 */
		public function delete($uri, $controller)
		{
			$this->routes['DELETE'][$uri] = $controller;
		}

		/**
		 * Handles HTTP PATCH Requests
         *
		 * @param  string $uri
		 * @param  string $controller
		 * @return null
		 */
		public function patch($uri, $controller)
		{
			$this->routes['PATCH'][$uri] = $controller;
		}

		/**
		 * Load route file
         *
		 * @param  string $file
		 * @return Router instance
		 */
		public static function load($file)
		{
			$router = new self;
			require $file;
			return $router;
		}
	}