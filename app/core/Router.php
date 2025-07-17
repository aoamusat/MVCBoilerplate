<?php

namespace App\Core;

use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Exceptions\MethodNotFoundException;
use App\Core\MiddlewarePipeline;
use App\Core\Interfaces\MiddlewareInterface;

/**
 * Class Router
 *
 * A simple router for handling HTTP requests and directing them to controller methods.
 */
class Router
{
    /**
     * @var array $routes Associative array holding routes for various HTTP methods.
     */
    public $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'DELETE' => [],
        'PATCH'  => [],
        'HEAD'   => [],
    ];

    /**
     * @var array $middlewares Global middlewares to be applied to all routes.
     */
    private $middlewares = [];

    /**
     * Route registrar.
     *
     * @param array $routes An associative array representing routes for various HTTP methods.
     * @return null
     */
    public function register($routes)
    {
        $this->routes = $routes;
    }

    /**
     * Forward HTTP Requests to a controller method.
     *
     * @param string $uri The URI of the request.
     * @param string $requestType The HTTP request method (e.g., GET, POST).
     * @throws \Exception If the specified route is not found.
     * @return null
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            $request = new Request();
            $pipeline = new MiddlewarePipeline();
            
            foreach ($this->middlewares as $middleware) {
                $pipeline->add($middleware);
            }
            
            return $pipeline->handle($request, function($request) use ($uri, $requestType) {
                return $this->callAction(
                    ...explode('@', $this->routes[$requestType][$uri])
                );
            });
        } else {
            // Set HTTP 404 status code
            http_response_code(404);
            
            // Include the 404 error page
            include __DIR__ . '/../views/errors/404.view.php';
            
            // Exit to prevent further processing
            exit;
        }
    }

    /**
     * Call the specified controller method.
     *
     * @param string $controller The name of the controller.
     * @param string $method The name of the method to call on the controller.
     * @throws \Exception If the specified method is not defined on the controller.
     * @return mixed The result of calling the specified method on the controller.
     */
    protected function callAction(string $controller, string $method)
    {
        $className = '\App\Controller\\' . $controller;

        $controllerClass = new $className();

        if (!method_exists($controllerClass, $method)) {
            throw new MethodNotFoundException($method, $controller);
        }

        return $controllerClass->$method();
    }

    /**
     * Handles HTTP GET requests.
     *
     * @param string $uri The URI to handle.
     * @param string $controller The controller to associate with the URI.
     * @return null
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Handles HTTP POST requests.
     *
     * @param string $uri The URI to handle.
     * @param string $controller The controller to associate with the URI.
     * @return null
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Handles HTTP PUT requests.
     *
     * @param string $uri The URI to handle.
     * @param string $controller The controller to associate with the URI.
     * @return null
     */
    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }

    /**
     * Handles HTTP DELETE requests.
     *
     * @param string $uri The URI to handle.
     * @param string $controller The controller to associate with the URI.
     * @return null
     */
    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
    }

    /**
     * Handles HTTP PATCH requests.
     *
     * @param string $uri The URI to handle.
     * @param string $controller The controller to associate with the URI.
     * @return null
     */
    public function patch($uri, $controller)
    {
        $this->routes['PATCH'][$uri] = $controller;
    }

    /**
     * Handles HTTP HEAD requests.
     *
     * @param string $uri The URI to handle.
     * @param string $controller The controller to associate with the URI.
     * @return null
     */
    public function head($uri, $controller)
    {
        $this->routes['HEAD'][$uri] = $controller;
    }

    /**
     * Add middleware to the router.
     *
     * @param MiddlewareInterface $middleware The middleware to add.
     * @return Router
     */
    public function middleware(MiddlewareInterface $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    /**
     * Load route file.
     *
     * @param string $file The file containing route definitions.
     * @return Router An instance of the Router class.
     */
    public static function load($file)
    {
        $router = new self();
        include $file;
        return $router;
    }
}
