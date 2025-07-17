<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Exceptions\BaseException;
use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Exceptions\MethodNotFoundException;
use App\Core\Exceptions\DatabaseException;
use App\Core\Exceptions\ServiceNotFoundException;

class ExceptionTest extends TestCase
{
    public function testRouteNotFoundExceptionHasCorrectHttpStatusCode(): void
    {
        $exception = new RouteNotFoundException('/nonexistent');
        
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }

    public function testRouteNotFoundExceptionHasCorrectMessage(): void
    {
        $uri = '/nonexistent';
        $exception = new RouteNotFoundException($uri);
        
        $this->assertEquals("Route not found: {$uri}", $exception->getMessage());
    }

    public function testMethodNotFoundExceptionHasCorrectHttpStatusCode(): void
    {
        $exception = new MethodNotFoundException('index', 'UserController');
        
        $this->assertEquals(500, $exception->getHttpStatusCode());
    }

    public function testMethodNotFoundExceptionHasCorrectMessage(): void
    {
        $method = 'index';
        $controller = 'UserController';
        $exception = new MethodNotFoundException($method, $controller);
        
        $this->assertEquals("Method '{$method}' not found in controller '{$controller}'", $exception->getMessage());
    }

    public function testDatabaseExceptionHasCorrectHttpStatusCode(): void
    {
        $exception = new DatabaseException();
        
        $this->assertEquals(500, $exception->getHttpStatusCode());
    }

    public function testDatabaseExceptionHasDefaultMessage(): void
    {
        $exception = new DatabaseException();
        
        $this->assertEquals('Database error occurred', $exception->getMessage());
    }

    public function testDatabaseExceptionAcceptsCustomMessage(): void
    {
        $customMessage = 'Custom database error';
        $exception = new DatabaseException($customMessage);
        
        $this->assertEquals($customMessage, $exception->getMessage());
    }

    public function testServiceNotFoundExceptionHasCorrectHttpStatusCode(): void
    {
        $exception = new ServiceNotFoundException('TestService');
        
        $this->assertEquals(500, $exception->getHttpStatusCode());
    }

    public function testServiceNotFoundExceptionHasCorrectMessage(): void
    {
        $service = 'TestService';
        $exception = new ServiceNotFoundException($service);
        
        $this->assertEquals("Service '{$service}' not found in the DI Container", $exception->getMessage());
    }

    public function testBaseExceptionToArrayMethod(): void
    {
        $exception = new TestableBaseException('Test message', 123);
        
        $array = $exception->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('error', $array);
        $this->assertArrayHasKey('message', $array);
        $this->assertArrayHasKey('code', $array);
        $this->assertArrayHasKey('file', $array);
        $this->assertArrayHasKey('line', $array);
        
        $this->assertTrue($array['error']);
        $this->assertEquals('Test message', $array['message']);
        $this->assertEquals(123, $array['code']);
    }

    public function testExceptionInheritanceChain(): void
    {
        $exception = new RouteNotFoundException('/test');
        
        $this->assertInstanceOf(BaseException::class, $exception);
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    public function testExceptionWithPreviousException(): void
    {
        $previousException = new \Exception('Previous error');
        $exception = new DatabaseException('Database error', 0, $previousException);
        
        $this->assertSame($previousException, $exception->getPrevious());
    }

    public function testExceptionCodesAreCorrect(): void
    {
        $exception1 = new RouteNotFoundException('/test');
        $exception2 = new DatabaseException('Error', 500);
        
        $this->assertEquals(0, $exception1->getCode());
        $this->assertEquals(500, $exception2->getCode());
    }

    public function testExceptionMessagesAreStrings(): void
    {
        $exceptions = [
            new RouteNotFoundException('/test'),
            new MethodNotFoundException('method', 'controller'),
            new DatabaseException('error'),
            new ServiceNotFoundException('service')
        ];

        foreach ($exceptions as $exception) {
            $this->assertIsString($exception->getMessage());
            $this->assertNotEmpty($exception->getMessage());
        }
    }

    public function testExceptionFileAndLineAreSet(): void
    {
        $exception = new RouteNotFoundException('/test');
        
        $this->assertIsString($exception->getFile());
        $this->assertIsInt($exception->getLine());
        $this->assertGreaterThan(0, $exception->getLine());
    }

    public function testExceptionToArrayContainsAllRequiredFields(): void
    {
        $exception = new TestableBaseException('Test message');
        $array = $exception->toArray();
        
        $requiredFields = ['error', 'message', 'code', 'file', 'line'];
        
        foreach ($requiredFields as $field) {
            $this->assertArrayHasKey($field, $array);
        }
    }

    public function testExceptionToArrayErrorFieldIsAlwaysTrue(): void
    {
        $exception = new TestableBaseException('Test message');
        $array = $exception->toArray();
        
        $this->assertTrue($array['error']);
    }

    public function testDifferentExceptionTypesHaveCorrectStatusCodes(): void
    {
        $statusCodes = [
            RouteNotFoundException::class => 404,
            MethodNotFoundException::class => 500,
            DatabaseException::class => 500,
            ServiceNotFoundException::class => 500
        ];

        foreach ($statusCodes as $exceptionClass => $expectedStatusCode) {
            $exception = $this->createExceptionInstance($exceptionClass);
            $this->assertEquals($expectedStatusCode, $exception->getHttpStatusCode());
        }
    }

    public function testExceptionConstructorParameters(): void
    {
        // Test RouteNotFoundException
        $routeException = new RouteNotFoundException('/test');
        $this->assertStringContainsString('/test', $routeException->getMessage());

        // Test MethodNotFoundException
        $methodException = new MethodNotFoundException('index', 'UserController');
        $this->assertStringContainsString('index', $methodException->getMessage());
        $this->assertStringContainsString('UserController', $methodException->getMessage());

        // Test ServiceNotFoundException
        $serviceException = new ServiceNotFoundException('TestService');
        $this->assertStringContainsString('TestService', $serviceException->getMessage());
    }

    private function createExceptionInstance(string $exceptionClass): BaseException
    {
        switch ($exceptionClass) {
            case RouteNotFoundException::class:
                return new RouteNotFoundException('/test');
            case MethodNotFoundException::class:
                return new MethodNotFoundException('method', 'controller');
            case DatabaseException::class:
                return new DatabaseException();
            case ServiceNotFoundException::class:
                return new ServiceNotFoundException('service');
            default:
                throw new \InvalidArgumentException("Unknown exception class: {$exceptionClass}");
        }
    }
}

// Test helper class
class TestableBaseException extends BaseException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}