<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Router;
use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Exceptions\MethodNotFoundException;
use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Request;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        $this->router = new Router();
    }

    public function testGetRouteRegistration(): void
    {
        $this->router->get('/test', 'TestController@index');
        
        $this->assertArrayHasKey('/test', $this->router->routes['GET']);
        $this->assertEquals('TestController@index', $this->router->routes['GET']['/test']);
    }

    public function testPostRouteRegistration(): void
    {
        $this->router->post('/test', 'TestController@store');
        
        $this->assertArrayHasKey('/test', $this->router->routes['POST']);
        $this->assertEquals('TestController@store', $this->router->routes['POST']['/test']);
    }

    public function testPutRouteRegistration(): void
    {
        $this->router->put('/test', 'TestController@update');
        
        $this->assertArrayHasKey('/test', $this->router->routes['PUT']);
        $this->assertEquals('TestController@update', $this->router->routes['PUT']['/test']);
    }

    public function testDeleteRouteRegistration(): void
    {
        $this->router->delete('/test', 'TestController@destroy');
        
        $this->assertArrayHasKey('/test', $this->router->routes['DELETE']);
        $this->assertEquals('TestController@destroy', $this->router->routes['DELETE']['/test']);
    }

    public function testPatchRouteRegistration(): void
    {
        $this->router->patch('/test', 'TestController@patch');
        
        $this->assertArrayHasKey('/test', $this->router->routes['PATCH']);
        $this->assertEquals('TestController@patch', $this->router->routes['PATCH']['/test']);
    }

    public function testHeadRouteRegistration(): void
    {
        $this->router->head('/test', 'TestController@head');
        
        $this->assertArrayHasKey('/test', $this->router->routes['HEAD']);
        $this->assertEquals('TestController@head', $this->router->routes['HEAD']['/test']);
    }

    public function testRegisterMethod(): void
    {
        $routes = [
            'GET' => ['/home' => 'HomeController@index'],
            'POST' => ['/users' => 'UserController@store']
        ];

        $this->router->register($routes);

        $this->assertEquals($routes, $this->router->routes);
    }

    public function testMiddlewareRegistration(): void
    {
        $middleware = new TestMiddleware();
        
        $result = $this->router->middleware($middleware);
        
        $this->assertSame($this->router, $result);
        
        // Test middleware chaining
        $middleware2 = new TestMiddleware();
        $chainResult = $this->router->middleware($middleware2);
        
        $this->assertSame($this->router, $chainResult);
    }

    public function testRouteNotFoundExceptionThrown(): void
    {
        $this->expectException(RouteNotFoundException::class);
        
        $this->router->direct('/nonexistent', 'GET');
    }

    public function testMethodNotFoundExceptionThrown(): void
    {
        $this->expectException(MethodNotFoundException::class);
        
        $this->router->get('/test', 'TestController@nonexistentMethod');
        $this->router->direct('/test', 'GET');
    }

    public function testLoadStaticMethod(): void
    {
        // Create a temporary routes file
        $tempFile = tempnam(sys_get_temp_dir(), 'routes_test');
        file_put_contents($tempFile, '<?php $router->get("/test", "TestController@index");');
        
        $router = Router::load($tempFile);
        
        $this->assertInstanceOf(Router::class, $router);
        $this->assertArrayHasKey('/test', $router->routes['GET']);
        
        unlink($tempFile);
    }

    public function testCallActionWithValidController(): void
    {
        $router = new TestableRouter();
        
        $result = $router->testCallAction('TestController', 'validMethod');
        
        $this->assertEquals('test_result', $result);
    }

    public function testAllHttpMethodsSupported(): void
    {
        $methods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD'];
        
        foreach ($methods as $method) {
            $this->assertArrayHasKey($method, $this->router->routes);
            $this->assertIsArray($this->router->routes[$method]);
        }
    }

    public function testRouteOverwriting(): void
    {
        $this->router->get('/test', 'Controller1@method1');
        $this->router->get('/test', 'Controller2@method2');
        
        $this->assertEquals('Controller2@method2', $this->router->routes['GET']['/test']);
    }

    public function testEmptyRouteHandling(): void
    {
        $this->router->get('', 'HomeController@index');
        
        $this->assertArrayHasKey('', $this->router->routes['GET']);
        $this->assertEquals('HomeController@index', $this->router->routes['GET']['']);
    }
}

// Test helper classes
class TestMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, \Closure $next)
    {
        return $next($request);
    }
}

class TestableRouter extends Router
{
    public function testCallAction(string $controller, string $method)
    {
        return $this->callAction($controller, $method);
    }
}

// Mock controller for testing
namespace App\Controller;

class TestController
{
    public function index()
    {
        return 'index_result';
    }

    public function store()
    {
        return 'store_result';
    }

    public function update()
    {
        return 'update_result';
    }

    public function destroy()
    {
        return 'destroy_result';
    }

    public function patch()
    {
        return 'patch_result';
    }

    public function head()
    {
        return 'head_result';
    }

    public function validMethod()
    {
        return 'test_result';
    }
}