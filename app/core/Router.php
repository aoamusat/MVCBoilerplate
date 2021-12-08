<?php


	class Router
	{
		public $routes = array(
				'GET' => [],
				'POST' => [],
				'PUT' => [],
				'DELETE' => [],
				'PATCH' => [],
				"HEAD" => []
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
		 * @param  string $requestType
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
					http_status_code(404);
					throw new Exception("Route: " . $uri . " not found!");
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
				http_status_code(500);
				throw new Exception($method . " not define on " . $controller);
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
		 * @return mixed
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
		 * @return mixed
		 */
		public function patch($uri, $controller)
		{
			$this->routes['PATCH'][$uri] = $controller;
		}
		
		/**
		 * Handles HTTP HEAD Requests
         	 *
		 * @param  string $uri
		 * @param  string $controller
		 * @return mixed
		 */
		public function patch($uri, $controller)
		{
			$this->routes['HEAD'][$uri] = $controller;
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
